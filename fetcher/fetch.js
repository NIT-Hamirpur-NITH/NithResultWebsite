var querystring = require('querystring');
var http 				= require('https');
var colors			= require('colors/safe');
var cheerio			= require('cheerio');
var mysql				= require('mysql');
var async   		= require('async');

/**
 * Create the connection
 */
var connection = mysql.createConnection({
 host     : 'localhost',
 user     : 'resultscraper',
 password : 'nitkaresult',
 database : 'result'
});

connection.connect(function(err) {
	if (err) {
	console.error('error connecting: ' + err.stack);
	return;
	}
	console.log('Conneted as id ' + connection.threadId);
});


function getResult(scheme, rollNumber, callback) {

	try {

		var body = querystring.stringify({
		    "B1": "Submit",
		    "RollNumber": rollNumber
		});

		var path = '/scheme' + scheme + '/studentresult/details.asp';


		var request = http.request({
			rejectUnauthorized: false,
			host: '14.139.56.15',
		    port: 443,
		   	path: path,
		    method: 'POST',
		    headers: {
		   		'Content-Type': 'application/x-www-form-urlencoded',
		        'Content-Length': Buffer.byteLength(body)
		    	}

			}, function(res, err) {

				var data = '';

				if (err) {
					console.log(colors.red(err));
					callback();
				}

				console.log(colors.green('Getting response..'));

				res.on('data', function(d) {
					data += d;
				});

				res.on('end', function() {
					console.log(data);
					parse(data, scheme, callback);
				});

				res.on('error', function(err) {
					console.log(colors.red(err));
					callback();
				});

		});

		request.write(body);
		request.end();

	} catch (e) {
		closeConnection();
		throw(e);
	}

}


function parse(data, scheme, callback) {

	try {
		var meta = {};
		meta.supplies = [];
		var $ = cheerio.load(data);
		var sem_index = 0;

		$('.ewTable').each(function(index, table) {


			// get the name and rollNumber
			if (index === 0) {
				meta.name = $(table).find('div[align=center]').eq(1).text().trim();
				meta.roll = $(table).find('div[align=center]').eq(3).text().trim();
				if (meta.name) {
					meta.semesters = [];
				}
			}

			// get all the semester results
			if (index%2 !== 0) {
				meta.semesters[sem_index] = {};
				meta.semesters[sem_index].subjects = [];
				$(table).find('tr').each(function(index_r, row) {
					var subject = {};
					if (index_r !== 0) {
						var tds = $(row).find('td');
						subject.sub_name = tds.eq(1).text().trim();
						subject.sub_code = tds.eq(2).text().trim();
						subject.sub_point = +tds.eq(3).text().trim();
						subject.sub_grade = tds.eq(4).text().trim();
						subject.sub_gp = +tds.eq(5).text().trim();
						if (subject.sub_gp === 0) {
							meta.supplies.push({
								sub_code : subject.sub_code,
								sub_name : subject.sub_name
							});
						}


					}
					meta.semesters[sem_index].subjects.push(subject);
				});
			}

			// get the cgpis and sgpies
			if (index%2 === 0 && index !== 0) {
				var tds = $(table).find('tr').eq(1).find('td');
				meta.semesters[sem_index].sgpi = tds.eq(0).text().trim();
				meta.semesters[sem_index].sgpi_total = tds.eq(1).text().trim();
				meta.semesters[sem_index].cgpi = tds.eq(2).text().trim();
				meta.semesters[sem_index].cgpi_total = tds.eq(3).text().trim();
				sem_index++;
			}


		});

		console.log(colors.green.underline('Data:') + '\n' + colors.green(JSON.stringify(meta, null, 2)));

		if(!meta.name) {
			callback();
			return;
		}
		meta.sgpis = meta.semesters.map(function(item, index) {
			return +item.sgpi.split('=')[1];
		});

		meta.cgpis = meta.semesters.map(function(item, index) {
			return +item.cgpi.split('=')[1];
		});

		meta.current_cgpi = meta.cgpis[meta.cgpis.length - 1];
		meta.scheme = scheme;

		switch(meta.roll[2]) {
				case '1':
					meta.dept = 'CED';
					break;
				case '2':
					meta.dept = 'EEE';
					break;
				case '3':
					meta.dept = 'MED';
					break;
				case '4':
					meta.dept = 'ECE';
					break;
				case '5':
					meta.dept = 'CSE';
					break;
				case '6':
					meta.dept = 'ARCH';
					break;
				case '7':
					meta.dept = 'CHD';
					break;

		}

		console.log(colors.green.underline('Data:') + '\n' + colors.green(JSON.stringify(meta, null, 2)));
		save(meta, callback);

	} catch (e) {
		closeConnection();
		throw(e);
	}

}


function save(meta, callback) {

	try {
		var query_str = "INSERT INTO marks(name, rollNumber, scheme, dept, cgpi, sgpi1, sgpi2, sgpi3, sgpi4, sgpi5, sgpi6, sgpi7, sgpi8, sgpi9, sgpi10) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		var values = [];
		values.push(meta.name);
		values.push(meta.roll);
		values.push(meta.scheme);
		values.push(meta.dept);
		values.push(meta.current_cgpi);

		meta.sgpis.forEach(function(value, index) {
			values.push(value);
		});

		for(var i = values.length; i < 15; ++i) {
			values[i] = -1;
		}

		var query = connection.query(query_str, values, function(err, result) {
			if (err) {
				console.log(colors.red(err));
				callback();
				return;
			}

			async.each(meta.supplies, function(supply, callback_s) {

				var q = connection.query('INSERT INTO suppy (rollNumber, subject) values(?, ?)', [meta.roll, supply.sub_name], function(err, result) {
					if (err) {
						console.log(colors.red(err));
						callback_s('Cannot add ' + supply);
					}
					console.log(colors.green('Succesfully added to supply for ' + meta.roll + 'in ' + supply.sub_name));
					callback_s();
				});

			}, function(err) {

				if (err) {
					console.log(colors.red(err));
					callback();
					return;
				}
				console.log(colors.green('Added all supplies for ' + meta.roll));

				connection.query('INSERT INTO semesters (rollNumber, data) values(?, ?)', [meta.roll, JSON.stringify(meta.semesters)], function(err, result) {
					if (err) {
						console.log(colors.red(err));
						callback();
						return;
					}
					console.log(colors.green('Succesfully added to semester for ' + meta.roll));
					callback();
				});

			});


		});

		console.log(query.sql);

	} catch (e) {
		closeConnection();
		throw(e);
	}

}

function closeConnection() {
	connection.end(function(err) {
		if (err) {
			console.log(colors.red(err));
		} else {
			console.log(colors.green('Done'));
		}
	});
}

var resultQueue = async.queue(function(data, callback) {
	console.log('\n');
	console.log(data);
	console.log(colors.blue.underline('Fetching for roll : ' + data.roll));
	getResult(data.schema, data.roll, callback);
}, 1);

resultQueue.drain = function(){
	closeConnection();
	console.log("All channels processed");
};

(function() {
		for (var schema = 11; schema <= 15; ++schema) {
			for (var roll = 101; roll < 800; ++roll) {
				resultQueue.push({
					schema: schema,
					roll: +(schema + '' + roll)
				});
			}
		}

})();

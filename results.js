var cheerio = require('cheerio');
var fs		=require('fs');
var colors = require('colors');
var async = require('async');
var querystring = require('querystring');
var http = require('https');

var results = {};


var getMarksQueue = async.queue(function(i,callback){
	var body = querystring.stringify({
	    "B1": "Submit",
	    "RollNumber": i
	});

	var request = http.request({
		rejectUnauthorized: false,
		host: '14.139.56.15',
	    port: 443,
	   	path: '/scheme11/studentresult/details.asp',
	    method: 'POST',
	    headers: {
	   		'Content-Type': 'application/x-www-form-urlencoded',
	        'Content-Length': Buffer.byteLength(body)
	    	}

		},
		function(res,err) {
			if(err){
				console.log(err);
			}
			console.log('Getting response..');
			var resp = '';

			res.on('data', function(data) {
				resp += data;
			});

			res.on('end', function() {
				var $ = cheerio.load(resp);
				var name = $($('.ewTableAltRow')[0]).text();
				var rollnumber = $($('.ewTableAltRow')[1]).text();

				var j = 1;
				var sgpi = [];
				var flag = 0;
				var cgpi = [];
				var k = 1
				var suppliSubject = [];

				$('td.ewTableAltRow').each(function(index) {
					if( $($('td.ewTableAltRow')[index]).text() == 'F'){
						suppliSubject.push($($('td.ewTableAltRow')[index-3]).text())
					}

					if( $($('td.ewTableAltRow')[index]).text().split('=')[1] ) {
						if(flag == 0) {
							sgpi[j] = $($('td.ewTableAltRow')[index]).text().split('=')[1];
							flag =1;
							j++;

							//console.log(index);
						}else{

								cgpi[k] = $($('td.ewTableAltRow')[index]).text().split('=')[1];
								k++;
								flag = 0;


						}
					}
				});

				var dept = rollnumber.toString().substring(2,3);
				console.log(dept);
				if(dept == '1'){
					dept = 'CED';
				}
				else if(dept == '2'){
					dept = 'EEE'
				}
				else if(dept == '3'){
					dept = 'MED';
				}
				else if (dept == '4'){
					dept = 'ECE'
				}
				else if(dept == '5'){
					dept = 'CSE';
				}
				else if(dept == '6'){
					dept = 'ARCH';
				}


			 /*
				var cgpi = $($('td.ewTableAltRow')[320]).text().split('=')[1];
				var sgpi5 = $($('td.ewTableAltRow')[318]).text().split('=')[1];
				var sgpi4 = $($('td.ewTableAltRow')[260]).text().split('=')[1];
				var sgpi3 = $($('td.ewTableAltRow')[196]).text().split('=')[1];
				var sgpi2 = $($('td.ewTableAltRow')[132]).text().split('=')[1];
				var sgpi1 = $($('td.ewTableAltRow')[62]).text().split('=')[1];
			*/
				var metadata = {
						name : name,
						rollNumber : rollnumber,
						dept : dept,
						scheme: "12",
						cgpi : cgpi[k-1],
						sgpi : sgpi[8],
						sgpi7 : sgpi[7],
						sgpi6 : sgpi[6],
						sgpi5 : sgpi[5],
						sgpi4 : sgpi[4],
						sgpi3 : sgpi[3],
						sgpi2 : sgpi[2],
						sgpi1 : sgpi[1],
						suppliSubject : suppliSubject

				};

				var key = rollnumber;
				if(key)
					results[key] = metadata;

				callback();
				console.log(key);


			});

			res.on('error', function(err) {
				winston.error(err);
			});


	});



	request.write(body);
	request.end();

},200);

getMarksQueue.drain = function(){
	fs.appendFile('resultabc.json', JSON.stringify(results,null,4)  + ',\n', function (err) {
		if (err){
			console.log(err);
		}
	});

	console.log("All channels processed");
};

var init = function(){
	for(i=11101; i<=11699; i++){
		getMarksQueue.push(i);
	}
}

init();

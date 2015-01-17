<!DOCTYPE html>
<script>

	// $(document).ready(function(){
	// 	document.addEventListener("change",function(){
	// 		document.forms[2][0].value
	// 	})

	// }) 
 	function displayForm() {
 		var x = document.forms[2][0].value;
 		if (x == "class") {
 			$('#yearForm').attr('style','display:none')
 			$('#deptForm').attr('style','display:none');
   	 		$('#yearForm').attr('style','display:block');
        	$('#deptForm').attr('style','display:block');
        	
   		}
      	if (x == "year") {
      		$('#yearForm').attr('style','display:none')
 			$('#deptForm').attr('style','display:none');
   	 		$('#yearForm').attr('style','display:block');
         }
   	 	if (x == "branch") {
   	 		$('#yearForm').attr('style','display:none')
 			$('#deptForm').attr('style','display:none');
         	$('#deptForm').attr('style','display:block');
     	}
     	if (x=="college"){
     		$('#yearForm').attr('style','display:none')
 			$('#deptForm').attr('style','display:none');
     	}
   	 
	}

</script>

<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "022466ca-4c5b-468b-b9b6-a1ac9338ecc4", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript" src="http://s.sharethis.com/loader.js"></script>

<html>

<head>
	<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
</head>

	<body>


		<!-- Including the tile on main page -->
		<?php
			include_once "includes/title.php" ;
		?>

		<!-- The links  -->
		<div class="row">
			<?php
				include_once "includes/header.php" ;
			?>
			</br></br>
		</div>
		
			<div class="row">

				<div class="span9 offset1">

					<p class="container text-error">
						A more interactive based result .
						Find result easiy by name,rollno. as well as by ranking.</br>
						Also comment and like feature on everyones result page</br> 
						Check out your result again!</br>
					</p>

					<!-- Search by name -->
					<form class="well form-search" action="name.php" method="POST">
						<!-- <input type = "text" name="scheme" id="schemeName" />
						<input type = "text" name="dept" id="deptName" /> -->
						<h3 class="text-info">Search by Name </h3>
						<blockquote class="text-error">Definitely , the easiest way to search anything.</blockquote>
						<div class="form-group">
							<label class="text-info"for="sel1">Year: </label>
							<select class="form-control" id="schemeName" name="scheme" required>
							    <option value="">Choose your year: </option>
							    <option value=11>Final Year</option>
							    <option value=12>Third Year</option>
							    <option value=13>Second Year</option>
							    <option value=14>First Year</option>
							</select>
						</div>
						</br>
										
						<div class="form-group">
							<label class="text-info" for="sel1"> Department : </label>
							<select class="form-control" id="deptName" name="dept" required>
							  	<option value="">Choose department</option>option>
							    <option value="CED">Civil </option>
							    <option value="MED">Mechanical</option>
							    <option value="CSE">Computer Science</option>
							    <option value="EEE">Electrical</option>
							  	<option value="CHD">Chemical</option>
							  	<option value="ARCH">Architecture</option>
							  	<option value="EEE">Electronics & Comm.</option>
							</select>
						</div> 
						</br>
						
						<input type="text" name="student" class="span6 search-query" placeholder="Search by name ...." list="nameList" required>
							<datalist id="nameList">
								<!-- data to be fetched with ajax -->
							</datalist>
						</input>
						<button class="btn btn-info"> Search </button>
					</form>

					<!-- Search by Roll Number -->
					<form class="well form-search"  action="rollno.php" method="GET">
						<h3 class="text-info">Search by Roll Number </h3>
						<blockquote class="text-error"> The Old School Boring Way</blockquote>
						<input type="text" name="roll" class="span6 search-query" placeholder="Search by Rollno."required></input>
						<button class="btn btn-info "> Search </button>
					</form>
					<!-- Search by Ranking -->
					<form class="well form-search" action="ranking.php" method="POST">
						<h3 class="text-info">Search by Rank</h3>
						<blockquote class="text-error">Wow! A new thing.Take a look of where do you stand in your class , branch , year and in the whole college </blockquote>
						<div class="form-group">
							<label for="sel1">Ranking by:</label>
							<select class="form-control" id="rankSort" name="rankSort" onchange ="displayForm()" required>
								<option value="">Choose</option>
							    <option value="class">Class</option>
							    <option value="year">Year</option>
							    <option value="college" >College</option>	    
							  	<option value="branch">Branch</option>
							</select>
						</div>
						
						<div id = 'yearForm' style="display:none;" class="form-group">
						<br>
						<label class="text-info"for="sel1">Year: </label>
							<select class="form-control" id="schemeName" name="scheme" >
							    <option value="">Choose your year: </option>
							    <option value=11>Final Year</option>
							    <option value=12>Third Year</option>
							    <option value=13>Second Year</option>
							    <option value=14>First Year</option>
							</select>
						</br>
						</div>
						
						<div class="form-group" id = 'deptForm' style="display:none;" >
							</br>
							<label class="text-info" for="sel1"> Department : </label>
							<select class="form-control" id="deptName" name="dept" >
							  	    <option value="">Choose department</option>option>
							    <option value="CED">Civil </option>
							    <option value="MED">Mechanical</option>
							    <option value="CSE">Computer Science</option>
							    <option value="EEE">Electrical</option>
							  	<option value="CHD">Chemical</option>
							  	<option value="ARCH">Architecture</option>
							  	<option value="EEE">Electronics & Comm.</option>
							  	<option value ="ECE"> ECE </option>>
							</select>
							  
						</div>	
						</br>
						<input type="text" name="rank" class="span6 search-query" placeholder="Search by Ranking...." required></input>
						<button class="btn btn-info"> Search </button>
					</form>
				</div>

				<div id="rightSide" class="span4 offset2">
					</br></br>
					<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fnithresult&amp;width=280&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true&amp;appId=172911126103721" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:290px;" allowTransparency="true"></iframe>
				</div>
			</div>

			<!-- Bottom badges -->
			<div class="row ">
				<?php require 'includes/middle.php' ?>
			</div>
				
			<div class="row" style="background: #999999; margin-top:20px;">
				<h5 class="text-center">No Rights Reserved</br>@OPEN-SOURCE</h5>
			</div>
		
		
		<!--  the facebook widget -->
		<script>
			(function(d, s, id) {
		  	var js, fjs = d.getElementsByTagName(s)[0];
		  	if (d.getElementById(id)) return;
		  	js = d.createElement(s); js.id = id;
		  	js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  	fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>

		<!-- include jquery as we need it -->
		<script src="js/jquery-1.11.1.min.js"></script>

		<!-- fetch the names using ajax -->
		<script type="text/javascript">

			document.body.onload = function() {
				var deptName = document.getElementById("deptName");
				var schemeName = document.getElementById("schemeName");
				deptName.addEventListener('change', fetchName);
				schemeName.addEventListener('change', fetchName);
			}

			function fetchName() {
				console.log('fetching names');
				var schemeName = document.getElementById("schemeName").value.trim();
				var deptName = document.getElementById("deptName").value.trim();
				var data = {
					"scheme" : schemeName,
					"dept" : deptName
				};

				$.post("autoname.php", data, function(returnedData) {
					var nameList = document.getElementById("nameList");
					nameList.innerHTML = returnedData;
					console.log(returnedData);
				});
			}
		</script>

	</body>

</html>
<script type="text/javascript">stLight.options({publisher: "022466ca-4c5b-468b-b9b6-a1ac9338ecc4", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<script>
var options={ "publisher": "022466ca-4c5b-468b-b9b6-a1ac9338ecc4", "logo": { "visible": false, "url": "", "img": "http://sd.sharethis.com/disc/images/demo_logo.png", "height": 45}, "ad": { "visible": false, "openDelay": "5", "closeDelay": "0"}, "livestream": { "domain": "", "type": "sharethis", "customColors": { "widgetBackgroundColor": "#FFFFFF", "articleLinkColor": "#006fbb"}}, "ticker": { "visible": false, "domain": "", "title": "", "type": "sharethis", "customColors": { "widgetBackgroundColor": "#1d4161", "articleLinkColor": "#FFFFFF"}}, "facebook": { "visible": false, "profile": "sharethis"}, "fblike": { "visible": false, "url": ""}, "twitter": { "visible": false, "user": "sharethis"}, "twfollow": { "visible": false}, "custom": [{ "visible": false, "title": "Custom 1", "url": "", "img": "", "popup": false, "popupCustom": { "width": 300, "height": 250}}, { "visible": false, "title": "Custom 2", "url": "", "img": "", "popup": false, "popupCustom": { "width": 300, "height": 250}}, { "visible": false, "title": "Custom 3", "url": "", "img": "", "popup": false, "popupCustom": { "width": 300, "height": 250}}], "chicklets": { "items": ["facebook", "twitter", "email", "sharethis", "wordpress", "stumbleupon"]}, "background": "#558aca", "color": "#2150a5", "arrowStyle": "light"};
var st_bar_widget = new sharethis.widgets.sharebar(options);
</script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<!-- <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54baba3e3f6d48c3" async="async"></script> -->

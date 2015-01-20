<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="css/bootstrap.css" />
	<link rel="stylesheet" href="css/mycustom.css" />
</head>

<body>

	<!-- Including the tile on main page -->
	<?php
		include_once "includes/title.php" ;
	?>

	<!-- The links  -->
	<div >
		<?php
			include_once "includes/header2.php" ;
		?>
	</div>

	<div class="row">

		<div class="span9 offset1">

			<div class="container span9 list-group-item-success" style="color:black; font-family:, cursive; padding: 20px; border-radius: 5px;
			 box-shadow:1px 1px 2px black; font-size:15px; margin-bottom:40px; text-align:justify; background:#EFF2EF;">
				A more interactive result. Find result easiy by name, roll number as well as ranking.
				With comment and like feature on everyones result page.
				Check out your result again!
			</div>
			<br/><br/>
			<!-- Search by name -->
			<form class="well form-search span9" style="margin-left:0px" action="name.php" method="POST">
				<!-- <input type = "text" name="scheme" id="schemeName" />
				<input type = "text" name="dept" id="deptName" /> -->
				<h3 class="text-info" style="font-family:Lobster">Search by Name </h3>
				<blockquote style="color:#666;">Definitely , the easiest way to search anything.</blockquote>
				<hr />
				<div class="form-group">
					<label class="text-info" for="sel1">Year: </label>
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
			<form class="well form-search span9" style="margin-left:0px" action="rollno.php" method="GET">
				<h3 class="text-info" style="font-family:Lobster">Search by Roll Number </h3>
				<blockquote style="color:#666;"> The old School Boring Way</blockquote>
				<hr />
				<input type="text" name="roll" class="span6 search-query" placeholder="Search by Rollno."required></input>
				<button class="btn btn-info "> Search </button>
			</form>

			<!-- Search by Ranking -->
			<form class="well form-search span9" style="margin-left:0px" action="ranking.php" method="POST">
				<h3 class="text-info" style="font-family:Lobster">Search by Rank</h3>
				<blockquote style="color:#666;">Wow! A new thing. Take a look of where do you stand in your class, branch, year and in the whole college </blockquote>
				<hr />
				<div class="form-group">
					<label for="sel1" class="text-info">Ranking by:</label>
					<select class="form-control" id="rankSort" name="rankSort" onchange ="displayForm()" required>
						<option value="">Choose</option>
				    <option value="class">Class</option>
				    <option value="year">Year</option>
				    <option value="college" >College</option>
				  	<option value="branch">Branch</option>
					</select>
				</div>

				<div id = 'yearForm' style="display:none;" class="form-group">
				<br />
				<label class="text-info"for="sel1">Year: </label>
					<select class="form-control" id="schemeRank" name="scheme">
				    <option value="">Choose your year: </option>
				    <option value=11>Final Year</option>
				    <option value=12>Third Year</option>
				    <option value=13>Second Year</option>
				    <option value=14>First Year</option>
					</select>
				<br />
				</div>

				<div class="form-group" id = 'deptForm' style="display:none;" >
					<br />
					<label class="text-info" for="sel1"> Department : </label>
					<select class="form-control" id="branchRank" name="dept">
				  	<option value="">Choose department</option>option>
				    <option value="CED">Civil</option>
				    <option value="EEE">Electrical</option>
				    <option value="MED">Mechanical</option>
				    <option value="ECE">Electronics &amp; Communication</option>
				    <option value="CSE">Computer Science</option>
				    <option value="ARCH">Architecture</option>
				  	<option value="CHD">Chemical</option>
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
		<h5 class="text-center">No Rights Reserved</br>@OPEN-SOURCE || Hits : <span id= "hitSpan"></span> </h5>
	</div>

	<script src="js/jQuery.js"></script>
	<script src="js/bootstrap.js"></script>

	<script type="text/javascript">
		window.onload = function() {
			var deptName = document.getElementById("deptName");
			var schemeName = document.getElementById("schemeName");
			deptName.addEventListener('change', fetchName);
			schemeName.addEventListener('change', fetchName);
			var rankSort = document.getElementById('rankSort');
			rankSort.addEventListener('change', displayForm);
			displayForm();
			fetchName();
			$("#my-button").click(function(){
				$("#my-modal").modal();
			});
			// about this
			$("#my-button2").click(function(){
				$("#my-modal2").modal();
			});
			// work with me
			$("#my-button3").click(function(){
				$("#my-modal3").modal();
			});
			// increase the hit count and show that
			hitler();
		};

		function hitler() {
			var hitSpan = document.getElementById('hitSpan');
			$.post('hits.php', {}, function(data) {
				console.log(data);
				hitSpan.innerHTML = data;
			});
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
			});
		}

		function displayForm() {
				var x = document.forms[2][0].value;
				var schemeRank = document.getElementById('schemeRank');
				var branchRank = document.getElementById('branchRank');
				if (x == "class") {
					schemeRank.setAttribute('required', true);
					branchRank.setAttribute('required', true);
					$('#yearForm').attr('style','display:none')
					$('#deptForm').attr('style','display:none');
 	 				$('#yearForm').attr('style','display:block');
			      	$('#deptForm').attr('style','display:block');
				}
				else if (x == "year") {
					schemeRank.setAttribute('required', true);
					branchRank.removeAttribute('required');
			    	$('#yearForm').attr('style','display:none')
					$('#deptForm').attr('style','display:none');
			 	 	$('#yearForm').attr('style','display:block');
			     }
			     else if (x == "branch") {
			      	schemeRank.removeAttribute('required');
					branchRank.setAttribute('required', true);
			 	 	$('#yearForm').attr('style','display:none')
					$('#deptForm').attr('style','display:none');
			      	$('#deptForm').attr('style','display:block');
		   		}
		   		else {
		   			branchRank.removeAttribute('required');
		   			schemeRank.removeAttribute('required');
		   			$('#yearForm').attr('style','display:none')
					$('#deptForm').attr('style','display:none');
			   		}
			   	}

	</script>

</body>

</html>

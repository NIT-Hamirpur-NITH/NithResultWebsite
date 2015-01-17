<!DOCTYPE html>
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
<div>
	<div class="row">

		<div class="span8 offset1">

			<p class="container text-error">
				A more interactive based result especially designed for the CSE 2012-16 BATCH.</br>
				Find result in a simple manner by name , rollno. as well as ranking.</br>
				Check out your result again!</br>
			</p>

			<!-- Search by name -->
			<form class="well form-search" action="name.php" method="POST">
				<input type = "text" name="scheme" id="schemeName" />
				<input type = "text" name="dept" id="deptName" />
				<input type="text" name="student" class="span6 search-query" placeholder="Search by name ...." list="nameList">
					<datalist id="nameList">
						<!-- data to be fetched with ajax -->
					</datalist>
				</input>
				<button class="btn btn-info"> Search </button>
			</form>

			<!-- Search by Roll Number -->
			<form class="well form-search"  action="rollno.php" method="GET">
				<input type="text" name="roll" class="span6 search-query" placeholder="Search by Rollno."></input>
				<button class="btn btn-info "> Search </button>
			</form>
			<!-- Search by Ranking -->
			<form class="well form-search" action="ranking.php" method="POST">
				<input type="text" name="rankSort" />
				<input type="text" name="scheme" />
				<input type="text" name="dept" />
				<input type="text" name="rank" class="span6 search-query" placeholder="Search by Ranking...."></input>
				<button class="btn btn-info"> Search </button>
			</form>

		</div>

	<!-- Bottom badges -->
	<div class="row span16">
		<?php require 'includes/middle.php' ?>
	</div>
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
<?php
?>

<link rel="stylesheet" href="css/bootstrap.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.css" />
<link rel="stylesheet" href="css/custom.css" />

<div class="row">
	<div class="span10 offset1">
		<div class="navbar">
			<div class="navbar-inner ">
				<ul class="nav nav-tabs lead ">
					<li><a href="main.php" >
						<div class="text-info">Home</div></a>
					</li>
					<li class="divider-vertical"></li>
					<li>
						<a href="#"><div class="text-info">Downloads</div></a>
					</li>
					<li class="divider-vertical"></li>
					<li>
						<a href="#my-modal"  id="my-button"><div class="text-info">Why this?</div></a>
					</li>
					<li class="divider-vertical"></li>
					<li>
						<a href="#my-modal2" id="my-button2"><div class="text-info">About this?</div></a>
					</li>
					<li>
						<a href="#my-modal3" id="my-button3"><div class="text-info">Work with me</div></a>
					</li>
				</ul>
			</div>
		</div>

		<!-- modal-1 why this? -->
		<div class="modal hide fade" id="my-modal">
			<div class="modal-header">
				<button class="close" data-dismiss="modal">&times;</button>
				<h1 class="text-center text-error">Why this?</h1>
			</div>
			<div class="modal-body lead">
				<p>
					I had learnt some of the basics of php and mysql during the summer
					vacations so thought of applying my skills and getting my hand rough
					so what was better than practising my skills on our very own results
					database , as mysql is all about database i did not have any better idea
					than by showing the results the better way.
				</p>
			</div>
			<div class="modal-footer">
				<a data-dismiss="modal" class="btn btn-primary ">Close</a>
			</div>
		</div>

		<!-- modal-2 about this?-->
		<div class="modal hide fade" id="my-modal2">
			<div class="modal-header">
				<button class="close" data-dismiss="modal">&times;</button>
				<h1 class="text-center text-error">About this?</h1>
			</div>
			<div class="modal-body lead">
				<p>
					The design of this website is created with Twitter Bootstrap CSS Framework
					The database is done in mysql with PHP as server scripting language.
				</p>
			</div>
			<div class="modal-footer">
				<a data-dismiss="modal" class="btn btn-primary">Close</a>
			</div>
		</div>

		<!-- modal-3 work with me-->
		<div class="modal hide fade" id="my-modal3">
			<div class="modal-header">
				<button class="close" data-dismiss="modal">&times;</button>
				<h1 class="text-center text-error">Work with me</h1>
			</div>
			<div class="modal-body lead">
				<p>
					There are always some ideas popping up in my head , but i don't have resources
	        i.e. "A TEAM" to execute them . I have various projects to work on and they can't
					be completed by myself. So if u want to work with me than you can
				</p>
			</div>
			<div class="modal-footer">
				<a data-dismiss="modal" class="btn btn-primary">Close</a>
			</div>
		</div>
	</div>
</div>

<!-- JavaScript -->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript">
	// why this
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
</script>

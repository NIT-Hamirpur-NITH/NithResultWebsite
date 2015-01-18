<?php
?>

<link rel="stylesheet" href="css/bootstrap.css" />
<link rel="stylesheet" href="css/mycustom.css" />


<div class="row">
	<div class="span10 offset1">
		<div class="navbar">
			<div class="navbar-inner ">
				<ul class="nav nav-tabs lead ">
					<li><a href="main.php" >
						<div class="text-info">Home</div></a>
					</li>
					<!-- <li class="divider-vertical"></li>
					<li>
						<a href="#"><div class="text-info">Downloads</div></a>
					 --></li>
					<li class="divider-vertical"></li>
					<li>
						<a href="#my-modal"  id="my-button"><div class="text-info">Why this?</div></a>
					</li>
					<li class="divider-vertical"></li>
					<li>
						<a href="#my-modal2" id="my-button2"><div class="text-info">Technology Stack</div></a>
					</li>
					<li>
						<a href="#my-modal3" id="my-button3"><div class="text-info">Work with us</div></a>
					</li>
				</ul>
			</div>
		</div>
		<br/>
		<!-- modal-1 why this? -->
		<div class="modal hide fade" id="my-modal">
			<div class="modal-header">
				<button class="close" data-dismiss="modal">&times;</button>
				<h1 class="text-center text-error">Why this?</h1>
			</div>
			<div class="modal-body lead">
				<p>
					The result portal of NITH looks very dull . Also there is no 
					way to find out a person by name . So we build this , just for fun . 
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
				<h1 class="text-center text-error">Technology Stack</h1>
			</div>
			<div class="modal-body lead">
				<p>
					We used the ever popular LAMP stack.
					The crawling of the NITH orignal database was done by a node.js script.
					The frontend/UI is mainly done with Twitter Bootstrap framework.
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
				<h1 class="text-center text-error">Work with us</h1>
			</div>
			<div class="modal-body lead">
				<p>
					Do you have any idea or project in your mind that is super awesome.
					We are currently working to create a NITH Event Portal 
					Want to know more . Want to help us . Then we are just a mail away

				</p>
			</div>
			<div class="modal-footer">
				<a data-dismiss="modal" class="btn btn-primary">Close</a>
			</div>
		</div>
	</div>
</div>

<!-- JavaScript -->
<script src="js/jQuery.js"></script>
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

<?php
	require 'includes/conf.inc.php';
	include_once "includes/title.php" ;
	include_once "includes/header2.php" ;


	if (isset($_POST['student'])&&!empty($_POST['student'])) {
		$student = $_POST['student'];
	} else{
		$student="";
	}

	$result = $conn->query("SELECT * from marks where name = '$student'") or die(mysqli_error($conn));

	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$name=$row['name'];
			$rollNo=$row['rollNumber'];
		}
		$pointers = $conn->query("SELECT * from marks where rollNumber = $rollNo") or die(mysqli_error($conn));
		if($pointers->num_rows > 0) {
			while($row = $pointers->fetch_assoc()) {
				$sem1 = $row["sgpi1"];
				$sem2 = $row["sgpi2"];
				$sem3 = $row["sgpi3"];
				$sem4 = $row["sgpi4"];
				$sem5 = $row["sgpi5"];
				$cgpi = $row["cgpi"];
			}
		}
//  we gonna finish the rest at the end
?>

<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>

<div class="row">
	<!-- result -->
	<div class="span10 offset1">
		<table class="table table-striped span10">
			<div class="container">
				<table class="table table-striped table-hover table-bordered">
					<tr class="info">
						<td>#1</td>
						<td> NAME</td>
						<td> <?php echo $name ?></td>
					</tr>
					<tr>
						<td>#2</td>
						<td>ROLLNO</td>
						<td id="comment_to"> <?php echo $rollNo ?></td>
					</tr>
					<tr class="info">
						<td>#3</td>
						<td>SGPI-1</td>
						<td> <?php echo $sem1 ?></td>
					</tr>
					<tr>
						<td>#4</td>
						<td>SGPI-2</td>
						<td> <?php echo $sem2 ?></td>
					</tr>
					<tr class="info">
						<td>#5</td>
						<td>SGPI-3</td>
						<td> <?php echo $sem3 ?></td>
					</tr>
					<tr>
						<td>#6</td>
						<td>SGPI-4</td>
						<td> <?php echo $sem4 ?></td>
					</tr>
					<tr>
						<td>#7</td>
						<td>SGPI-5</td>
						<td> <?php echo $sem5 ?></td>
					</tr>
					<tr class="info">
						<td>#8</td>
						<td>CGPI</td>
						<td><?php echo $cgpi ?></td>
					</tr>
				</table>
			</div>
		</table>
	</div>
</div>

<div class="row">
	<div class="span8 offset1">
		<a href="main.php"><h3>GO BACK</h3></a>
	</div>
	<!-- like -->
	<div class="span2">
		<?php
			include_once "like_box.php";
		?>
	</div>
</div>

<?php
		include_once "comment_box.php" ;
	} else {
//  we will finish it later
?>

<div class="row">
	<div class="span10 text-center text-error offset1">NO RESULT FOUND!!</div>
</div>

<?php
	}
?>

<div class="row" style="background: #999999; margin-top:20px;">
	<h5 class="text-center">No Rights Reserved</br>@OPEN-SOURCE</h5>
</div>

<script type="text/javascript">
	document.body.onload = function() {
		showComment();
		var addComment = document.getElementById("add_comment");
		addComment.addEventListener("click", needToAddComment);
		showLikes();
    var addLikes = document.getElementById("add_like");
    addLikes.addEventListener("click", needToAddLike);
	}
</script>
<?php
	require 'includes/conf.inc.php';
	include_once "includes/title.php" ;
	include_once "includes/header2.php" ;


	if (isset($_POST['rank']) && isset($_POST['rankSort'])) {
			$rank = $_POST['rank'];
			$rankSort = $_POST['rankSort'];
	} else {
		$rank = 1;
	}

	if($rankSort == 'class') {
		$branch = $_POST['dept'];
		$scheme = $_POST['scheme'];
		$query= "SELECT count(*) as total from marks where dept = '$branch' && scheme = '$scheme'";
	} else if ($rankSort == 'year') {
		$scheme = $_POST['scheme'];
		$query= "SELECT count(*) as total from marks where scheme = '$scheme'";
	} else if ($rankSort == 'branch') {
		$branch = $_POST['dept'];
		$query= "SELECT count(*) as total from marks where dept = '$branch'";
	} else {
		$query= "SELECT count(*) as total from marks";
	}
	$result = $conn->query($query) or die(mysqli_error($conn));

	if($result->num_rows > 0) {
		while($row=$result->fetch_assoc()) {
			$total = $row["total"];
		}

		if(!($rank > $total || $rank <= 0)) {
			$trank = $rank;
			if($rankSort == 'class') {
				$branch = $_POST['dept'];
				$scheme = $_POST['scheme'];
				$pointers = $conn->query("SELECT rollNumber from marks where dept = '$branch' && scheme = '$scheme' order by cgpi desc") or die(mysqli_error($conn));
			} else if ($rankSort == 'year') {
				$scheme = $_POST['scheme'];
				$pointers = $conn->query("SELECT rollNumber from marks where scheme = '$scheme' order by cgpi desc") or die(mysqli_error($conn));
			} else if ($rankSort == 'branch') {
				$branch = $_POST['dept'];
				$pointers = $conn->query("SELECT rollNumber from marks where dept = '$branch' order by cgpi desc") or die(mysqli_error($conn));
			} else {
				$pointers = $conn->query("SELECT rollNumber from marks order by cgpi desc") or die(mysqli_error($conn));
			}
			$rollNo = 0;
			if($pointers->num_rows > 0) {
				while($row = $pointers->fetch_assoc()) {
					$rollNo = $row["rollNumber"];
					$trank -= 1;
					if($trank == 0)
						break;
				}
			}
			$details = $conn->query("SELECT * from marks where rollNumber = $rollNo") or die(mysqli_error($conn));

			if($details->num_rows > 0) {
				while($row=$details->fetch_assoc()) {
					$name=$row['name'];
				}
				$pointers = $conn->query("SELECT * from marks where rollNumber = $rollNo") or die(mysqli_error($conn));
				if($pointers->num_rows > 0) {
					while($row = $pointers->fetch_assoc()) {
						$scheme = $row['scheme'];
						$dept = $row['dept'];
						$sem1 = $row["sgpi1"];
						$sem2 = $row["sgpi2"];
						$sem3 = $row["sgpi3"];
						$sem4 = $row["sgpi4"];
						$sem5 = $row["sgpi5"];
						$sem6 = $row["sgpi6"];
						$sem7 = $row["sgpi7"];
						$sem8 = $row["sgpi8"];
						$sem9 = $row["sgpi9"];
						$sem10 = $row["sgpi10"];
						$cgpi = $row["cgpi"];
					}
				}
			}
			$nr = $conn->query("SELECT rollNumber from marks order by cgpi desc");
		$collegeRank = 0;
		while($row = $nr->fetch_assoc()) {
			// print_r($row);
			$collegeRank++;
			if($rollNo == $row["rollNumber"])
				break;
		}
		$nr = $conn->query("SELECT rollNumber from marks where scheme = '$scheme' order by cgpi desc");
		$yearRank = 0;
		while($row = $nr->fetch_assoc()) {
			// print_r($row);
			$yearRank++;
			if($rollNo == $row["rollNumber"])
				break;
		}
		$nr = $conn->query("SELECT rollNumber from marks where scheme = '$scheme' && dept='$dept' order by cgpi desc");
		$classRank = 0;
		while($row = $nr->fetch_assoc()) {
			// print_r($row);
			$classRank++;
			if($rollNo == $row["rollNumber"])
				break;
		}
//  we gonna finish the rest at the end
?>

<div class="row">
	<div class="span10 offset1">
	<div class="span3"><span class='rank'><?php echo "College Rank ".$collegeRank ;?></span></div>
	<div class="span3"><span class='rank'><?php echo "Year Rank ".$yearRank ;?></span></div>
	<div class="span3"><span class='rank'><?php echo "Class Rank ".$classRank ;?></span></div>
	</div>
</div>
</br>
<div class="row">
	<!-- result -->
	<div class="span10 offset1">
		<table class="table table-striped span10">
				<table class="table table-striped table-hover table-bordered">

					<tr class="info">
						<td > Name</td>
						<td> <?php echo $name ?></td>
					</tr>

					<tr>
						<td>Roll Number</td>
						<td id="comment_to"> <?php echo $rollNo ?></td>
					</tr>

					<?php if($sem1 != -1) {	?>
					<tr class="info">
						<td>SGPI 1</td>
						<td> <?php echo $sem1 ?></td>
					</tr>
					<?php } ?>

					<?php if($sem2 != -1) {	?>
					<tr>
						<td>SGPI 2</td>
						<td> <?php echo $sem2 ?></td>
					</tr>
					<?php } ?>

					<?php if($sem3 != -1) {	?>
					<tr class="info">
						<td>SGPI 3</td>
						<td> <?php echo $sem3 ?></td>
					</tr>
					<?php } ?>

					<?php if($sem4 != -1) {	?>
					<tr>
						<td>SGPI 4</td>
						<td> <?php echo $sem4 ?></td>
					</tr>
					<?php } ?>

					<?php if($sem5 != -1) {	?>
					<tr class="info">
						<td>SGPI 5</td>
						<td> <?php echo $sem5 ?></td>
					</tr>
					<?php } ?>

					<?php if($sem6 != -1) {	?>
					<tr>
						<td>SGPI 6</td>
						<td> <?php echo $sem6 ?></td>
					</tr>
					<?php } ?>

					<?php if($sem7 != -1) {	?>
					<tr class="info">
						<td>SGPI 7</td>
						<td> <?php echo $sem7 ?></td>
					</tr>
					<?php } ?>

					<?php if($sem8 != -1) {	?>
					<tr>
						<td>SGPI 8</td>
						<td> <?php echo $sem8 ?></td>
					</tr>
					<?php } ?>

					<?php if($cgpi != -1) {	?>
					<tr >
						<td>CGPI</td>
						<td> <?php echo $cgpi ?></td>
					</tr>
					<?php } ?>

				</table>
		</table>
	</div>
	<div id="rightSide" class="span2 offset2">
			</br>
			<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fnithresult&amp;width=280&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true&amp;appId=172911126103721" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:290px;" allowTransparency="true"></iframe>
	</div>
</div>


<?php include_once "supply_box.php" ?>

<div class="row">

	<!-- like -->
	<div class="span6 offset1">
		<?php include_once "comment_box.php" ;?>
	</div>
	<div class="span5 offset1">
		<?php
			include_once "view_box.php";
		?>
	</div>
</div>

<?php

	} else {
//  we will finish it later
?>

<div class="row">
	<h1 class="span10 text-center text-error offset1">NO RESULT FOUND!!</h1>
</div>

<?php
		}
	}
?>

<div class="row" style="background: #999999; margin-top:20px;">
	<h5 class="text-center">No Rights Reserved</br>@OPEN-SOURCE || Hits : <span id= "hitSpan"></span> </h5>
</div>

<script type="text/javascript">
	window.onload = function() {
		showComment();
		var addComment = document.getElementById("add_comment");
		addComment.addEventListener("click", needToAddComment);
		addViews();
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
		hitler();
	};

	function hitler() {
		var hitSpan = document.getElementById('hitSpan');
		$.post('hits.php', {}, function(data) {
			hitSpan.innerHTML = data;
		});
	}
</script>
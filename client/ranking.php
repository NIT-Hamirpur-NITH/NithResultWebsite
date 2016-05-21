<?php
	require 'includes/conf.inc.php';

	function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
    	header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}

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
				Redirect('/result/rollno.php?roll=' . ($rollNo), false);
			} else {
				Redirect('/result/404.php', false);
			}
		} else {
			Redirect('/result/404.php', false);
		}

	} else {
		Redirect('/result/404.php', false);
	}
?>

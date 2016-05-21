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

	if (isset($_POST['student']) && isset($_POST['dept']) && isset($_POST['scheme']))  {
		$student = $_POST['student'];
		$scheme = $_POST['scheme'];
		$dept = $_POST['dept'];
	} else {
		$student="";
	}

	$result = $conn->query("SELECT * from marks where name = '$student' && dept = '$dept' && scheme = '$scheme'") or die(mysqli_error($conn));

	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$name=$row['name'];
			$rollNo=$row['rollNumber'];
		}
		Redirect('/result/rollno.php?roll=' . ($rollNo), false);
	} else {
		Redirect('/result/404.php', false);
	}

//  we gonna finish the rest at the end
?>

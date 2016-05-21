<?php
  // connect to the database
  include_once 'includes/conf.inc.php';

  $rollFor = $_POST["roll"];
  // check for the variables recieved
  if(isset($rollFor)) {
    $query = "SELECT * FROM comment_box where for_id = $rollFor";
    $result = $conn->query($query) or die(mysql_error());
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
		echo "<div class='row container'>";
			echo "<div class='span7 well'>";
				echo "<p><strong>".$row["commenter"]."</strong></p>";
				echo "<p>".$row["comment"]."</p>";
				echo "</br>";
			echo "</div>";
		echo "</div>"	;
      }
    }
  } else {
    echo "There is some error";
  }

?>
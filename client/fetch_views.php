<?php
  // connect to the database
  include_once 'includes/conf.inc.php';

  $rollFor = $_POST["roll"];
  // check for the variables recieved
  if(isset($rollFor)) {
    $query = "SELECT * FROM viewed where roll = $rollFor";
    $result = $conn->query($query) or die(mysql_error());
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo $row["viewCount"];
      }
    } else {
      echo "0";
    }
  } else {
    echo "0";
  }

?>
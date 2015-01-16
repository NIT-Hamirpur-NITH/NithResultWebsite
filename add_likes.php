<?php
  // connect to the database
  include_once 'includes/conf.inc.php';

  $rollFor = $_POST["roll"];
  // check for the variables recieved
  if(isset($rollFor)) {
    $query = "SELECT * FROM likes where roll = $rollFor";
    $result = $conn->query($query) or die(mysql_error());
    $likes = 0;
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $likes = $row["likes"];
      }
      $likes = $likes+1;
      $query = "UPDATE likes set likes=$likes where roll=$rollFor";
      if ($conn->query($query) === TRUE) {
        echo "Updated record created successfully";
      } else {
        echo "Error: " . $query . "<br>" . $conn->error;
      }
    } else {
      $query = "INSERT INTO likes(roll, likes) VALUES($rollFor, 1)";
      if ($conn->query($query) === TRUE) {
        echo "New record created successfully";
      } else {
      echo "Error: " . $query . "<br>" . $conn->error;
      }
    }
  } else {
    echo "0";
  }

?>
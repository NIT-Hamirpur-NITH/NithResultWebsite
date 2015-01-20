<?php
  // connect to the database
  include_once 'includes/conf.inc.php';

  $query = "SELECT * FROM `hits` WHERE hitler = 1 ";
  $result = $conn->query($query) or die(mysql_error($conn));
  $hitCount = 0;
  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $hitCount = $row["hitCount"];
    }
    $hitCount = $hitCount+1;
    $query = "UPDATE hits set hitCount=$hitCount where hitler = 1";
    if ($conn->query($query) === TRUE) {
      echo $hitCount;
    } else {
      echo "Error: " . $query . "<br>" . $conn->error;
    }
  } else {
    $query = "INSERT INTO hits(hitler, hitCount) VALUES(1, 1)";
    if ($conn->query($query) === TRUE) {
      echo "1";
    } else {
      echo "Error: " . $query . "<br>" . $conn->error;
    }
  }

?>
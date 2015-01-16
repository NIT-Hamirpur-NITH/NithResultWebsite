<?php
  // connect to the database
  include_once 'includes/conf.inc.php';

  $rollFor = $_POST["roll"];
  $commenter = $_POST["commenter"];
  $comment = $_POST["comment"];
  // check for the variables recieved
  if(isset($rollFor) && isset($commenter) && isset($comment)) {
    $query = "INSERT INTO comment_box(commenter, comment, for_id) VALUES('$commenter', '$comment', $rollFor)";
    if ($conn->query($query) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $query . "<br>" . $conn->error;
    }
  } else {
    echo "There is some error";
  }
?>
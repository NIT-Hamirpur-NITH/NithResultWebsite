
<?php
  // Create connection
  $conn = mysqli_connect("localhost", "resultscraper", "nitkaresult", "result");
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
 ?>

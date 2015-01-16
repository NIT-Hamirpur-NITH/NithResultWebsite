
<?php
  // Create connection
  $conn = mysqli_connect("localhost", "akshendra", "akp521994", "result");
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
 ?>
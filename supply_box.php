<div id="row">

<?php
  $sql = "SELECT * from suppy where rollNumber=$rollNo";
  $supplies = $conn->query($sql) or die(mysqli_error($conn));

  // for no supplies
  if($supplies->num_rows <= 0) {
    echo "NO SUPPLIES";
  } else {
    while($row = $supplies->fetch_assoc()) {
      echo $row['subject'];
      echo "<br />";
    }
  }
?>



</div>
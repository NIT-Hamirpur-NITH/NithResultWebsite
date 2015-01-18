<div class="row">

<?php
  $sql = "SELECT * from suppy where rollNumber=$rollNo";
  $supplies = $conn->query($sql) or die(mysqli_error($conn));

  // for no supplies
  if($supplies->num_rows <= 0) {
?>
  <div class="span9 offset1" style="color:#336633; font-family:Lobster, cursive; padding: 20px 40px; border-radius: 5px;
           box-shadow:2px 2px 10px green, -1px -1px 2px green; font-size:25px; margin-bottom:20px; text-align:center; background:#A0FFA0;">

  <?php echo "Well done, all clear"; ?>
  </div>

<?php
} else {
?>

  <div class="span9 offset1" style="color:#FF3333; font-family:Lobster, cursive; padding: 20px 40px; border-radius: 5px;
           box-shadow:2px 2px 10px red, -1px -1px 2px red; font-size:25px; margin-bottom:20px; text-align:center; background:#FFD0D0;">

  <?php echo "$supplies->num_rows supplies"; ?>
  </div>

<?php
  }
?>

</div>
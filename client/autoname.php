<?php

  require_once 'includes/conf.inc.php';

  // check if the required values are set
  if (isset($_POST['scheme'])&&isset($_POST['dept'])) {
    $scheme = $_POST['scheme'];
    $dept = $_POST['dept'];

    // fetch the name of the studenst from the data base
    $sql = "SELECT name from marks where scheme = '$scheme' && dept = '$dept'";
    // echo $sql;
    $names = $conn->query($sql) or die(mysqli_error($conn));

    // run the query
    if($names->num_rows > 0) {
      while($row = $names->fetch_assoc()) {
        echo "<option value='$row[name]'>";
      }
    } else {
      echo "No Name found";
    }

?>

<?php

  } else{
    echo "No name forund";
  }

?>
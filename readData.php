<?php
  // include the mysql server connection settings
  $servername = "localhost";
  $username = "akshendra";
  $password = "akp521994";
  $database = "result";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $database);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // parse the json
  $data = json_decode(file_get_contents("resultabc.json"), true);
  print_r($data);

  do {
    $item = current($data);
    $rollNo = key($data);
    $sql = "INSERT INTO result.marks ";
    $part1 = "(";
    $part2 = "VALUES(";
    $supply = Array();

    do {
      $curr = current($item);
      $key = key($item);
      if($key == 'suppliSubject') {
        $supply = $curr;
        continue;
      }
      $part1 = $part1.('`'.trim($key)).'`, ';

      if($key == "name" || $key == "dept") {
        $part2 = $part2.'"';
      }
      $part2 = $part2.(trim($curr));
      if($key == "name" || $key == "dept") {
        $part2 = $part2.'"';
      }
      $part2 = $part2.", ";
    } while(next($item) != null);

    $sql = $sql.(trim($part1, ', ').")").' '.(trim($part2, ', ').")");
    if ($conn->query($sql) === TRUE) {
      echo "<p>Table MyGuests created successfully <br />";
    } else {
      echo "<p>Error creating table: " . $conn->error."<br />";
   }
   echo $sql;
    echo "</p>";

        if(count($supply) > 0) {
          do {
            $subject = current($supply);
            $suplysql = 'INSERT INTO result.suppy VALUES('.$rollNo.', "'.$subject.'")';
            if ($conn->query($suplysql) === TRUE) {
              echo "<p>Added SUPPy</p>";
            } else {
              echo "<p>Error adding subject: " . $conn->error."</p>";
            }
          } while(next($supply));
        }

  } while(next($data));

?>
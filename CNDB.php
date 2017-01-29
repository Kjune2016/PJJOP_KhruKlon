<?php
//$call = "/api_dict/หิว"
function cnDB(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "dbWord";


  /*$servername = "localhost";
  $username = "plearnja_prosody";
  $password = "prosodyJune99";
  $dbname = "plearnja_prodosy";*/

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  mysqli_set_charset($conn, "utf8");

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  //echo "connect successful";
  return ($conn);
}


?>

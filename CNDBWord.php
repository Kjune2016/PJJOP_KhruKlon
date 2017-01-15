<?php
//$call = "/api_dict/หิว"
function cnDBWord(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "dbword";

  // Create connection
  $connDBWord = new mysqli($servername, $username, $password, $dbname);
  mysqli_set_charset($connDBWord, "utf8");

  // Check connection
  if ($connDBWord->connect_error) {
      die("Connection failed: " . $connDBWord->connect_error);
  }
  return ($connDBWord);
}

//echo "connect successful";

?>

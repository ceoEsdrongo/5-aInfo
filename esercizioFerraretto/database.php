<?php
$servername = "192.168.5.8";
$username = "PROF_MION";
$password = "123456";
$database = "PROF_MION";
$port = 3307; #3306

//Mi collego al database
$conn = new mysqli($servername, $username, $password, $database, $port);

if ($conn->connect_error) {
  //redirecto a una pagina di errore
  die("Connection failed: " . $conn->connect_error);
}

?>
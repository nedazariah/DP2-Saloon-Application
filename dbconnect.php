<?php

$hasError = false;

function SanitizeData($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data); 
  return $data;
}

/* Turn off error reporting */
error_reporting(0);

/* Declaring variables for database connection */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "salon";

/* Create connection with database */
$connect = @mysqli_connect($servername, $username, $password, $dbname);

if(!$connect){
	die("Connection failed: " . mysqli_connect_error());
}
?>

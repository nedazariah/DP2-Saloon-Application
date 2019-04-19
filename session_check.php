<?php
include 'dbconnect.php';
//Starts session
session_start();

//Check if the user has logged into the system, if not redirect to login page
//Does not allow access to the system for outsiders
if (!isset($_SESSION['logged']) && ($_SESSION['logged'] != true)) 
{
	header('location: login.php');
	exit();
}

//get the logged user
$user = $_SESSION['loggedUser'];
$sql = mysqli_query($connect, "SELECT * FROM staff WHERE staffID = '$user'");
$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);

$loggedUser = $row['staffID'];
$role = $row['staffRole'];
mysqli_free_result($sql);
?>

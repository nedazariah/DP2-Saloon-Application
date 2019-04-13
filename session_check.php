<?php
//Starts session
session_start();

//Check if the user has logged into the system, if not redirect to login page
//Does not allow access to the system for outsiders
if (!isset($_SESSION['logged']) && ($_SESSION['logged'] != true)) 
{
	header('location: login.php');
	exit();
}
?>

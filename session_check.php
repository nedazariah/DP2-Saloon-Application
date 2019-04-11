<?php
//Starts session
session_start();

//Check if the user has logged into the system, if not redirect to login page
//Does not allow access to the system for outsiders
if (!isset($_SESSION['userID'])) 
{
	header('location: login.php');
	exit();
}
	
//If logout is set (via clicking the Logout button), unsets the users logged in status, destroys the session and redirects to login page
if(!empty($_GET['logout']) && $_GET['logout']=='true') 
{ 
	unset($_SESSION['userID']);
	session_destroy();
	header("location: login.php");
	exit();
}
?>
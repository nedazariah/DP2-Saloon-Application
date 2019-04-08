<?php
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$name = $request->staffName;
$dob = $request->staffDOB;
$gender = $request->staffGender;
$phone = $request->staffPhone;
$email = $request->staffEmail;
$role = $request->staffRole;
$add = $request->staffAdd;

$dob = substr($dob,0,10);

$servername = "localhost";
$username = "root";
$pass = "";
$db = "saloon";

$conn = mysqli_connect($servername, $username, $pass, $db);
if (!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO staff(staffName,staffDoB,staffGender,staffPhone,staffEmail,staffRole,staffAddress) VALUES('$name','$dob','$gender','$phone','$email','$role','$add')";

    if (mysqli_query($conn,$sql)){
        echo "displaystaff.php";
	}
	else{
		echo "Failed to insert into database";
	}

?>

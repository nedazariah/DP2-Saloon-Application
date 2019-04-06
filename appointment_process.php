<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
</head>



<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $pw = "";
    $db = "saloon";
    $conn = mysqli_connect($servername, $username, $pw, $db);
    if (!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }

    $cID = $_POST["cID"];
    $cName = $_POST["cName"];
    $cPhone = $_POST["cPhone"];
    $cSv = $_POST["cSv"];
    $cDate = $_POST["cDate"];
    $cTime = $_POST["cTime"];
    $cNotes = $_POST["cNotes"];
    $sql = "INSERT INTO appointment(customerID,customerName,customerPhone,appointmentService,appointmentDate,appointmentTime,appointmentNotes) VALUES('$cID','$cName','$cPhone','$cSv','$cDate','$cTime','$cNotes')";
    if (mysqli_query($conn,$sql)){
        echo '<script type="text/javascript">alert("Successfully Submitting Enquiry");</script>';
	}
	else{
		echo '<script type="text/javascript">alert("Fail to Submit Enquiry");</script>';
	}
    
?>
<p><?php echo mysqli_error($conn)?></p>

</body>
</html>

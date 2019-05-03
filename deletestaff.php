<?php
    
    include "session_check.php";
    $staffID = $_GET['staffID'];

    $sql = "DELETE FROM staff WHERE staffID ='". $staffID ."'";

    if (mysqli_query($connect,$sql)){
        echo "Success";
        header("location: displaystaff.php");
        ob_enf_fluch();
    }

?>

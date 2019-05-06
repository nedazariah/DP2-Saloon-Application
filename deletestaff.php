<?php
    
    include "session_check.php";
    $staffID = $_GET['staffID'];

    $check = "SELECT * FROM user WHERE userID ='". $staffID . "'";

    if($result = mysqli_query($connect, $check)) {
            if(mysqli_num_rows($result) > 0) {
                $sql1 = "DELETE FROM user WHERE userID ='". $staffID ."'";
                if(mysqli_query($connect,$sql1)) {
                    $sql2 = "DELETE FROM staff WHERE staffID ='". $staffID ."'";
                    if (mysqli_query($connect,$sql2)){
                        echo "Success";
                        header("location: displaystaff.php");
                        ob_enf_fluch();
                    }
                }
            } else {
                $sql2 = "DELETE FROM staff WHERE staffID ='". $staffID ."'";
                if (mysqli_query($connect,$sql2)){
                    echo "Success";
                    header("location: displaystaff.php");
                    ob_enf_fluch();
                }
            }        
    }

?>

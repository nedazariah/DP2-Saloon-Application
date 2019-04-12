<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staffs</title>
    <meta name="language" content="english" />
    <meta name="keywords" content="Display,View,Staff,Style and Smile Saloon House, Saloon" />
    <meta name="description" content="Style and Smile Saloon House Viewing/Display Staff" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/nav_style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script>
        function updateStaff(staffID) {
            window.location.href = "editstaff.php?staffID=" + staffID;
        }

        function addStaff() {
            window.location.href = "addstaff.php";
        }

    </script>
</head>

<body>
    <?php    
    $servername = "localhost";
    $username = "root";
    $pass = "";
    $db = "salon";

    $conn = mysqli_connect($servername, $username, $pass, $db);
    $sql = "SELECT * FROM staff";
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="sideNav">
                    <button class="dropdown-btn">Appointment</button>
                    <div class="dropdown-container">
                        <a href="appointmentform.html">Add Appointment</a>
                        <a href="appointment.php">Pending Appointments</a>
                        <a href="#">All Appointments</a>
                    </div>
                    <a href="displayCustomer.php">Customers</a>
                    <a href="stock_module_display.php">Stock</a>
                    <a href="displaystaff.php">Staff</a>

                    <div class="btm-menu">
                        <button class="dropdown-btn">Settings</button>
                        <div class="dropdown-container">
                            <a href="#">Manage Users</a>
                            <a href="#">Manage Services</a>
                        </div>
                        <a href="#">Logout</a>
                    </div>
                </div>
            </div>

            <div class="col-md-10">
                <h1>Staffs</h1>
                <?php
        if($result = mysqli_query($conn, $sql)) {
            if(mysqli_num_rows($result) > 0) {
    ?>
                <table class="staffTable">
                    <tr>
                        <th>Staff ID</th>
                        <th>Staff Name</th>
                        <th>Staff Date of Birth</th>
                        <th>Staff Gender</th>
                        <th>Staff Phone No.</th>
                        <th>Staff Email</th>
                        <th>Staff Role</th>
                        <th>Staff Address</th>
                    </tr>
                    <?php
                while($row = mysqli_fetch_array($result)) { 
    ?>
                    <tr>
                        <td> <?php echo $row['staffID'] ?> </td>
                        <td> <?php echo $row['staffName'] ?> </td>
                        <td> <?php echo $row['staffDoB'] ?> </td>
                        <td> <?php echo $row['staffGender'] ?> </td>
                        <td> <?php echo $row['staffPhone'] ?> </td>
                        <td> <?php echo $row['staffEmail'] ?> </td>
                        <td> <?php echo $row['staffRole'] ?> </td>
                        <td> <?php echo $row['staffAddress'] ?> </td>
                        <td> <button type="button" onclick="updateStaff(<?php echo $row['staffID'] ?>)">Update</button> </td>
                    </tr>
                    <?php
                }
            }
        }
    ?>
                </table>
                <br>
                <button type="button" class="addStaffBtn" onclick="addStaff()">Add Staff</button>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/nav.js"></script>
</body>
</html>

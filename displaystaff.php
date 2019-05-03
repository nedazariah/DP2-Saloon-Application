<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staffs</title>
    <meta name="language" content="english" />
    <meta name="keywords" content="Display,View,Staff,Style and Smile Saloon House, Saloon" />
    <meta name="description" content="Style and Smile Saloon House Viewing/Display Staff" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/nav_style.css">
</head>

<body>
    <?php    
    include "session_check.php";
    $sql = "SELECT * FROM staff";
    $sql2 = "SELECT * FROM user";

    if($result = mysqli_query($connect, $sql2)) {
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result)) {
                    $uIDs[] = $row['userID'];
                }
            }
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="sideNav">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="dropdown-btn"><a href="#">Appointment</a>
                            <ul class="nav nav-pills nav-stacked dropdown-container">
                                <li><a href="appointmentform.php">Add Appointment</a></li>
                                <li><a href="pendingappointment.php">Pending Appointments</a></li>
                                <li><a href="appointment.php">All Appointments</a></li>
                            </ul>
                        </li>
                        
                        <li><a href="displayCustomer.php">Customers</a></li>
                        <li><a href="stock_module_display.php">Stock</a></li> 
                        <li><a href="displaystaff.php">Staff</a></li>
                    </ul>
                    
                    <div class="btm-menu">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="dropdown-btn"><a href="#">Settings</a>
                                <ul class="nav nav-stacked nav-pills dropdown-container">
                                    <li><a href="#">Manage Users</a></li>
                                    <li><a href="service_module_display.php">Manage Services</a></li>
                                </ul>
                            </li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-10">
                <h1>Staffs</h1>
                <div>
                    <input type="text" placeholder="Search..." class="fWidth" id="searchInput">
                </div>
                <br>
                <?php
        if($result = mysqli_query($connect, $sql)) {
            if(mysqli_num_rows($result) > 0) {
    ?>
                <table class="staffTable">
                    <thead>
                        <tr>
                            <th>Staff ID</th>
                            <th>Staff Name</th>
                            <th>Staff Date of Birth</th>
                            <th>Staff Gender</th>
                            <th>Staff Phone No.</th>
                            <th>Staff Email</th>
                            <th>Staff Role</th>
                            <th>Staff Address</th>
                            <th colspan="2">Action</th>
                            <th>Create Account</th>
                        </tr>
                    </thead>
                    <?php
                while($row = mysqli_fetch_array($result)) { 
    ?>
                    <tbody id="filterTable">
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
                            <td> <button type="button" onclick="deleteStaff(<?php echo $row['staffID'] ?>)">Delete</button></td>
                            <?php
                                if(in_array($row['staffID'], $uIDs)) {
                                    echo "<td>Created</td>";
                                } else {
                                    echo "<td><button type='button' onclick='')>Create</button></td>";
                                }
                            ?>
                        </tr>
                    </tbody>
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
    <script>
        function updateStaff(staffID) {
            window.location.href = "editstaff.php?staffID=" + staffID;
        }
        
        function deleteStaff(staffID) {
            if(confirm("Are you sure you want to delete this record?")) {
                window.location.href = "deletestaff.php?staffID=" + staffID;
            }
        }

        function addStaff() {
            window.location.href = "addstaff.php";
        }

        $(document).ready(function() {
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#filterTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>

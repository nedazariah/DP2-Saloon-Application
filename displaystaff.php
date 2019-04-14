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
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="sideNav">
                    <button class="dropdown-btn">Appointment</button>
                    <div class="dropdown-container">
                        <a href="appointmentform.php">Add Appointment</a>
                        <a href="appointment.php">Pending Appointments</a>
                        <a href="#">All Appointments</a>
                    </div>
                    <a href="displayCustomer.php">Customers</a>
                    <a href="stock_module_display.php">Stock</a>
                    <a href="displaystaff.php">Staff</a>
                    
                    <div class="btm-menu">
						<?php
						                        if($role == "Manager"){
						                            echo "<button class='dropdown-btn'>";
						                            echo "Settings";
						                            echo "</button>";
						                            echo "<div class='dropdown-container'>";
						                            echo "<a href='#'>";
						                            echo "Manage Users";
						                            echo "</a>";
						                            echo "<a href='#'>";
						                            echo "Manage Services";
						                            echo "</a>";
						                            echo "</div>";
						                        }
						                        echo ("<script>console.log('Role: ".$role."')</script>");
						                        ?>
                        <a href="logout.php">Logout</a>
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
                            <th>Action</th>
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

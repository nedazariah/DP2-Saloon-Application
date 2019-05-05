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
                        <?php
				            if($role == "Manager"){ 
                                echo "<li><a href='service_module_display.php'>Services</a></li>";
                                echo "<li><a href='displaystaff.php'>Staff</a></li>";
                                echo "<li class='dropdown-btn'><a href='#'>Reports</a>";
                                echo   "<ul class='nav nav-pills nav-stacked dropdown-container'>";
                                echo       "<li><a href='item_sales_report.php'>Items Sales</a></li>";
                                echo       "<li><a href='#'>Staff Performance</a></li>";
                                echo   "</ul>";
                                echo "</li>";
				            }
						    echo ("<script>console.log('Role: ".$role."')</script>");
				        ?>
                    </ul>
                    
                    <div class="btm-menu">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="user_module_account_setting.php">Account</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div> 

            <div class="col-md-10">
                <h1>Staffs</h1>
                <div>
                    <input type="text" placeholder="Search By" id="searchInput" onkeyup="filter()">
                    <select name="filterCat" id="filterCat">
                        <option value="0">ID</option>
                        <option value="1" selected="selected">Name</option>
                        <option value="2">D.O.B</option>
                        <option value="3">Gender</option>
                        <option value="4">Phone No.</option>
                        <option value="5">Email</option>
                        <option value="6">Role</option>
                        <option value="7">Address</option>
                    </select>
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
                            <th>Account</th>
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
                            <?php
                                if(in_array($row['staffID'], $uIDs)) {
                                    echo "<td><button type='button' onclick='removeAcc(" . $row['staffID'] . ")'>Remove</button></td>";
                                } else {
                                    echo "<td><button type='button' onclick='createAcc(" . $row['staffID'] . ")')>Create</button></td>";
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
    
    <script>
        function updateStaff(staffID) {
            window.location.href = "editstaff.php?staffID=" + staffID;
        }

        function addStaff() {
            window.location.href = "addstaff.php";
        }

        function filter() {
            var cat = $("#filterCat").val();
            
            var search = $("#searchInput").val().toLowerCase();
            var cat = $("#filterCat").val();
            $("#filterTable tr").filter(function() {
                $(this).toggle($(this).find("td:eq(" + cat + ")").text().toLowerCase().indexOf(search) > -1);
            });
        }
        
        function createAcc(staffID){
            if(confirm("Create account for this staff?"))
            {
                var hasPws = 0;
        
                while(hasPws == 0)
                {
                    var password = prompt("Please enter a password.");
                    
                    if(password.length > 0)
                    {
                        hasPws = 1;
                    }
                }    

                location.href = "user_module_password_set.php?target=" + staffID + "&pws=" + password; 
            }
        }
        
        function removeAcc(staffID){
            if(confirm("Remove this user from the user?"))
            {
                location.href = "user_module_delete.php?target=" + staffID;       
            }
        }
    </script>
</body>

</html>

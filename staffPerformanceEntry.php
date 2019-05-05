<!DOCTYPE html>
<html lang="en" data-ng-app="">

<head>
    <meta charset="UTF-8">
    <title>Staff Performance Entry</title>
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
                <h1>Staff Performance</h1>
                <form name="spForm" novalidate="novalidate">
                    <fieldset>
                        <legend>Staff Detail</legend>
                        <div class="form-group">
                            <label for="staffID">Staff ID: </label>
                            <select name="staffID" id="staffID" class="form-control" data-ng-model="staffID" onchange="setName(this)" required>
                                <option value="">Select An ID</option>
                                <?php
                            if($result = mysqli_query($connect, $sql)) {
                                if(mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_array($result)) {
                                        echo "<option value='".$row['staffID']."' id='".$row['staffName']."'>".$row['staffID']."</option>";
                                    }
                                }
                            }
                        ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="staffName">Staff Name: </label>
                            <input type="text" id="staffName" class="form-control" disabled>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Performance</legend>
                        <div class="form-group">
                            <label for="duration">Duration: </label>
                            <input type="month" id="duration" class="form-control" data-ng-model="duration" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="daysWorked">Day(s) Worked: </label>
                            <input type="number" id="daysWorked" class="form-control" data-ng-model="daysW" placeholder="Number of Day(s)" required>
                        </div>

                        <div class="form-group">
                            <label for="custServed">Cutomer(s) Served: </label>
                            <input type="number" id="custServed" class="form-control" data-ng-model="custS" placeholder="Number of Customer(s)" required>
                        </div>
                    </fieldset>

                    <div class="form-group text-center">
                        <button type="submit" data-ng-disabled="spForm.$invalid" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-default" onclick="window.location.replace('displaystaff.php')">Cancel</button>
                    </div>
                </form>
            </div>

        </div>
    </div>


    <script src="js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script src="js/jquery.min.js"></script>

    <script>
        function setName(id) {
            document.getElementById("staffName").value = id[id.selectedIndex].id;
        }

    </script>
</body>

</html>

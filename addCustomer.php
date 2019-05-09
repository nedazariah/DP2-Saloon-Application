<!DOCTYPE html>
<html lang="en">
<?php
	include "session_check.php"
?>

<head>
    <title>Add Customer Profile</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/cust_style.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="css/nav_style.css">
</head>

<body>
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
                <h1>Add Customer Profile</h1>
                <br />
                <form method="post" action="addCustProcess.php?action=add" onsubmit="return custValidate()">
                    <div class="form-group">
                        <label for="custFullname">Full Name</label>
                        <p><input type="text" placeholder="Full Name" id="custFullname" class="form-control" name="custFullname" /></p>
                        <p id="nameErrorMsg"></p>
                    </div>

                    <div class="form-group">
                        <label for="custDob">Date of Birth</label><br />
                        <input type="date" id="custDob" class="form-control" name="custDob" />
                        <p id="dobErrorMsg"></p>
                    </div>

                    <div class="form-group">
                        <label>Gender</label><br />
                        <input type="radio" name="custGender" id="genderF" value="Female"> Female
                        <input type="radio" name="custGender" id="genderM" value="Male"> Male
                        <p id="genderErrorMsg"></p>
                    </div>

                    <div class="form-group">
                        <label for="custType">Type</label><br />
                        <select id="custType" class="form-control" name="custType">
                            <option value="Regular">Regular</option>
                            <option value="Guest">Guest</option>
                        </select>
                        <p id="typeErrorMsg"></p>
                    </div>

                    <div class="form-group">
                        <label for="custPhoneNum">Phone Number</label><br />
                        <input type="tel" class="form-control" id="custPhoneNum" name="custPhoneNum" />
                        <p id="phoneErrorMsg"></p>
                    </div>

                    <div class="form-group">
                        <label for="custInfo">Additional Information</label><br />
                        <textarea name="custInfo" class="form-control" id="custInfo" cols="47" rows="5"></textarea>
                    </div>


                    <div class="form-group text-center">
                        <p><input type="button" class="btn btn-default" value="Cancel" onclick="window.location.replace('displayCustomer.php')">
                            <input type="submit" class="btn btn-primary" value="Submit" name="submit"></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function custValidate() {
            var isAllOK = true;
            var fullname = document.getElementById("custFullname").value;
            var dob = document.getElementById("custDob").value;
            var genderF = document.getElementById("genderF");
            var genderM = document.getElementById("genderM");
            var type = document.getElementById("custType").value;
            var phoneNum = document.getElementById("custPhoneNum").value;

            var nameErrorMsg = document.getElementById('nameErrorMsg');
            var dobErrorMsg = document.getElementById('dobErrorMsg');
            var genderErrorMsg = document.getElementById('genderErrorMsg');
            var typeErrorMsg = document.getElementById('typeErrorMsg');
            var phoneErrorMsg = document.getElementById('phoneErrorMsg');


            if (fullname == "") {
                nameErrorMsg.innerHTML = "Fullname cannot be empty";
                isAllOK = false;
            } else {
                nameErrorMsg.innerHTML = "";
            }

            if (dob == "") {
                dobErrorMsg.innerHTML = "Date of birth cannot be empty";
                isAllOK = false;
            } else {
                dobErrorMsg.innerHTML = "";
            }

            if (!genderF.checked && !genderM.checked) {
                genderErrorMsg.innerHTML = "Please select gender";
                isAllOK = false;
            } else {
                genderErrorMsg.innerHTML = "";
            }

            if (type == "") {
                typeErrorMsg.innerHTML = "Please select type";
                isAllOK = false;
            } else {
                typeErrorMsg.innerHTML = "";
            }

            if (phoneNum == "") {
                phoneErrorMsg.innerHTML = "Please enter phone number";
                isAllOK = false;
            } else {
                if (phoneNum.length > 10 || phoneNum.length < 8) {
                    phoneErrorMsg.innerHTML = "Invalid phone number format";
                    isAllOK = false;
                } else {
                    phoneErrorMsg.innerHTML = "";
                }
            }


            return isAllOK;
        }

    </script>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>

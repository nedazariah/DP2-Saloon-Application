<!DOCTYPE html>
<html lang="en">
<?php
	include "session_check.php"
?>
<head>
    <title>Add Customer Profile</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/cust_style.css">
    <link rel="stylesheet" type="text/css" href="css/nav_style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="sideNav">
                    <button class="dropdown-btn">Appointment</button>
                    <div class="dropdown-container">
                        <a href="appointmentform.php">Add Appointment</a>
                        <a href="pendingappointment.php">Pending Appointments</a>
                        <a href="appointment.php">All Appointments</a>
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
                <h1>Add Customer Profile</h1>
                <br />
                <form method="post" action="addCustProcess.php?action=add" onsubmit="return custValidate()">
                    <div class="row">
                        <div class="col-xs-6">
                            <p><input type="text" placeholder="Full Name" id="custFullname" name="custFullname" /></p>
                            <p id="nameErrorMsg"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 custForm">
                            <label for="custDob">Date of Birth</label><br />
                            <input type="date" id="custDob" name="custDob" />
                            <p id="dobErrorMsg"></p>
                        </div>
                        <div class="col-xs-6">
                            <label>Gender</label><br />
                            <input type="radio" name="custGender" id="genderF" value="Female"> F
                            <input type="radio" name="custGender" id="genderM" value="Male"> M
                            <p id="genderErrorMsg"></p>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-xs-6 custForm">
                            <label for="custType">Type</label><br />
                            <select id="custType" name="custType">
                                <option value="Regular">Regular</option>
                                <option value="Guest">Guest</option>
                            </select>
                            <p id="typeErrorMsg"></p>
                        </div>
                        <div class="col-xs-6">
                            <label for="custPhoneNum">Phone Number</label><br />
                            <input type="tel" id="custPhoneNum" name="custPhoneNum" />
                            <p id="phoneErrorMsg"></p>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-xs-12">
                            <label for="custInfo">Additional Information</label><br />
                            <textarea name="custInfo" id="custInfo" cols="47" rows="5"></textarea>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-xs-6 custButtons">
                            <input type="button" value="Cancel" onclick="window.location.replace('displayCustomer.php')">
                            <input type="submit" value="Submit" name="submit">
                        </div>
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
                }else{
                    nameErrorMsg.innerHTML = "";
                }

                if (dob == "") {
                    dobErrorMsg.innerHTML = "Date of birth cannot be empty";
                    isAllOK = false;
                }else{
                    dobErrorMsg.innerHTML = "";
                }

                if (!genderF.checked && !genderM.checked) {
                    genderErrorMsg.innerHTML = "Please select gender";
                    isAllOK = false;
                }else{
                    genderErrorMsg.innerHTML = "";
                }

                if (type == "") {
                    typeErrorMsg.innerHTML = "Please select type";
                    isAllOK = false;
                }else{
                    typeErrorMsg.innerHTML = "";
                }

                if (phoneNum == "") {
                    phoneErrorMsg.innerHTML = "Please enter phone number";
                    isAllOK = false;
                }else{
                    if (phoneNum.length > 10 || phoneNum.length < 8) {
                        phoneErrorMsg.innerHTML = "Invalid phone number format";
                        isAllOK = false;
                    }else{
                        phoneErrorMsg.innerHTML = "";
                    }
                }
            

            return isAllOK;
        }

    </script>
    <script src="js/nav.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>

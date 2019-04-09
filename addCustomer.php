<!DOCTYPE html>
<html lang="en">
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
                        <a href="#">Add Appointment</a>
                        <a href="#">Pending Appointments</a>
                        <a href="#">All Appointments</a>
                    </div>
                    <a href="displayCustomer.php">Customers</a>
                    <a href="#">Stock</a>
                    <a href="#">Staff</a>
                    
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
                <h1>Add Customer Profile</h1>
                <br />
                <form method="post" action="" onsubmit="return custValidate()">
                    <div class="row">
                        <div class="col-xs-6">
                            <p><input type="text" placeholder="Full Name" id="custFullname" name="custFullname"/></p>
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
                                <option value="Member">Regular</option>
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
                            <input type="submit" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function custValidate(){
            var isAllOK = true;
            var fullname = document.getElementById("custFullname").value;
            var dob = document.getElementById("custDob").value;
            var genderF = document.getElementById("genderF");
            var genderM = document.getElementById("genderM")
            var type = document.getElementById("custType").value;
            var phoneNum = document.getElementById("custPhoneNum").value;
            
            if (fullname == ""){
                var nameErrorMsg = document.getElementById('nameErrorMsg');
                nameErrorMsg.innerHTML = "Fullname cannot be empty";
                isAllOK = false;
            }
            
            if (dob == ""){
                var dobErrorMsg = document.getElementById('dobErrorMsg');
                dobErrorMsg.innerHTML = "Date of birth cannot be empty";
                isAllOK = false;
            }
            
//            if (genderF.checked == false || genderM.checked == false){
//                var genderErrorMsg = document.getElementById('genderErrorMsg');
//                genderErrorMsg.innerHTML = "Please select gender";
//                isAllOK = false;
//            }
            
            if (type == ""){
                var typeErrorMsg = document.getElementById('typeErrorMsg');
                typeErrorMsg.innerHTML = "Please select type";
                isAllOK = false;
            }
            
            if (phoneNum == ""){
                var phoneErrorMsg = document.getElementById('phoneErrorMsg');
                phoneErrorMsg.innerHTML = "Please enter phone number";
                if(phoneNum.length > 10 && phoneNum.length < 8){
                    phoneErrorMsg.innerHTML = "Invalid phone number format";
                    isAllOK = false;
                }
                isAllOK = false;
            }
            
            return isAllOK;
        }
    </script>
    <script src="js/nav.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php
include "session_check.php";
?>
<head>
    <meta charset="UTF-8">
    <meta name="language" content="english" />
    <meta name="keywords" content="Add,Staff,Style and Smile Saloon House, Saloon" />
    <meta name="description" content="Style and Smile Saloon House Adding Staff Form" />
    <title>Add Staff</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/nav_style.css">
</head>

<body>
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
                <h1>Add Staff</h1>
                <br>
                <div class="formContainer">
                    <form method="post" action="addstaff.php" onsubmit="return validate('add')">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="staffName" id="staffName" class="fWidth" placeholder="Full Name">
                                <span id="staffNameError" class="error"></span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="staffDOB">Date of Birth: </label>
                                    </div>
                                    <div class="col-md-6">
                                        Gender:
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="date" name="staffDOB" class="fWidth" id="staffDOB">
                                        <span id="staffDOBError" class="error"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="radio" name="staffGender" id="genderMale" value="M"> <label for="genderMale">Male</label>
                                        <input type="radio" name="staffGender" id="genderFemale" value="F"> <label for="genderFemale">Female</label>
                                        <span id="staffGenderError" class="error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="staffPhone" id="staffPhone" class="fWidth" placeholder="Phone Number">
                                <span id="staffPhoneError" class="error"></span>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="staffEmail" id="staffEmail" class="fWidth" placeholder="Email">
                                <span id="staffEmailError" class="error"></span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="staffRole">Role:</label>
                                <select name="staffRole" id="staffRole" class="fWidth">
                                    <option value="">Select a Role</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Receptionist">Receptionist</option>
                                    <option value="Hairdresser">Hairdresser</option>
                                </select>
                                <span id="staffRoleError" class="error"></span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="staffAdd">Address: </label>
                                <br>
                                <textarea rows="6" name="staffAdd" id="staffAdd" class="fWidth" placeholder="Address"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" value="Submit" class="submit" name="submit">
                                <button type="button" value="Cancel" class="cancel" onclick="window.location.replace('displaystaff.php')">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="staffFormValidation.js"></script>
    <script src="js/nav.js"></script>
</body>
<?php
    if(isset($_POST['submit'])) {
        $staffName = $_POST['staffName'];
        $staffDOB = $_POST['staffDOB'];
        $staffGender = $_POST['staffGender'];
        $staffPhone = $_POST['staffPhone'];
        $staffEmail = $_POST['staffEmail'];
        $staffRole = $_POST['staffRole'];
        $staffAdd = $_POST['staffAdd'];
        
        
        if (!$connect) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO staff(staffName,staffDoB,staffGender,staffPhone,staffEmail,staffRole,staffAddress) VALUES('$staffName','$staffDOB','$staffGender','$staffPhone','$staffEmail','$staffRole','$staffAdd')";

        if (mysqli_query($connect,$sql)){
            echo "Success";
            header("location: displaystaff.php");
            ob_enf_fluch();
        }
        else{
            echo "Failed to insert into database";
        }
    }
?>

</html>

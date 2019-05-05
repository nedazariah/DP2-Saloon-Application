<?php
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="language" content="english" />
    <meta name="keywords" content="Edit,Staff,Style and Smile Saloon House, Saloon" />
    <meta name="description" content="Style and Smile Saloon House Editing Staff Form" />
    <title>Edit Staff</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/nav_style.css">
</head>


<body>
    <?php
		include "session_check.php";
        $staffID = $_GET['staffID'];
    
        $sql = "SELECT * FROM staff WHERE staffID ='". $staffID ."'";
        if($result = mysqli_query($connect, $sql))
        {    
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
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
                <h1>Edit Staff</h1>
                <br>
                <div class="formContainer">
                    <form method="post" action="editstaff.php?staffID=<?php echo $row['staffID']?>" onsubmit="return validate('edit')">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="staffName" id="staffName" class="fWidth" placeholder="Full Name" value="<?php echo $row['staffName'] ?>">
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
                                        <input type="date" name="staffDOB" class="fWidth" id="staffDOB" value="<?php echo $row['staffDoB'] ?>">
                                        <span id="staffDOBError" class="error"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="radio" name="staffGender" id="genderMale" value="M" <?php echo ($row['staffGender'] == 'M') ? 'checked' : '' ?>> <label for="genderMale">Male</label>
                                        <input type="radio" name="staffGender" id="genderFemale" value="F" <?php echo ($row['staffGender'] == 'F') ? 'checked' : '' ?>> <label for="genderFemale">Female</label>
                                        <span id="staffGenderError" class="error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="staffPhone" id="staffPhone" class="fWidth" placeholder="Phone Number" value="<?php echo $row['staffPhone'] ?>">
                                <span id="staffPhoneError" class="error"></span>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="staffEmail" id="staffEmail" class="fWidth" placeholder="Email" value="<?php echo $row['staffEmail'] ?>">
                                <span id="staffEmailError" class="error"></span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="staffRole">Role:</label>
                                <select name="staffRole" id="staffRole" class="fWidth">
                                    <option value="">Select a Role</option>
                                    <option value="Manager" <?php echo ($row['staffRole'] == 'Manager') ? 'selected = \'selected\' ' : '' ?>>Manager</option>
                                    <option value="Receptionist" <?php echo ($row['staffRole'] == 'Receptionist') ? 'selected = \'selected\'' : '' ?>>Receptionist</option>
                                    <option value="Hairdresser" <?php echo ($row['staffRole'] == 'Hairdresser') ? 'selected = \'selected\'' : '' ?>>Hairdresser</option>
                                </select>
                                <span id="staffRoleError" class="error"></span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="staffAdd">Address: </label>
                                <br>
                                <textarea rows="6" name="staffAdd" id="staffAdd" class="fWidth" placeholder="Address"><?php echo $row['staffAddress']?></textarea>
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
                <?php
                }
            }
        }
    ?>
            </div>
        </div>
    </div>




    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="staffFormValidation.js"></script>
    
</body>
<?php
//    $staffID = $_GET['staffID'];
    if(isset($_POST['submit'])) {
        $staffName = $_POST['staffName'];
        $staffDOB = $_POST['staffDOB'];
        $staffGender = $_POST['staffGender'];
        $staffPhone = $_POST['staffPhone'];
        $staffEmail = $_POST['staffEmail'];
        $staffRole = $_POST['staffRole'];
        $staffAdd = $_POST['staffAdd'];

        $sql = "UPDATE staff SET staffName = '$staffName', staffDoB = '$staffDOB', staffGender = '$staffGender', staffPhone = '$staffPhone', staffEmail = '$staffEmail', staffRole = '$staffRole', staffAddress = '$staffAdd' WHERE staffID = '$staffID'";

        if (mysqli_query($connect,$sql)){
            echo "Success";
            header("location: displaystaff.php");
            ob_enf_fluch();
        }
        else{
            echo "Failed to update database".$staffRole;
            echo "<br><br>";
            echo mysqli_error($conn);
        }
    }
?>

</html>

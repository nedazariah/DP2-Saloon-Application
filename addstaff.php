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
    <link rel="stylesheet" href="css/nstyle.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/nav_style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="sideNav">
                    <?php
                        include "navigation.php";
                    ?>
                </div>
            </div>

            <div class="col-md-10">
                <h1>Add Staff</h1>
                <div>
                    <form method="post" action="addstaff.php" onsubmit="return validate('add')" name="asForm" novalidate="novalidate">

                        <div class="form-group">
                            <label for="staffName">Staff Name</label>
                            <input type="text" name="staffName" id="staffName" class="form-control" placeholder="Full Name">
                            <span id="staffNameError" class="text-danger"></span>
                        </div>


                        <div class="form-group">
                            <label for="staffDOB">Date of Birth</label>
                            <input type="date" name="staffDOB" id="staffDOB" class="form-control">
                            <span id="staffDOBError" class="text-danger"></span>
                        </div>


                        <div class="form-group">
                            <label>Gender</label>
                            <br>
                            <label class="radio-inline">
                                <input type="radio" name="staffGender" id="genderMale" value="M">Male
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="staffGender" id="genderFemale" value="F">Female
                            </label>                            
                            <br>
                            <span id="staffGenderError" class="text-danger"></span>
                        </div>


                        <div class="form-group">
                           <label for="staffPhone">Staff Phone No.</label>
                            <input type="text" name="staffPhone" id="staffPhone" class="form-control" placeholder="Phone Number">
                            <span id="staffPhoneError" class="text-danger"></span>
                        </div>
                        
                        <div class="form-group">
                           <label for="staffEmail">Staff Email</label>
                            <input type="email" name="staffEmail" id="staffEmail" class="form-control" placeholder="Email">
                            <span id="staffEmailError" class="text-danger"></span>
                        </div>


                        <div class="form-group">
                            <label for="staffRole">Role</label>
                            <select name="staffRole" id="staffRole" class="form-control">
                                <option value="">Select a Role</option>
                                <option value="Manager">Manager</option>
                                <option value="Receptionist">Receptionist</option>
                                <option value="Hairdresser">Hairdresser</option>
                            </select>
                            <span id="staffRoleError" class="text-danger"></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="staffAdd">Address</label>
                            <textarea rows="3" name="staffAdd" id="staffAdd" class="form-control" placeholder="Address"></textarea>
                        </div>

                        <div class="form-group text-center">
                            <input type="submit" value="Submit" class="btn btn-primary" name="submit">
                            <button type="button" value="Cancel" class="btn btn-default" onclick="window.location.replace('displaystaff.php')">Cancel</button>
                        </div>

                    </form>
                </div>




            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="staffFormValidation.js"></script>

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

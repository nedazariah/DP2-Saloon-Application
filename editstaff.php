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
                    <?php
                        include "navigation.php";
                    ?>
                </div>
            </div>



            <div class="col-md-10">
                <h1>Edit Staff</h1>
                <div>
                    <form method="post" action="editstaff.php?staffID=<?php echo $row['staffID']?>" onsubmit="return validate('edit')" novalidate="novalidate">

                        <div class="form-group">
                            <input type="text" name="staffName" id="staffName" class="form-control" placeholder="Full Name" value="<?php echo $row['staffName'] ?>">
                            <span id="staffNameError" class="text-danger"></span>
                        </div>


                        <div class="form-group">
                            <label for="staffDOB">Date of Birth: </label>
                            <input type="date" name="staffDOB" class="form-control" id="staffDOB" value="<?php echo $row['staffDoB'] ?>">
                            <span id="staffDOBError" class="text-danger"></span>
                        </div>

                        <div class="form-group">
                          <label>Gender</label>
                            <br>
                            <label class="radio-inline">
                                <input type="radio" name="staffGender" id="genderMale" value="M" <?php echo ($row['staffGender'] == 'M') ? 'checked' : '' ?>>Male
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="staffGender" id="genderFemale" value="F"<?php echo ($row['staffGender'] == 'F') ? 'checked' : '' ?>>Female
                            </label>                            
                            <br>
                            <span id="staffGenderError" class="text-danger"></span>
                        </div>


                        <div class="form-group">
                           <label for="staffPhone">Staff Phone No.</label>
                            <input type="text" name="staffPhone" id="staffPhone" class="form-control" placeholder="Phone Number" value="<?php echo $row['staffPhone'] ?>">
                            <span id="staffPhoneError" class="text-danger"></span>
                        </div>
                        
                        
                        <div class="form-group">
                           <label for="staffEmail">Email</label>
                            <input type="email" name="staffEmail" id="staffEmail" class="form-control" placeholder="Email" value="<?php echo $row['staffEmail'] ?>">
                            <span id="staffEmailError" class="text-danger"></span>
                        </div>


                        <div class="form-group">
                            <label for="staffRole">Role</label>
                            <select name="staffRole" id="staffRole" class="form-control">
                                <option value="">Select a Role</option>
                                <option value="Manager" <?php echo ($row['staffRole'] == 'Manager') ? 'selected = \'selected\' ' : '' ?>>Manager</option>
                                <option value="Receptionist" <?php echo ($row['staffRole'] == 'Receptionist') ? 'selected = \'selected\'' : '' ?>>Receptionist</option>
                                <option value="Hairdresser" <?php echo ($row['staffRole'] == 'Hairdresser') ? 'selected = \'selected\'' : '' ?>>Hairdresser</option>
                            </select>
                            <span id="staffRoleError" class="text-danger"></span>
                        </div>

                        <div class="form-group">
                            <label for="staffAdd">Address</label>
                            <br>
                            <textarea rows="6" name="staffAdd" id="staffAdd" class="form-control" placeholder="Address"><?php echo $row['staffAddress']?></textarea>
                        </div>

                        <div class="form-group text-center">
                            <input type="submit" value="Submit" class="submit btn btn-primary" name="submit">
                            <button type="button" value="Cancel" class="cancel btn btn-default" onclick="window.location.replace('displaystaff.php')">Cancel</button>
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
            echo mysqli_text-danger($conn);
        }
    }
?>

</html>

<!DOCTYPE html>
<html lang="en" data-ng-app="myApp">

<head>
    <meta charset="UTF-8">
    <meta name="language" content="english" />
    <meta name="keywords" content="Edit,Staff,Style and Smile Saloon House, Saloon" />
    <meta name="description" content="Style and Smile Saloon House Editing Staff Form" />
    <title>Edit Staff</title>
    <link rel="stylesheet" href="framework/css/bootstrap.min.css">
    <style>
        h1 {
            text-align: center;
        }

        .container {
            margin: auto;
            width: 50%;
            border: 3px solid black;
            padding: 10px;
        }

        textarea {
            resize: vertical;
        }

        .container2 {
            color: red;
            text-align: center;
            margin: auto;
            width: 50%;
        }

        button {
            float: right;
        }

        .fWidth {
            width: 100%;
        }

        .submit {
            margin: 0 auto;
        }

    </style>
</head>

<body data-ng-controller="myCtrl">

    <?php
        $staffID = $_GET['staffID'];
    
        $servername = "localhost";
        $username = "root";
        $pass = "";
        $db = "saloon";

        $conn = mysqli_connect($servername, $username, $pass, $db);
        $sql = "SELECT * FROM staff WHERE staffID ='". $staffID ."'";
        if($result = mysqli_query($conn, $sql))
        {    
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
    ?>
    <h1>Edit Staff</h1>
    <br>
    <div data-ng-init="staffName='<?php echo $row['staffName'] ?>'; staffDOB='<?php echo $row['staffDoB'] ?>'; staffGender='<?php echo $row['staffGender'] ?>'; staffPhone='<?php echo $row['staffPhone'] ?>'; staffEmail='<?php echo $row['staffEmail'] ?>'; staffRole='<?php echo $row['staffRole'] ?>'; staffAdd='<?php echo $row['staffAddress'] ?>'">
    </div>    
     <?php
                }
            }
        }
    ?>
    
    <div class="container">
        <form name="addStaffForm" novalidate>
            <div class="row">
                <div class="col-md-12">
                    <input type="text" name="staffName" class="fWidth" data-ng-model="staffName" placeholder="Full Name" data-ng-required="true">
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
                            <input type="date" name="staffDOB" class="fWidth" id="staffDOB" data-ng-model="staffDOB" value="{{staffDOB}}" data-ng-required="true">
                        </div>
                        <div class="col-md-6">
                            <input type="radio" name="staffGender" id="genderMale" value="M" data-ng-model="staffGender" data-ng-required="true"> <label for="genderMale">Male</label>
                            <input type="radio" name="staffGender" id="genderFemale" value="F" data-ng-model="staffGender" data-ng-required="true"> <label for="genderFemale">Female</label>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="staffPhone" class="fWidth" data-ng-model="staffPhone" placeholder="Phone Number" data-ng-required="true">
                </div>
                <div class="col-md-6">
                    <input type="email" name="staffEmail" class="fWidth" data-ng-model="staffEmail" placeholder="Email" data-ng-required="true">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <label for="staffRole">Role:</label>
                    <select name="staffRole" id="staffRole" class="fWidth" data-ng-model="staffRole" data-ng-required="true">
                        <option value="Manager">Manager</option>
                        <option value="Receptionist">Receptionist</option>
                        <option value="Hairdresser">Hairdresser</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <label for="staffAdd">Address: </label>
                    <br>
                    <textarea rows="6" name="staffAdd" id="staffAdd" class="fWidth" data-ng-model="staffAdd" placeholder="Address"></textarea>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" value="Update" class="submit" data-ng-click="validate()">
                    <button type="button" value="Cancel" data-ng-click="cancel()">Cancel</button>
                </div>
            </div>
        </form>
    </div>
    <br>
    <div class="container2">
        <p data-ng-repeat="Warning in Warnings">{{Warning}}</p>
    </div>

    <script src="framework/js/jquery.min.js"></script>
    <script src="framework/js/bootstrap.min.js"></script>
    <script src="framework/js/angular.min.js"></script>
    <script src="staffFormValidation.js"></script>
</body>

</html>

<?php
    ob_start();
?>
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
                    <?php
                        include "navigation.php";
                    ?>
                </div>
            </div>

            <div class="col-md-10">
                <h1>Staff Performance</h1>
                <form method="post" action="staffPerformanceEntry.php" name="spForm" novalidate="novalidate">
                    <fieldset>
                        <legend>Staff Detail</legend>
                        <div class="form-group">
                            <label for="staffID">Staff ID: </label>
                            <select name="staffID" id="staffID" class="form-control" data-ng-model="staffID" onchange="setName(this)" required>
                                <option value="">Select Staff ID</option>
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
                            <input type="text" id="staffName" name="staffName" class="form-control" disabled>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Performance</legend>
                        <div class="form-group">
                            <label for="duration">Duration: </label>
                            <input type="month" id="duration" name="duration" class="form-control" data-ng-model="duration" required>
                        </div>

                        <div class="form-group">
                            <label for="daysWorked">Day(s) Worked: </label>
                            <input type="number" id="daysWorked" name="daysWorked" class="form-control" data-ng-model="daysW" placeholder="Number of Day(s)" required>
                        </div>

                        <div class="form-group">
                            <label for="custServed">Cutomer(s) Served: </label>
                            <input type="number" id="custServed" name="custServed" class="form-control" data-ng-model="custS" placeholder="Number of Customer(s)" required>
                        </div>
                    </fieldset>

                    <div class="form-group text-center">

                        <div data-ng-if="spForm.$invalid">
                            <button type="submit" disabled class="btn btn-primary" data-ng-toggle="tooltip" title="Cannot Have Empty Field(s)">Submit</button>
                            <button type="button" class="btn btn-default" onclick="window.location.replace('staffperformance.php')">Cancel</button>
                        </div>

                        <div data-ng-if="spForm.$valid">
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            <button type="button" class="btn btn-default" onclick="window.location.replace('staffperformance.php')">Cancel</button>
                        </div>

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

<?php
    if(isset($_POST['submit'])) {
        $staffID = $_POST['staffID'];
        $duration = $_POST['duration'];
        $dWorked = $_POST['daysWorked'];
        $cServed = $_POST['custServed'];        
        
        if (!$connect) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO staff_performance(staffID, MonthYear, DaysWorked, CustServed) VALUES('$staffID','$duration','$dWorked','$cServed')";

        if (mysqli_query($connect,$sql)){
            echo "Success";
            header("location: staffperformance.php");
            ob_enf_fluch();
        }
        else{
            echo "Failed to insert into database";
        }
        
    }
?>

</html>

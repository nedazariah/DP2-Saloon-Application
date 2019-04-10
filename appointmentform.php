<!DOCTYPE html>
<html lang="en" data-ng-app="">

<head>
    <title>Appointment Booking</title>
    <meta name="viewport" content="width=device-width, initialscale=1.0" />
    <meta charset="utf-8" />
</head>

<body>

    <?php
     $servername = "localhost";
    $username = "root";
    $pw = "";
    $db = "saloon";
    $conn = mysqli_connect($servername, $username, $pw, $db);
    if (!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
        $selectService = "SELECT * FROM service";
    $resultService = mysqli_query($conn,$selectService);
    $array = array();
    class Service{
        public $serviceID;
        public $serviceName;
        public $serviceCharge;
    }
    while ($row = mysqli_fetch_assoc($resultService)){
        $service = new Service();
       $service->serviceID = $row["serviceID"];
        $service->serviceName= $row["serviceName"];
        $service->serviceCharge = $row["serviceCharge"];
       $array[] = $service;
    }
    if (isset($_POST["appointmentID"])){
        $appointmentID = $_POST["appointmentID"];
        $button = "Edit";
    }else{
        $appointmentID = NULL;
        $button = "Submit";
    }
    $select = "SELECT appointmentID,customerID,customerName,customerPhone,appointmentService,appointmentDate,appointmentTime,appointmentNotes FROM appointment WHERE appointmentID='$appointmentID'";
    $result = mysqli_query($conn,$select);
    $row = mysqli_fetch_array($result);
    ?>
    <div data-ng-init="services=<?php echo htmlspecialchars(json_encode($array));?>">
    <form name="ApplicationForm" method="post" action="appointment_process.php">
       <p><input type="hidden" name="appID" value="<?php echo $row['appointmentID'];?>"/></p>
        <p><label for="cID">Client ID:</label> <input type="text" placeholder="123456" id="cID" name="cID" value="<?php echo $row['customerID'];?>" /></p>
        <p>
        <label for="cName">Client Name:</label> <input type="text" placeholder="Hoang Huy An" id="cName" name="cName" data-ng-model="cName" data-ng-init="cName='<?php echo $row['customerName'];?>'" data-ng-pattern="/^[a-zA-Z ]{2,30}$/" />
        <span data-ng-show="checkName = ApplicationForm.cName.$dirty && ApplicationForm.cName.$invalid">Please enter a valid name{{cName}}</span></p>
        <p>
        <label for="cPhone">Client Phone Number:</label> <input type="text" placeholder="0178589581" id="cPhone" name="cPhone" data-ng-model="cPhone" data-ng-init="cPhone='<?php echo $row['customerPhone'];?>'" data-ng-pattern="/^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$/" required/>
        <span data-ng-show="checkPhone = ApplicationForm.cPhone.$dirty && ApplicationForm.cPhone.$invalid">Please enter a valid phone number</span>
        
        </p>
        <div data-ng-init="chosenID='<?php echo $row['appointmentService'];?>'"></div>
        <?php echo $row['appointmentService'];?>
        <p>{{chosenID}}</p>
       <p><label for="cSv">Customer Services</label></p>
        <select id="cSv" name="cSv" data-ng-model="cSv">
           <option data-ng-repeat="s in services" data-ng-selected = "{{defaultValue=2}}" value="{{s.serviceID}}">{{s.serviceName}}</option>
            
        </select>
       <p><label for="">Date</label></p>
        <p><input type="date" id="cDate" name="cDate" value="<?php echo $row['appointmentDate'];?>" required /></p>
        <p><label for="">Time</label></p>
        <p><input type="text" id="cTime" name="cTime" data-ng-model="cTime" data-ng-init="cTime='<?php echo $row['appointmentTime'];?>'" data-ng-pattern="/(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9])/" required/><span data-ng-show="checkTime = ApplicationForm.cTime.$dirty && ApplicationForm.cTime.$invalid">Please enter a valid Time</span></p>
        <p><label for="cNotes">Notes:</label></p>
        <textarea id="cNotes" name="cNotes"><?php echo $row['appointmentNotes'];?></textarea>
        <p><span data-ng-show="!checkName && !checkPhone && !checkTime "><input type="submit" name="cButton" value='<?php echo $button;?>'/></span></p>
        {{cPhone}}
    </form>
            </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/angular.min.js"></script>

</body>

</html>

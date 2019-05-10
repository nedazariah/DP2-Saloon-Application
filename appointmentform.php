<!DOCTYPE html>
<html lang="en" data-ng-app="myApp">
<?php
include "session_check.php";

?>
<head>
    <title>Appointment Booking</title>
    <meta name="viewport" content="width=device-width, initialscale=1.0" />
    <meta charset="utf-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <link href="css/nav_style.css" rel="stylesheet" />
    <style>
        h1 {
            text-align: center;
        }
        .contents{
            margin-right: 100px;
        }
        span{
            color:red;
        }
    </style>
</head>

<body data-ng-controller="myCtrl">
    <div class="row">
        <div class="col-md-2">
            <div class="sideNav">
            <?php
                        include "navigation.php";
                    ?>
        </div>
        </div>
        <div class="col-md-10">
            <?php
     
    if (!$connect){
        die("Connection failed: " . mysqli_connect_error());
    }
        $selectService = "SELECT * FROM service";
    $resultService = mysqli_query($connect,$selectService);
    $arrayServ = array();
    class Service{
        public $serviceID;
        public $serviceName;
        public $serviceCharge;
    }
    while ($rowServ = mysqli_fetch_assoc($resultService)){
        $service = new Service();
       $service->serviceID = $rowServ["serviceID"];
        $service->serviceName= $rowServ["serviceName"];
        $service->serviceCharge = $rowServ["serviceCharge"];
       $arrayServ[] = $service;
    }
    $num = 0;
    $i = 0;

    
    if (isset($_POST["editButton"])){
        $editButton = $_POST["editButton"];
        while($editButton!="button".$i){
            if ($editButton == "button".$i){
                break;
            }
            $i++;
        }
        
         $appointmentArray = $_POST["appointmentID"];
        $appointmentID = $appointmentArray[$i];
        $button = "Edit";
        $nameVal = true;
        $phoneVal = true;
         $select = "SELECT appointmentID,customerID,customerName,customerPhone,appointmentService,appointmentDate,appointmentTime,appointmentNotes FROM appointment WHERE appointmentID='$appointmentID'";
    $result = mysqli_query($connect,$select);
    $row = mysqli_fetch_assoc($result);
    }else{
        $appointmentID = NULL;
        $button = "Submit";
    }
    
    $selectCustomer = "SELECT * FROM customer";
    $resultCustomer = mysqli_query($connect,$selectCustomer);
    $arrayCust = array();
    class Customer{
        public $customerID;
        public $customerName;
        public $customerPhone;
    }
    while ($rowCust = mysqli_fetch_assoc($resultCustomer)){
        $customer = new Customer();
        $customer->customerID = $rowCust["customerID"];
        $customer->customerName = $rowCust["customerName"];
        $customer->customerPhone = $rowCust["customerPhone"];
        $arrayCust[] = $customer;
    }
    ?>
    <h1>Appointment Form</h1>
    <div class="container contents" data-ng-init="customers=<?php echo htmlspecialchars(json_encode($arrayCust));?>">
        <div data-ng-init="nameVal=<?php echo $nameVal;?>"></div>
        <div data-ng-init="phoneVal=<?php echo $phoneVal;?>"></div>

        <div data-ng-init="services=<?php echo htmlspecialchars(json_encode($arrayServ));?>">
            <form name="ApplicationForm" method="post" action="appointment_process.php">
                <fieldset>
                    <legend>Customer Information:</legend>
                    <div class="row">

                        <p><input type="hidden" name="appID" value="<?php echo $row['appointmentID'];?>" /></p>
                        <div class="col-md-4">
                            <p><label for="cID">Client ID:</label> <input type="text" placeholder="123456" id="cID" name="cID" data-ng-model="cID" data-ng-init="cID='<?php echo $row['customerID'];?>'" /></p>
                        </div>
                        <div class="col-md-4">
                            <p>
                                <label for="cName">Client Name:</label> <input type="text" placeholder="Hoang Huy An" id="cName" name="cName" data-ng-model="cName" data-ng-init="cName='<?php echo $row['customerName'];?>'" data-ng-change="nameChange(cName)"  />
                                <span>{{checkName}}</span></p>
                        </div>
                        <div class="col-md-4">
                            <p>
                                <label for="cPhone">Client Phone Number:</label> <input type="text" placeholder="0178589581" id="cPhone" name="cPhone" data-ng-model="cPhone" data-ng-init="cPhone='<?php echo $row['customerPhone'];?>'" data-ng-change="phoneChange(cPhone)" />
                                <span>{{checkPhone}}</span>

                            </p>

                        </div>

                    </div>
                </fieldset>
                <fieldset>
                    <legend>Appointment Details:</legend>
                    
                    <div class="row" >
                        <div class="col-md-4">
                            <p><label for="cSv">Customer Services</label></p>
                            <select id="cSv" name="cSv" data-ng-model ="cSv" data-ng-init="cSv=services[<?php echo $row['appointmentService'];?>-1].serviceID" required>
                               <option value="">--Choose Service--</option>
                                <option data-ng-repeat="s in services" value="{{s.serviceID}}">{{s.serviceName}}</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <p><label for="">Date</label></p>
                            <p><input type="date" id="cDate" name="cDate" value="<?php echo $row['appointmentDate'];?>" required /></p>
                        </div>
                        <div class="col-md-4">
                            <p><label for="">Time</label></p>
                            <p><input type="time" id="cTime" name="cTime" value="<?php echo $row['appointmentTime'];?>" required /></p>
                        </div>

                    </div>
        <p><label for="cNotes">Notes:</label></p>
        <textarea id="cNotes" name="cNotes" cols="40" rows="5"><?php echo $row['appointmentNotes'];?></textarea>
        
        <p><span data-ng-show="nameVal == true && phoneVal==true "><input type="submit" name="cButton" value='<?php echo $button;?>' data-ng-model="Button" data-ng-click="confirmation($event)" /></span></p>
       <div data-ng-init="Button='<?php echo $button;?>'"></div>
        <p><span><input type="button" name="cButton" value='Cancel' onclick="window.location.replace('appointment.php')"/></span></p>
       
        </fieldset>
        </form>
    </div>
    </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/angular.min.js"></script>

    <script>
        var app = angular.module("myApp", []);
        app.controller("myCtrl", function ($scope) {
            "use strict";
                            

            
            
            $scope.nameChange = function(input){
                $scope.pattern=/^[a-zA-Z ]{2,30}$/;
                if (input.length===0){
                    $scope.checkName="Please Input Customer Name";
                    $scope.nameVal = false;
                }else if (!input.match($scope.pattern)){
                    $scope.checkName="Please Input Valid Customer Name";
                    $scope.nameVal = false;
                }else{
                    $scope.checkName="";
                    $scope.nameVal = true;
                    
                }
                $scope.match = false;
                for ($scope.i=0;$scope.i<$scope.customers.length;$scope.i++){
                    if (input === $scope.customers[$scope.i].customerName){
                        $scope.cID = $scope.customers[$scope.i].customerID;
                        $scope.cPhone = $scope.customers[$scope.i].customerPhone;
                        $scope.match = true;
                        $scope.phoneVal = true;
                        break;  
                    }
                }
                if ($scope.match=== false){
                    $scope.cID = "";
                    $scope.cPhone ="";
                }

            };
            
            $scope.phoneChange = function(input){
                $scope.pattern=/^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$/;
                if (input.length===0){
                    $scope.checkPhone="Please Input Customer Phone";
                    $scope.phoneVal = false;
                }else if (!input.match($scope.pattern)){
                    $scope.checkPhone="Please Input Valid Customer Phone";
                    $scope.phoneVal = false;
                }else{
                    $scope.checkPhone="";
                    $scope.phoneVal = true;
                }
            };
            $scope.confirmation = function(input){
                if ($scope.Button === "Edit"){
                    $scope.check = confirm("Are you sure you want to edit this record");
                    if ($scope.check === false){
                        input.preventDefault();
                    }
                }
               
            };
            
        });
    </script>
</body>

</html>

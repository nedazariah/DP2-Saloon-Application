<!DOCTYPE html>
<html lang="en" data-ng-app="myApp">

<head>
    <title>Appointment Booking</title>
    <meta name="viewport" content="width=device-width, initialscale=1.0" />
    <meta charset="utf-8" />
        <link href="css/bootstrap.min.css" rel="stylesheet" />

     <link href="css/nav_style.css" rel="stylesheet" />
     <style>
         table,td,th{
            border: 1px solid black;
             
         }
         td,th{
             text-align: center;
             padding: 10px 25px;
         }
         table{
             border-collapse: collapse;
         }
         h1{
             text-align: center;
         }
         .contents{
             margin-right: 100px;
         }
    </style>
</head>

<body data-ng-controller="myCtrl">
    
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
                <button class="dropdown-btn">Settings</button>
                <div class="dropdown-container">
                    <a href="#">Manage Users</a>
                    <a href="#">Manage Services</a>
                </div>
                <a href="#">Logout</a>
            </div>
        </div>
   <h1>Appointment Records</h1>
    <?php
    $servername = "localhost";
    $username = "root";
    $pw = "";
    $db = "salon";
    $conn = mysqli_connect($servername, $username, $pw, $db);
    if (!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    $select = "SELECT * FROM appointment";
    $result = mysqli_query($conn,$select);
    $array = array();
    class Appointment{
        public $appointmentID;
        public $customerID;
        public $customerName;
        public $appointmentDate;
        public $appointmentTime;
        public $customerPhone;
        public $appointmentService;
        public $appointmentNotes;
    }

    while ($row = mysqli_fetch_assoc($result)){
            $appointment = new Appointment();

       $appointment->appointmentID = $row["appointmentID"];
        $appointment->customerID = $row["customerID"];
        $appointment->customerName = $row["customerName"];
        $appointment->appointmentDate = $row["appointmentDate"];
        $appointment->appointmentTime = $row["appointmentTime"];
        $appointment->customerPhone = $row["customerPhone"];
        $appointment->appointmentService = $row["appointmentService"];
        $appointment->appointmentNotes = $row["appointmentNotes"];
           $array[] = $appointment;
}

    ?>
    
    <div  class="container contents" data-ng-init="appointments=<?php echo htmlspecialchars(json_encode($array));?>" >
       <div data-ng-init="filterValue='customerName'"></div>
        <p><label for="cID">Customer ID:</label> <input type="text" name="cID" ng-model="Obj[filterValue]" id="cID" />
        <select name="cFilter" data-ng-model="cFilter" id="cFilter" data-ng-change="filterChange(cFilter)">
            <option value="customerid">Customer ID</option>
            <option value="appointmentid">Appointment ID</option>
            <option value="customername">Customer Name</option>
            <option value="date">Date</option>
            <option value="time">Time</option>
            <option value="phonenumber">Phone Number</option>
            <option value="appointmentservice">Appointment Service</option>
            
        </select>
        </p>
       <form method="post" action="appointmentform.php" class="php">
            <table >
                <tr>
                    <th>Appointment ID</th>
                    <th>customer ID</th>
                    <th>Customer Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Phone Number</th>
                    <th>Appointment Service</th>
                    <th>Description</th>
                    
                </tr>
                
                <tr   data-ng-repeat="appointment in appointments | filter:Obj">
                    
                    <td ><input type="hidden" name="appointmentID[]" value="{{appointment.appointmentID}}"/>{{appointment.appointmentID}}</td>
                    <td>{{appointment.customerID}}</td>
                    <td>{{appointment.customerName}}</td>
                    <td>{{appointment.appointmentDate}}</td>
                    <td>{{appointment.appointmentTime}}</td>
                    <td>{{appointment.customerPhone}}</td>
                    <td>{{appointment.appointmentService}}</td>
                    <td>{{appointment.appointmentNotes}}</td>
                    <td class="test"><button type="submit" name="editButton"  value="button{{$index}}">Edit</button></td>
                
                    
                </tr>
                
               
            </table>
            </form>
        
    </div>
    <p>{{appointment.apppointmentID}}</p>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/angular.min.js"></script>
    <script>
        var app = angular.module("myApp", []);
        app.controller("myCtrl", ['$scope','$window',function ($scope,$window) {
        "use strict";
            $scope.updateValues = function(value){
                $scope.appointment.apppointmentID =  $scope.appointments[value].appointmentID;
            };
            $scope.filterChange = function(value){
                if (value === "appointmentid"){
                    $scope.filterValue="appointmentID";
                }else if(value==="customername"){
                    $scope.filterValue="customerName";
                }else if (value==="customerid"){
                    $scope.filterValue="customerID";
                }else if (value==="date"){
                    $scope.filterValue="appointmentDate";
                }else if (value==="time"){
                    $scope.filterValue="appointmentTime";
                }else if(value==="phonenumber"){
                    $scope.filterValue="customerPhone";     
                }else if(value==="appointmentservice"){
                    $scope.filterValue="appointmentService";
                }
              
            };
        }]);
    </script>
</body>

</html>

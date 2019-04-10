<!DOCTYPE html>
<html lang="en" data-ng-app="myApp">

<head>
    <title>Appointment Booking</title>
    <meta name="viewport" content="width=device-width, initialscale=1.0" />
    <meta charset="utf-8" />
</head>

<body data-ng-controller="myCtrl">
    <h1>Appointment Records</h1>
    <?php
    $servername = "localhost";
    $username = "root";
    $pw = "";
    $db = "saloon";
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
    <div ></div>
    <div  data-ng-init="appointments=<?php echo htmlspecialchars(json_encode($array));?>">
        <p><label for="cID">Customer ID:</label> <input type="text" name="cID" data-ng-model="Obj.customerID" id="cID" /></p>
        /**/
        <form method="post" >
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
                    <td ><input type="text" name="appointmentID" data-ng-model="appointment.appointmentID" />{{appointment.appointmentID}}</td>
                    <td>{{appointment.customerID}}</td>
                    <td>{{appointment.customerName}}</td>
                    <td>{{appointment.appointmentDate}}</td>
                    <td>{{appointment.appointmentTime}}</td>
                    <td>{{appointment.customerPhone}}</td>
                    <td>{{appointment.appointmentService}}</td>
                    <td>{{appointment.appointmentNotes}}</td>
                    <td><button type="submit" data-ng-click="updateValues($index)">Edit</button></td>
                    
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
        }]);
    </script>
</body>

</html>

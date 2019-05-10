<!DOCTYPE html>
<html lang="en" data-ng-app="myApp">
<?php
    include "session_check.php";

?>
<head>
    
    <title>All Appointments</title>
    
    <meta name="viewport" content="width=device-width, initialscale=1.0" />
    <meta charset="utf-8" />
    
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <link href="css/nav_style.css" rel="stylesheet" />
    <link href="css/nstyle.css?v=<?php echo time(); ?>" rel="stylesheet"/>     
    
    <style>      
        th, td{  
            padding: .5em; 	
            text-align: center;
        }

        #searchInput{
            padding: 0.4em;
            margin: 1em auto;
        }

        #filter_options{
            height: 2.5em; 
            margin-top: 1em;
            margin-right: 0.5em;
            margin-left: 0.5em;
        }

        #display_table{
            margin: 0 auto;
            width: 90%;
            text-align: center;
        } 

        #display_module_manager{
            text-align: left;
            margin: 0 auto;
            width: 90%;
        }

        th{
            background-color: beige;
        }
        
        .btn_action{
            background:none;
            border:none; 
            color: steelblue;
            padding-top: 0;
            cursor: pointer;            
        } 
        
        .btn_action:hover{
            text-decoration: underline;
        }        
    </style>
    
</head>

<body data-ng-controller="myCtrl" id="npage">
   
    <div class="row">
        <div class="col-md-2">
            <div class="sideNav">
            <?php
                        include "navigation.php";
                    ?>
            </div>
        </div>
        
        <div class="col-md-10">
           
            <h1>All Appointments</h1>
    <?php
    
    if (!$connect){
        die("Connection failed: " . mysqli_connect_error());
    }
    $select = "SELECT * FROM appointment";
    $result = mysqli_query($connect,$select);
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
    
            <div class="container" data-ng-init="appointments=<?php echo htmlspecialchars(json_encode($array));?>" >
                
                <div id='display_module_manager'>
                    <div data-ng-init="filterValue='customerName'"></div>
                    <input type="text" name="cID" ng-model="Obj[filterValue]" id="searchInput" placeholder="{{FilterSelect}}"/>

                    <select name="cFilter" data-ng-model="cFilter" id="cFilter" data-ng-change="filterChange(cFilter)" data-ng-init="cFilter='customername'" style="height: 2.5em; margin-top: 1em; margin-right: 0.5em; margin-left: 0.5em">
                        <option value="customerid">Customer ID</option>
                        <option value="appointmentid">Appointment ID</option>
                        <option value="customername">Customer Name</option>
                        <option value="date">Date</option>
                        <option value="time">Time</option>
                        <option value="phonenumber">Phone Number</option>
                        <option value="appointmentservice">Appointment Service</option>
                    </select>
                </div>
                
                <form method="post" action="appointmentform.php" class="php">
                    <table id='display_table' class='table table-striped table-responsive table-hover'>
                        <tr>
                            <th>Appointment ID</th>
                            <th>customer ID</th>
                            <th>Customer Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Phone Number</th>
                            <th>Appointment Service</th>
                            <th>Description</th>
                            <th colspan="2">Actions</th>
                        </tr>

                        <tr data-ng-repeat="appointment in appointments | filter:Obj">

                            <td ><input type="hidden" name="appointmentID[]" value="{{appointment.appointmentID}}"/>{{appointment.appointmentID}}</td>
                            <td>{{appointment.customerID}}</td>
                            <td>{{appointment.customerName}}</td>
                            <td>{{appointment.appointmentDate}}</td>
                            <td>{{appointment.appointmentTime}}</td>
                            <td>{{appointment.customerPhone}}</td>
                            <td>{{appointment.appointmentService}}</td>
                            <td>{{appointment.appointmentNotes}}</td>
                            <td class="test"><button type="submit" class="btn_action" name="editButton"  value="button{{$index}}">Edit</button></td>
                            <td class="test"><button type="submit" class="btn_action" name="cancel"  value="cancel{{$index}}" formaction="appointmentcancel.php" data-ng-click="confirmCancel($event)">Cancel</button></td>


                        </tr>
                    </table>
                </form>
            </div>
    
            <p>{{appointment.apppointmentID}}</p>
        
        </div>
    </div>
    
  
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/angular.min.js"></script>
    <script>
        var app = angular.module("myApp", []);
        app.controller("myCtrl", ['$scope','$window',function ($scope,$window) {
        "use strict";
            $scope.FilterSelect="Customer Name";
            $scope.updateValues = function(value){
                $scope.appointment.apppointmentID =  $scope.appointments[value].appointmentID;
            };
            $scope.filterChange = function(value){
                if (value === "appointmentid"){
                    $scope.filterValue="appointmentID";
                    $scope.FilterSelect="Appointment ID"
                }else if(value==="customername"){
                    $scope.filterValue="customerName";
                    $scope.FilterSelect="Customer Name"
                }else if (value==="customerid"){
                    $scope.filterValue="customerID";
                    $scope.FilterSelect="Customer ID"
                }else if (value==="date"){
                    $scope.filterValue="appointmentDate";
                    $scope.FilterSelect="Customer ID"
                }else if (value==="time"){
                    $scope.filterValue="appointmentTime";
                    $scope.FilterSelect="Appointment Time";
                }else if(value==="phonenumber"){
                    $scope.filterValue="customerPhone";
                    $scope.FilterSelect="Customer Phone"
                }else if(value==="appointmentservice"){
                    $scope.filterValue="appointmentService";
                    $scope.FilterSelect="Appointment Service"
                }
              
            };
            $scope.confirmCancel = function(input){
              $scope.check = confirm("Are you sure you want to delete this record");  
            if($scope.check === false){
                input.preventDefault();
            }
            };
        }]);
    </script>
</body>

</html>

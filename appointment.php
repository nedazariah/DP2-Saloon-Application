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
    <div class="row">
        <div class="col-md-2">
            <div class="sideNav">
            <button class="dropdown-btn">Appointment</button>
            <div class="dropdown-container">
                <a href="appointmentform.php">Add Appointment</a>
                <a href="pendingappointment.php">Pending Appointments</a>
                <a href="appointment.php">All Appointments</a>
            </div>
            <a href="displayCustomer.php">Customers</a>
            <a href="stock_module_display.php">Stock</a>
            <a href="displaystaff.php">Staff</a>

            <div class="btm-menu">
				<?php
				                        if($role == "Manager"){
				                            echo "<button class='dropdown-btn'>";
				                            echo "Settings";
				                            echo "</button>";
				                            echo "<div class='dropdown-container'>";
				                            echo "<a href='#'>";
				                            echo "Manage Users";
				                            echo "</a>";
				                            echo "<a href='service_module_display.php'>";
				                            echo "Manage Services";
				                            echo "</a>";
				                            echo "</div>";
				                        }
				                        echo ("<script>console.log('Role: ".$role."')</script>");
				                        ?>
                <a href="logout.php">Logout</a>
            </div>
        </div>
        </div>
        <div class="col-md-10">
            <h1>Appointment Records</h1>
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
    
    <div  class="container contents" data-ng-init="appointments=<?php echo htmlspecialchars(json_encode($array));?>" >
       <div data-ng-init="filterValue='customerName'"></div>
        <p><label for="cID"></label> <input type="text" name="cID" ng-model="Obj[filterValue]" id="cID" placeholder="{{FilterSelect}}"/>
        <select name="cFilter" data-ng-model="cFilter" id="cFilter" data-ng-change="filterChange(cFilter)" data-ng-init="cFilter='customername'">
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
                    <td class="test"><button type="submit" name="cancel"  value="cancel{{$index}}" formaction="appointmentcancel.php" data-ng-click="confirmCancel($event)">Cancel</button></td>
                
                    
                </tr>
                
               
            </table>
            </form>
        
    </div>
    <p>{{appointment.apppointmentID}}</p>
        </div>
    </div>
    
    <!--Javascript for Navigation Menu-->
    <script src="js/nav.js"></script>
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

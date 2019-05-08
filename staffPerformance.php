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
		table,
		td,
		th {
			border: 1px solid black;

		}

		td,
		th {
			text-align: center;
			padding: 10px 25px;
		}

		table {
			border-collapse: collapse;
		}

		h1 {
			text-align: center;
		}

		.contents {
			margin-right: 100px;
		}

	</style>
</head>

<body data-ng-controller="myCtrl">
	<div class="row">
		<div class="col-md-2">
			<div class="sideNav">
				<ul class="nav nav-pills nav-stacked">
					<li class="dropdown-btn"><a href="#">Appointment</a>
						<ul class="nav nav-pills nav-stacked dropdown-container">
							<li><a href="appointmentform.php">Add Appointment</a></li>
							<li><a href="pendingappointment.php">Pending Appointments</a></li>
							<li><a href="appointment.php">All Appointments</a></li>
						</ul>
					</li>

					<li><a href="displayCustomer.php">Customers</a></li>
					<li><a href="stock_module_display.php">Stock</a></li>
					<?php
				            if($role == "Manager"){ 
                                echo "<li><a href='service_module_display.php'>Services</a></li>";
                                echo "<li><a href='displaystaff.php'>Staff</a></li>";
                                echo "<li class='dropdown-btn'><a href='#'>Reports</a>";
                                echo   "<ul class='nav nav-pills nav-stacked dropdown-container'>";
                                echo       "<li><a href='item_sales_report.php'>Items Sales</a></li>";
                                echo       "<li><a href='staffPerformance.php'>Staff Performance</a></li>";
                                echo   "</ul>";
                                echo "</li>";
				            }
						    echo ("<script>console.log('Role: ".$role."')</script>");
				        ?>
				</ul>

				<div class="btm-menu">
					<ul class="nav nav-pills nav-stacked">
						<li><a href="user_module_account_setting.php">Account</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-10">
			<?php
    
    if (!$connect){
        die("Connection failed: " . mysqli_connect_error());
    }
	$selectstaff = "SELECT * from staff";
    $select = "SELECT * from staff_performance";
    $result = mysqli_query($connect,$select);
	$resultstaff = mysqli_query($connect,$selectstaff);
    $array = array();
    class staffPerformance{
        public $performanceID;
        public $staffID;
        public $monthYear;
        public $daysWorked;
        public $custServed;
    }
	class staff{
        public $staffID;
        public $staffName;
    }
	while ($rowstaff = mysqli_fetch_assoc($resultstaff)){
            $staff = new staff();

 
        $staff->staffID = $rowstaff["staffID"];
        $staff->staffName = $rowstaff["staffName"];
     
           $arraystaff[] = $staff;
}	
    while ($row = mysqli_fetch_assoc($result)){
            $staffPerf = new staffPerformance();

       $staffPerf->performanceID = $row["performanceID"];
        $staffPerf->staffID = $row["staffID"];
        $staffPerf->monthYear = $row["MonthYear"];
        $staffPerf->daysWorked = $row["DaysWorked"];
        $staffPerf->custServed = $row["CustServed"];
           $array[] = $staffPerf;
}

    ?>
			<h1>Staff Performance Report</h1>
			<div class="col-md-12" data-ng-init="staffPerfsInit(<?php echo htmlspecialchars(json_encode($array));?>,<?php echo htmlspecialchars(json_encode($arraystaff));?>)">
				<div class="row">
					<div class="col-md-12">
						<h2 class="text-center">Staff Performance</h2>
						<div class="table-responsive">
							<table class="table table-striped table-bordered">
								<tr>
									<th>Performance ID</th>
									<th>Staff ID</th>
									<th>Month Year</th>
									<th>Days Worked</th>
									<th>Number of Customer Served</th>
								</tr>
								<tr data-ng-repeat="sp in staffPerfs">
									<td>{{sp.performanceID}}</td>
									<td>{{sp.staffID}}</td>
									<td>{{sp.monthYear}}</td>
									<td>{{sp.daysWorked}}</td>
									<td>{{sp.custServed}}</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="col-md-12">
						<h2 class="text-center">Chart</h2>
						<div id="staffChart"></div>
					</div>
				</div>
			</div>

		</div>

	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="framework/code/highcharts.js"></script>
	<script src="js/angular.min.js"></script>

	<script>
		var app = angular.module("myApp", []);
		app.controller("myCtrl", function($scope) {
			$scope.staffPerfsInit = function(input, input1) {
				$scope.staffdayswork = [];
				$scope.staffarray = input1;
				$scope.daysperformance = [];

				$scope.staffPerfs = input;


				$scope.daysworkArray = new Array($scope.staffarray.length);
				$scope.custServeArray = new Array($scope.staffarray.length);
				for ($scope.i = 0; $scope.i < $scope.staffarray.length; $scope.i = $scope.i + 1) {
					$scope.daysworkArray[$scope.i] = new Array();
					$scope.custServeArray[$scope.i] = new Array();
				}
				for ($scope.i = 0; $scope.i < $scope.staffPerfs.length; $scope.i++) {
					for ($scope.j = 0; $scope.j < $scope.staffarray.length; $scope.j++) {
						if ($scope.staffPerfs[$scope.i].staffID === $scope.staffarray[$scope.j].staffID) {
							$scope.staffdayswork.push(parseInt($scope.staffPerfs[$scope.i].daysWorked));
							$scope.daysworkArray[$scope.j].push(parseInt($scope.staffPerfs[$scope.i].daysWorked));
							$scope.custServeArray[$scope.j].push(parseInt($scope.staffPerfs[$scope.i].custServed))
						}
					}
				}
				for ($scope.f = 0; $scope.f < $scope.staffarray.length; $scope.f++) {
					$scope.daysperformance.push({
						name: $scope.staffarray[$scope.f].staffID,
						data: $scope.daysworkArray[$scope.f],
						stack: 'Days Worked'
					}, {
						name: $scope.staffarray[$scope.f].staffID,
						data: $scope.custServeArray[$scope.f],
						stack: 'Customers Served'
					});
				}

				Highcharts.chart('staffChart', {

					chart: {
						type: 'column'
					},

					title: {
						text: 'Staff Performance'
					},

					xAxis: {
						categories: ['Jan',
							'Feb',
							'Mar',
							'Apr',
							'May',
							'Jun',
							'Jul',
							'Aug',
							'Sep',
							'Oct',
							'Nov',
							'Dec'
						]
					},

					yAxis: {
						allowDecimals: false,
						min: 0,
						title: {
							text: 'Figures'
						}
					},

					tooltip: {
						formatter: function() {
							return '<b>' + this.series.options.stack + '</b><br/>' +
								this.series.name + ': ' + this.y + '<br/>' +
								'Total: ' + this.point.stackTotal;
						}
					},

					plotOptions: {
						column: {
							stacking: 'normal'
						}
					},

					series: $scope.daysperformance
				});
			}
		});

	</script>
</body>

</html>

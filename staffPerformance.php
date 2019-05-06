<!DOCTYPE html>
<html lang="en" data-ng-app="">
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

<body >
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
    $select = "SELECT * from staff_performance";
    $result = mysqli_query($connect,$select);
    $array = array();
    class staffPerformance{
        public $performanceID;
        public $staffID;
        public $monthYear;
        public $daysWorked;
        public $custServed;
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
			<div class="col-md-12" data-ng-init="staffPerfs=<?php echo htmlspecialchars(json_encode($array));?>">
				<div class="row">
					<div class="col-md-6">
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
				</div>
			</div>

		</div>

	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/angular.min.js"></script>
</body>

</html>

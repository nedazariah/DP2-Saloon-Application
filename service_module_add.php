<!DOCTYPE html>
<html lang="en">
<?php
include "session_check.php";
?>
<head>
    <title>Add New Service</title>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    
	<!--Custom Style-->
	<link href="css/nstyle.css" rel="stylesheet"/>
	<link href="css/nav_style.css" rel="stylesheet"/> 
    
    <!-- jQuery – required for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- All Bootstrap plug-ins file -->
    <script src="js/bootstrap.min.js"></script>

</head>
<body> 
    
    <div id="npage">
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
               
                <form id="nform" name="nform" method="post" action="service_module_add.php">
                   
                    <div class="row">
                        <div class="col-md-12">
                            <h1>New Service</h1>                    
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" id="serviceName" name="serviceName" placeholder="Service Name (required)" required="required" maxlength="30"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="serviceCharge">Service Fee:</label><input type="number" id="serviceCharge" name="serviceCharge" maxlength="6"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" name="add" id="formSubmit_change">Add</button> 
                            <a href="service_module_display.php" id="formSubmit_back">Go Back</a>
                        </div>
                    </div>
                </form>                       
            </div>
        </div>
<?php
//Form data processing block
if($_SERVER["REQUEST_METHOD"] == "POST")
{	
    //Initialize all inventory fields
    $serviceName = $serviceCharge = "";
    
	//Processing Service Name <Start>
    $input_serviceName = SanitizeData($_POST["serviceName"]);
	
	//Check if service record already exists
	$checkSQL = "SELECT * FROM service WHERE serviceName = '$input_serviceName'";
	$result = mysqli_query($connect, $checkSQL);
	$service = mysqli_fetch_assoc($result);
	if($service)
	{
		echo "Error: Service already exists" . "</br>";
		$hasError = true;
	}
	else if(empty($input_serviceName))
    {
		echo "Error: Input service name not found." . "</br>";
		$hasError = true;
    }
	else
	{
        $serviceName = $input_serviceName;
    }	
    mysqli_free_result($result);
	//Processing Service Name <End>
    
	//Processing Service Charge <Start>
    $input_serviceCharge = SanitizeData($_POST["serviceCharge"]);
    
    if(empty($input_serviceCharge))
    {
		$serviceCharge = null;
    }
	else
	{
        $serviceCharge = $input_serviceCharge;
	}
	//Processing Service Charge <End>
    
	//If there is no error count, proceed to insert data
	if(!($hasError)) 
	{
		$sql = "INSERT INTO service (serviceName, serviceCharge) VALUES ('$serviceName', '$serviceCharge')";
		
		if (mysqli_query($connect, $sql)) {
            header("location: service_module_display.php");
			exit();
        }
		else
		{
			echo "Error: " . $sql . "</br>" . die(mysqli_error($connect));
		} 		
	}
	else
	{
		echo "Error: Please check input fields.";
	}	
    
    mysqli_close($connect);
}
?>
    </div>
            
<!--Javascript for Navigation Menu-->
<script src="js/nav.js"></script>
<!--Javascript for Back button-->
<script src="js/service_process.js"></script>
</body>
</html>

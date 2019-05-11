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
	<link href="css/nav_style.css" rel="stylesheet"/>
    <style>
        h1{
            text-align: center;
        }
        
        .btn{
            width: 10em;
        }
    </style>  
    
    <!-- jQuery – required for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- All Bootstrap plug-ins file -->
    <script src="js/bootstrap.min.js"></script>

</head>
<body> 
    
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
               
                <h1>New Service</h1>
                
                <form id="nform" name="nform" method="post" action="service_module_add.php">
                   
                    <div class="form-group">
                        <label for="serviceName">Service Name:</label>
                        <input type="text" id="serviceName" name="serviceName" class="form-control" required="required" value="<?php echo $_POST["serviceName"]; ?>" maxlength="30"/>
                        <span id="serviceNameError" class="text-danger"></span>
                    </div>
                                                
                    <div class="form-group">
                        <label for="serviceCharge">Service Fee:</label>
                        <input type="number" id="serviceCharge" name="serviceCharge" class="form-control" maxlength="6"/>
                    </div>    
                    
                    <div class="form-group text-center">        
                        <button type="submit" name="add" class="btn btn-primary">Add</button> 
                        <a href="service_module_display.php" class="btn btn-default">Go Back</a>
                    </div>

                </form>   
                              
            </div>
        </div>
<?php
//Message variable to be used for back-end validation
$message = $server_comm_error = "";
        
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
		$message = "Service already exists.";
		$hasError = true;
	}
	else if(empty($input_serviceName))
    {
		$message =  "Service name not found.";
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
			$server_comm_error = "Error: " . $sql . "</br>" . die(mysqli_error($connect));
		} 		
	}
    
    mysqli_close($connect);
}
?>
    </div>
            

<!--Javascript for Back button-->
<script src="js/service_process.js"></script>
<!--Back-end form validation error output-->
<script>
    var error_msg = "<?php echo $message; ?>";
    var server_error = "<?php echo $server_comm_error; ?>";
    
    if(error_msg.length !== 0)
    {
        document.getElementById("serviceNameError").innerHTML = error_msg;
    }
    
    if(server_error.length !== 0)
    {
        alert(server_error);
    }
</script>
</body>
</html>

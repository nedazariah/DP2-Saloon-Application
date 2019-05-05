<!DOCTYPE html>
<html lang="en">
<?php
include "session_check.php";
?>
<head>
    <title>Update Stock</title>
    
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
                                echo "<li class='dropdown-btn'><a href='#'>Reports</a>";
                                echo   "<ul class='nav nav-pills nav-stacked dropdown-container'>";
                                echo       "<li><a href='item_sales_report.php'>Items Sales</a></li>";
                                echo       "<li><a href='#'>Staff Performance</a></li>";
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
//Form data processing block
if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    //Initialize all inventory fields
    $itemName = $itemDesc = $itemType = $itemBPrice = $itemSPrice = $itemQuantity = $message = "";   
    
    $hasError = false;
    
	$target = $_POST['target'];
    
	//Processing Item Name <Start>
    $input_itemName = SanitizeData($_POST["itemName"]);
	
	//Check if item record already exists
	$checkSQL = "SELECT * FROM inventory WHERE itemName = '$input_itemName' AND itemID != $target";
	$result = mysqli_query($connect, $checkSQL);
	$item = mysqli_fetch_assoc($result);
	if($item)
	{
		$message .= "Error: Item already exists </br>";
		$hasError = true;
	}
	else if(empty($input_itemName))
    {
		$message .= "Error: Input item name not found </br>";
		$hasError = true;
    }
	else
	{
        $itemName = $input_itemName;
    } 
	//Processing Item Name <End>
    
	//Processing Item Description <Start>
    $input_itemDesc = SanitizeData($_POST["itemDesc"]);
    
    if(empty($input_itemDesc)){
		$itemDesc = null;
    }
	else
	{
        $itemDesc = $input_itemDesc;
	}	
    //Processing Item Description <End>
    
	//Processing Item Type <Start>
    $input_itemType = SanitizeData($_POST["itemType"]);
    
    if(empty($input_itemType))
    {
		$itemType = null;
    }
	else
	{
        $itemType = $input_itemType;
	}
	//Processing Item Description <End>
    
	//Processing Item BPrice <Start>
    $input_itemBPrice = SanitizeData($_POST["itemBPrice"]);
    
    if(empty($input_itemBPrice))
    {
		$itemBPrice = null;
    }
	else
	{
        $itemBPrice = $input_itemBPrice;
	}
	//Processing Item BPrice <End> 
    
    //Processing Item SPrice <Start>
    $input_itemSPrice = SanitizeData($_POST["itemSPrice"]);
    
    if(empty($input_itemSPrice))
    {
		$itemSPrice = null;
    }
	else
	{
        $itemSPrice = $input_itemSPrice;
	}
	//Processing Item SPrice <End>
    
    //Processing Item Quantity <Start>
    $input_itemQuantity = SanitizeData($_POST["itemQuantity"]);
    
    if(empty($input_itemQuantity)){
		$itemQuantity = null;
    }
	else
	{
        $itemQuantity = $input_itemQuantity;
	}
	//Processing Item Quantity <End>
    
    submit($itemName, $itemDesc, $itemType, $itemBPrice, $itemSPrice, $itemQuantity, $hasError, $target, $connect, $message);
}
else
{
    if(isset($_GET['target']) && !empty(trim($_GET['target'])))
    {
        $target = trim($_GET['target']);

        $sql = "SELECT * FROM inventory WHERE itemID = '$target'";
        if (mysqli_query($connect, $sql)) 
        {
            $results = mysqli_query($connect, $sql);
            $row = mysqli_fetch_array($results);

            $itemName = $row['itemName'];
            $itemDesc = $row['itemDesc'];
            $itemType = $row['itemType'];
            $itemBPrice = $row['itemBPrice'];
            $itemSPrice = $row['itemSPrice'];
            $itemQuantity = $row['itemQuantity'];
            
            mysqli_free_result($results);
        }
        else 
        {
            alertUser("Error: " . $sql . "</br>" . die(mysqli_error($connect)));
        }

        mysqli_close($connect);	
    }
    else
    {
        header("location: stock_module_display.php");
        exit();
    }
}
?>
                <form id="nform" name="nform" method="post" action="stock_module_edit.php">
                   
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Update Stock</h1>                    
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" id="itemName" name="itemName" placeholder="Product Name  (required)"  required="required" value="<?php echo $itemName; ?>"/> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <textarea name="itemDesc" id="itemDesc" placeholder="Description"><?php echo $itemDesc; ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" id="itemType" name="itemType" placeholder="Product Type" maxlength="50" value="<?php echo $itemType; ?>"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="itemBPrice">Buying Price:</label><input type="number" id="itemBPrice" name="itemBPrice" value="<?php echo $itemBPrice; ?>"/> 
                            <label for="itemSPrice">Selling Price:</label><input type="number" id="itemSPrice" name="itemSPrice" value="<?php echo $itemSPrice; ?>"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="itemQuantity">Number of stock:</label><input type="number" id="itemQuantity" name="itemQuantity" value="<?php echo $itemQuantity; ?>"/>
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="target" id="target" value="<?php echo $target; ?>"/>
                               
                            <button type="submit" name="update" id="formSubmit_change">Update</button> 
                            <a href="stock_module_display.php" id="formSubmit_back">Go Back</a>
                        </div>
                    </div>
                </form>
<?php 
function submit($itemName, $itemDesc, $itemType, $itemBPrice, $itemSPrice, $itemQuantity, $hasError, $target, $connect, $message)
{
	//If there is no error, proceed to insert data
	if(!($hasError))
	{
		$sql = "UPDATE inventory SET itemName = '$itemName', itemDesc = '$itemDesc', itemType = '$itemType', itemBPrice = $itemBPrice, itemSPrice = $itemSPrice, itemQuantity = $itemQuantity WHERE itemID = $target";
		
		if (mysqli_query($connect, $sql)) {
            $link_summary = "stock_module_summary.php?target=" . $target;
			header("location: $link_summary");
			exit();
		}
		else 
		{
			alertUser("Error: " . $sql . "</br>" . die(mysqli_error($connect)));
		} 		
	}
	else
	{
        $message .= "Error: Please check input fields.";
        alertUser($message);
	}	
    
    mysqli_close($connect);	    
}
                
function alertUser($output){
    echo $output;
}
?>
            </div>
        </div>                
    </div>     
        

<!--Javascript for Back button-->
<script src="js/stock_process.js"></script> 
</body>
</html>

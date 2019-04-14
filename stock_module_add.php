<?php
    ob_start();
    require_once "dbconnect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add New Item</title>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    
	<!--Custom Style-->
	<link href="css/stock_style.css" rel="stylesheet"/>
	<link href="css/nav_style.css" rel="stylesheet"/> 
    
    <!-- jQuery – required for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- All Bootstrap plug-ins file -->
    <script src="js/bootstrap.min.js"></script>

</head>
<body> 
    
    <div id="stock_page">
        <div class="row">
            <div class="col-md-2">
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
            </div>           
           
            <div class="col-md-10">
               
                <form id="stock_form" name="stock_form" method="post" action="stock_module_add.php">
                   
                    <div class="row">
                        <div class="col-md-12">
                            <h1>New Item</h1>                    
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" id="itemName" name="itemName" placeholder="Product Name (required)" required="required" maxlength="50"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <textarea name="itemDesc" id="itemDesc" placeholder="Description" maxlength="250"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" id="itemType" name="itemType" placeholder="Product Type" maxlength="50"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="itemBPrice">Buying Price:</label><input type="number" id="itemBPrice" name="itemBPrice" maxlength="6"/> 
                            <label for="itemSPrice">Selling Price:</label><input type="number" id="itemSPrice" name="itemSPrice" maxlength="6"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="itemQuantity">Number of stock:</label><input type="number" id="itemQuantity" name="itemQuantity" maxlength="6"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" name="add" id="itemSubmit_change">Add</button> 
                            <a href="stock_module_display.php" id="itemSubmit_back">Go Back</a>
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
    $itemID = $itemName = $itemDesc = $itemType = $itemBPrice = $itemSPrice = $itemQuantity = "";
    
    //Generate item ID by getting number of rows
	$sql = "SELECT * FROM inventory";
	$select_items = mysqli_query($connect, $sql);
	$number_of_items = mysqli_num_rows($select_items);
    $itemID = $number_of_items + 1;
    mysqli_free_result($select_items);
    
	//Processing Item Name <Start>
    $input_itemName = SanitizeData($_POST["itemName"]);
	
	//Check if item record already exists
	$checkSQL = "SELECT * FROM inventory WHERE itemName = '$input_itemName'";
	$result = mysqli_query($connect, $checkSQL);
	$item = mysqli_fetch_assoc($result);
	if($item)
	{
		echo "Error: Item already exists" . "</br>";
		$hasError = true;
	}
	else if(empty($input_itemName))
    {
		echo "Error: Input item name not found." . "</br>";
		$hasError = true;
    }
	else
	{
        $itemName = $input_itemName;
    }	
    mysqli_free_result($result);
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
    
	//If there is no error count, proceed to insert data
	if(!($hasError))
	{
		$sql = "INSERT INTO inventory (itemID, itemName, itemDesc, itemType, itemBPrice, itemSPrice, itemQuantity) VALUES ('$itemID', '$itemName', '$itemDesc', '$itemType', '$itemBPrice', '$itemSPrice', '$itemQuantity')";
		
		if (mysqli_query($connect, $sql)) {
            $link_summary = "stock_module_summary.php?target=" . $itemID;
            header("location: $link_summary");
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
<script src="js/stock_process.js"></script>
</body>
</html>

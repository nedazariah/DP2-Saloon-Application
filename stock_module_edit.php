<?php
    require_once "dbconnect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Stock</title>
    
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
<?php
//Form data processing block
if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    //Initialize all inventory fields
    $itemName = $itemDesc = $itemType = $itemBPrice = $itemSPrice = $itemQuantity = "";   
    
    $hasError = false;
    
	$target = $_POST['target'];
    
	//Processing Item Name <Start>
    $input_itemName = SanitizeData($_POST["itemName"]);
	
	if(empty($input_itemName))
    {
		echo "Error: Input item name not found." . "</br>";
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
			echo "Error: " . $sql . "</br>" . die(mysqli_error($connect));
		} 		
	}
	else
	{
		echo "Error: Please check input fields.";
	}	
    
    mysqli_close($connect);	
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
        }
        else 
        {
            echo "Error: " . $sql . "</br>" . die(mysqli_error($connect));
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

        <div id="stock_page">
           
            <div class="row">
               
                <div class="col-md-2">
                    <div class="sideNav">
                        <button class="dropdown-btn">Appointment</button>
                        <div class="dropdown-container">
                            <a href="#">Add Appointment</a>
                            <a href="#">Pending Appointments</a>
                            <a href="#">All Appointments</a>
                        </div>
                        <a href="#">Customers</a>
                        <a ref="stock_module_display.php">Stock</a>
                        <a href="#">Staff</a>

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
                    
                    <form id="stock_form" name="stock_form" method="post" action="stock_module_edit.php" onsubmit="return confirm('Confirm stock update?')">
                   
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Update Stock</h1>                    
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" id="itemName" name="itemName" placeholder="Product Name  (required)" required="required" value="<?php echo $itemName; ?>"/> 
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
                               
                                <button type="submit" name="update" id="itemSubmit_change">Update</button> 
                                <a href="stock_module_display.php" id="itemSubmit_back">Go Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>                
        </div>
		
<?php    
mysqli_free_result($results);	
?>         

<!--Javascript for Navigation Menu-->
<script src="js/nav.js"></script>
<!--Javascript for Back button-->
<script src="js/stock_process.js"></script> 
</body>
</html>

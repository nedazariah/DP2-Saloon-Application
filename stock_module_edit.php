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

<?php
//Message variable to be used for back-end validation
$message = $server_comm_error = "";
                
//Form data processing block
if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    //Initialize all inventory fields
    $itemName = $itemDesc = $itemType = $itemBPrice = $itemSPrice = $itemQuantity = "";   
    
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
		$message = "Item already exists.";
		$hasError = true;
	}
	else if(empty($input_itemName))
    {
		$message = "Input item name not found.";
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
			$server_comm_error = "Error: " . $sql . "</br>" . die(mysqli_error($connect));
		} 		
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
            
            mysqli_free_result($results);
        }
        else 
        {
            $server_comm_error = "Error: " . $sql . "</br>" . die(mysqli_error($connect));
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
                <h1>Update Stock</h1> 
                
                <form name="nform" method="post" action="stock_module_edit.php">
                   
                    <input type="hidden" name="target" id="target" value="<?php echo $target; ?>"/>    
                     
                    <div class="form-group">
                       
                        <label for="itemName">Item Name:</label>
                        
                        <input type="text" class="form-control"
                        id="itemName" name="itemName" 
                        required="required"
                        value="<?php 
                               if($_SERVER["REQUEST_METHOD"] == "POST")
                                   echo $_POST["itemName"];
                               else
                                   echo $itemName; ?>"/>
                        
                        <span id="itemNameError" class="text-danger"></span>
                        
                    </div> 
                       
                    <div class="form-group">
                       
                        <label for="itemDesc">Item Description:</label>
                        
                        <textarea name="itemDesc" id="itemDesc" class="form-control"><?php 
                            if($_SERVER["REQUEST_METHOD"] == "POST")
                                   echo $_POST["itemDesc"];
                            else
                                echo $itemDesc; ?></textarea>
                        
                    </div>
                    
                    <div class="form-group">
                        
                        <label for="itemType">Item Type:</label> 
                       
                        <input type="text" class="form-control"
                        id="itemType" name="itemType" 
                        maxlength="50" 
                        value="<?php 
                               if($_SERVER["REQUEST_METHOD"] == "POST")
                                   echo $_POST["itemType"];
                               else 
                                   echo $itemType; ?>"/>
                        
                    </div>
                    
                    <div class="form-group">
                       
                        <label for="itemBPrice">Buying Price:</label>
                        
                        <input type="number" class="form-control" 
                        id="itemBPrice" name="itemBPrice" 
                        value="<?php 
                                if($_SERVER["REQUEST_METHOD"] == "POST")
                                    echo $_POST["itemBPrice"];
                                else 
                                    echo $itemBPrice; ?>"/>
                        
                    </div>
                    
                    <div class="form-group">
                       
                        <label for="itemSPrice">Selling Price:</label>
                        
                        <input type="number" class="form-control" 
                        id="itemSPrice" name="itemSPrice" 
                        value="<?php 
                                if($_SERVER["REQUEST_METHOD"] == "POST")
                                    echo $_POST["itemSPrice"];
                                else 
                                    echo $itemSPrice; ?>"/>
                        
                    </div>
                    
                    <div class="form-group">
                       
                        <label for="itemQuantity">Number of stock:</label>
                        
                        <input type="number" class="form-control" 
                        id="itemQuantity" name="itemQuantity" 
                        value="<?php 
                                if($_SERVER["REQUEST_METHOD"] == "POST")
                                    echo $_POST["itemQuantity"];
                                else 
                                    echo $itemQuantity; ?>"/>
                        
                    </div>   
                    
                    <div class="form-group text-center">        
                        <button type="submit" name="update" class="btn btn-primary">Update</button> 
                        <a href="stock_module_display.php" class="btn btn-default">Go Back</a>
                    </div>
                    
                </form>
            </div>
        </div>                
    </div>     
        

<!--Javascript for Back button-->
<script src="js/stock_process.js"></script>
<!--Back-end form validation error output-->
<script>
    var error_msg = "<?php echo $message; ?>";
    var server_error = "<?php echo $server_comm_error; ?>";
    
    if(error_msg.length !== 0)
    {
        document.getElementById("itemNameError").innerHTML = error_msg;
    }
    
    if(server_error.length !== 0)
    {
        alert(server_error);
    }
</script>
</body>
</html>

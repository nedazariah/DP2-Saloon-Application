<!DOCTYPE html>
<html lang="en">
<?php
include "session_check.php";
?>
<head>
    <title>Inventory Change Summary</title>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    
	<!--Custom Style-->
	<link href="css/nstyle.css" rel="stylesheet"/>
	<link href="css/nav_style.css" rel="stylesheet"/>
   
    <!--Internal CSS for PHP Generatred elements-->
    <style>        
        th, td{  
            padding: .5em; 	
            text-align: center;
        }

        #inventory_table{
            margin: 0 auto;
            margin-top: 2em;
            width: 90%;
            text-align: center;
        }

        th{
            background-color: beige;
        }
    </style>
    
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
                    <?php
                        include "navigation.php";
                    ?>
                </div>
            </div>
		
            <div class="col-md-10">
               
                <div class="row">
                    <div class="col-md-12">
                        <h1>Inventory Change Summary</h1>         
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-12">
                    
                                                          
<?php
//Form processing block
if(isset($_GET['target']) && !empty(trim($_GET['target'])))
{ 
    $target = trim($_GET['target']);

    $sql = "SELECT * FROM inventory WHERE itemID = '$target'";
		
	if (mysqli_query($connect, $sql)) 
	{
        $results = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($results);
        
        echo "<table id='inventory_table' class='table table-striped table-responsive table-hover'>";
            echo "<tr>";
                echo "<th>Item Name</th>";
                echo "<th>Description</th>";
                echo "<th>Type</th>";
                echo "<th>Buying Price (RM)</th>";
                echo "<th>Selling Price (RM)</th>";
                echo "<th>Quantity</th>";
                echo "<th>Action</th>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>" . $row['itemName'] . "</td>";
                echo "<td>" . $row['itemDesc'] . "</td>";
                echo "<td>" . $row['itemType'] . "</td>"; 
                echo "<td>" . $row['itemBPrice'] . "</td>";
                echo "<td>" . $row['itemSPrice'] . "</td>";
                echo "<td>" . $row['itemQuantity'] . "</td>"; 
                echo "<td><a href='stock_module_edit.php?target=". $row['itemID'] ."'>Update</a></td>";
            echo "</tr>";
        echo "</table>";
        
        mysqli_free_result($results);
    }
	else 
	{
		echo "Error: " . $sql . "</br>" . die(mysqli_error($connect));
	}
	
    mysqli_close($connect);	
} 
else
{
    mysqli_close($connect);	
    header("location: stock_module_display.php");
    exit();
}                    
?>  
                        <br/><br/><br/>
                        
                        <a class="btn btn-default" href='stock_module_display.php'>View All Stock</a>
                                 
                        <a class="btn btn-default" href='stock_module_add.php'>Record New Item</a>
                                  
                    </div>
                </div> 
            </div>
        </div>
    </div>
    

</body>
</html>

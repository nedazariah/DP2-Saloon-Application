<?php
    require_once "dbconnect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Inventory Display</title>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    
	<!--Custom Style-->
	<link href="css/stock_style.css" rel="stylesheet"/>
	<link href="css/nav_style.css" rel="stylesheet"/>
   
    <!--Internal CSS for PHP Generatred elements-->
    <style>        
    th{
        background-color: #ddd;
    } 

    th, td{  
        padding: .5em;
        border: 1px solid black; 	
    }
    
    #searchInput{
        padding: 0.4em;
        margin: 1em auto;
        margin-right: 0.5em;
    }
        
    #display_table{
        margin: 0 auto;
        width: 90%;
        
        font-size: 1.2em;
        text-align: left;
        color: black;

        border-collapse: collapse;
    } 
        
    #display_module_manager{
        text-align: left;
        margin: 0 auto;
        width: 90%;
    }
    </style>
    
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
                        <a href="#">Add Appointment</a>
                        <a href="#">Pending Appointments</a>
                        <a href="#">All Appointments</a>
                    </div>
                    <a href="#">Customers</a>
                    <a href="stock_module_display.php">Stock</a>
                    <a href="#">Staff</a>
                    
                    <div class="btm-menu">
                        <button class="dropdown-btn">Settings</button>
                        <div class="dropdown-container">
                            <a href="#">Manage Users</a>
                            <a href="#">Manage Services</a>
                        </div>
                        <a href="login.php">Logout</a>
                    </div>
                </div>
            </div>

            <div class="col-md-10">
               
                <div class="row">
                    <div class="col-md-12">
                        <h1>Inventory</h1>         
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-12">
                    
                                                          
<?php
$sql = "SELECT * FROM inventory";
					            
if($result = mysqli_query($connect, $sql))
{    
    if(mysqli_num_rows($result) > 0)
	{
            echo "<div id='display_module_manager'>";
            
            echo "<input type='text' id='searchInput' placeholder='Search table'/>";
            
            echo "<a href='stock_module_add.php' id='add_stock_link'>Record New Item</a>";
            
            echo "</div>";
        
            echo "<table id='display_table'>";
        
                echo "<thead>"; 
                    echo "<tr>";
                        echo "<th>Item Name</th>";
                        echo "<th>Description</th>";
                        echo "<th>Type</th>";
                        echo "<th>Buying Price (RM)</th>";
                        echo "<th>Selling Price (RM)</th>";
                        echo "<th>Quantity</th>";
                        echo "<th>Action</th>";
                    echo "</tr>";
                echo "</thead>";
        
            while($row = mysqli_fetch_array($result))
			{
                echo "<tbody id='filterTable'>";
                    echo "<tr>";
                        echo "<td>" . $row['itemName'] . "</td>";
                        echo "<td>" . $row['itemDesc'] . "</td>";
                        echo "<td>" . $row['itemType'] . "</td>"; 
                        echo "<td>" . $row['itemBPrice'] . "</td>";
                        echo "<td>" . $row['itemSPrice'] . "</td>";
                        echo "<td>" . $row['itemQuantity'] . "</td>"; 
                        echo "<td><a href='stock_module_edit.php?target=". $row['itemID'] ."'>Update</a></td>";
                    echo "</tr>";
                echo "</tbody>";
			}                           
            
            echo "</table>";

		mysqli_free_result($result);
    } 
	else
	{
		echo "<br/><p><em>No records were found.</em></p>";
	}
} 
else
{
    echo "Error: Could not execute $sql. " . mysqli_error($connect);
}

mysqli_close($connect);
?>                 
                    </div>
                </div> 
            </div>
        </div>
    </div>
    
<!--Javascript for Navigation Menu-->
<script src="js/nav.js"></script>
<script>
    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#filterTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
</body>
</html>

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
    th{
        background-color: #ddd;
    } 

    th, td{  
        padding: .5em;
        border: 1px solid black; 	
    }
        
    #inventory_table{
        margin: 0 auto;
        margin-top: 2em;
        width: 90%;
        
        font-size: 1.2em;
        text-align: left;
        color: black;

        border-collapse: collapse;
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
               
                <div class="row">
                    <div class="col-md-12">
                        <h1>Inventory Change Summary</h1>         
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-12">
                    
                                                          
<?php

if(isset($_GET['target']) && !empty(trim($_GET['target'])))
{ 
    $target = trim($_GET['target']);

    $sql = "SELECT * FROM inventory WHERE itemID = '$target'";
		
	if (mysqli_query($connect, $sql)) 
	{
        $results = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($results);
        
        echo "<table id='inventory_table'>";
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
                        
?>  
                        <br/><br/><br/>
                        
                        <a href='stock_module_display.php' id='display_link'>View All Stock</a>
                                 
                        <a href='stock_module_add.php' id='add_link'>Record New Item</a>
                                  
                    </div>
                </div> 
            </div>
        </div>
    </div>
    

</body>
</html>

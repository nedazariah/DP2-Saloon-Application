<!DOCTYPE html>
<html lang="en">
<?php
    include "session_check.php";
?>
<head>
    <title>Item Sales Report</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/nav_style.css">
    <link rel="stylesheet" type="text/css" href="css/nstyle.css">
    
    <style>
        h1{
            padding-right: 15%;
        }

        th, td{  
            padding: .5em;	
            text-align: center;
        }
        
        #header{
            background-color: beige;
            
        }
    </style>
</head>

<body>
    <div class="npage">
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
                <h1>Item Sales Report</h1><br/>
                <div class="row">
                    <div class="col-md-4">
                        <h2>Sales History</h2><br/>
                        <?php
                            $sql = "SELECT itemName, qtyPurchased, datePurchased FROM item_sales JOIN inventory WHERE item_sales.itemID = inventory.itemID";
                        
                            if($result = mysqli_query($connect, $sql)){
                                echo "<div class='table-responsive'>";
                                echo "<table class='table table-striped table-hover'>";
                                echo "<thead id='header'>";
                                    echo "<tr>";
                                    echo "<th>Item Name</th>";
                                    echo "<th>Quantity Purchased</th>";
                                    echo "<th>Date Purchased</th>";
                                    echo "</tr>";
                                echo "</thead>";
        
                            while($row = mysqli_fetch_array($result))
			             {
                                echo "<tbody>";
				                echo "<tr>";
					               echo "<td>" . $row['itemName'] . "</td>";
					               echo "<td>" . $row['qtyPurchased'] . "</td>";
					               echo "<td>" . $row['datePurchased'] . "</td>";
				                echo "</tr>";
                                echo "</tbody>";
			             }                           
                        echo "</table>"; 

		                        mysqli_free_result($result);
                                echo "</div>";
                            }
                        ?>
                    </div>
                    
                    <div class="col-md-8">
                        <h2>Monthly Sales</h2><br/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>
</body></html>

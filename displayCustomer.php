<?php
    require_once "dbconnect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customers</title>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    
	<!--Custom Style-->
	<link href="css/stock_style.css" rel="stylesheet"/>
	<link href="css/nav_style.css" rel="stylesheet"/>
   
    <!--Internal CSS for PHP Generatred table-->
    <style>
    th{
        background-color: #ddd;
    } 

    th, td{  
        padding: .5em;
        border: 1px solid black; 	
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
                    <a href="displayCustomer.php">Customers</a>
                    <a href="stock_module_display.php">Stock</a>
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
               
                <div class="row">
                    <div class="col-md-12">
                        <h1>Customers</h1>         
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-12">     
<?php
$sql = "SELECT * FROM customer";
					            
if($result = mysqli_query($connect, $sql))
{    
    if(mysqli_num_rows($result) > 0)
	{
        echo "<input type='text' id='search' onkeyup='Filter()' placeholder='Search by '>";
        echo "<a href='addCustomer.php' id='add_stock_link'>Add New Customer</a>"; 
        echo "<table id='inventory_table'>";
            echo "<tr>";
                echo "<th>Customer ID</th>";
                echo "<th>Customer Type</th>";
                echo "<th>Name</th>";
				echo "<th>Date of Birth</th>";
                echo "<th>Gender</th>";
                echo "<th>Phone Number</th>";
                echo "<th>Additional Information</th>";
				echo "<th>Action</th>";
            echo "</tr>";
        
            while($row = mysqli_fetch_array($result))
			{
				echo "<tr>";
					echo "<td>" . $row['customerID'] . "</td>";
					echo "<td>" . $row['customerType'] . "</td>";
					echo "<td>" . $row['customerName'] . "</td>"; 
                    echo "<td>" . $row['customerDoB'] . "</td>";
					echo "<td>" . $row['customerGender'] . "</td>";
					echo "<td>" . $row['customerPhone'] . "</td>";
                    echo "<td>" . $row['customerAddInfo'] . "</td>";
					echo "<td><a href='editCustomer.html?target=". $row['customerID'] ."'>Update</a></td>";
				echo "</tr>";
			}                           
        echo "</table>"; 

		mysqli_free_result($result);
    } 
	else
	{
		echo "<p><em>No records were found.</em></p>";
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
</body>
</html>
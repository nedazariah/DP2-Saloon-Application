
<!DOCTYPE html>
<html lang="en">
<?php
    include "session_check.php";
?>
<head>
    <title>Customers</title>
    
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
                        <a href="appointmentform.php">Add Appointment</a>
                        <a href="pendingappointment.php">Pending Appointments</a>
                        <a href="appointment.php">All Appointments</a>
                    </div>
                    <a href="displayCustomer.php">Customers</a>
                    <a href="stock_module_display.php">Stock</a>
		    <a href="service_module_display.php">Services</a>
                    <a href="displaystaff.php">Staff</a>
                    
                    <div class="btm-menu">
						<?php
						                        if($role == "Manager"){
						                            echo "<button class='dropdown-btn'>";
						                            echo "Settings";
						                            echo "</button>";
						                            echo "<div class='dropdown-container'>";
						                            echo "<a href='#'>";
						                            echo "Manage Users";
						                            echo "</a>";
						                            echo "<a href='#'>";
						                            echo "Manage Services";
						                            echo "</a>";
						                            echo "</div>";
						                        }
						                        echo ("<script>console.log('Role: ".$role."')</script>");
						                        ?>
                        <a href="logout.php">Logout</a>
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
        echo "<div id='display_module_manager'>";
            
        echo "<input type='text' id='searchInput' placeholder='Search table'/>";
            
        echo "<a href='addCustomer.php' id='add_stock_link'>Add new customer</a>";
            
        echo "</div>";
        
        echo "<table id='display_table'>";
        
        echo "<thead>";
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
        echo "</thead>";
        
            while($row = mysqli_fetch_array($result))
			{
                echo "<tbody id='filterTable'>";
				echo "<tr>";
					echo "<td>" . $row['customerID'] . "</td>";
					echo "<td>" . $row['customerType'] . "</td>";
					echo "<td>" . $row['customerName'] . "</td>"; 
                    echo "<td>" . $row['customerDoB'] . "</td>";
					echo "<td>" . $row['customerGender'] . "</td>";
					echo "<td>" . $row['customerPhone'] . "</td>";
                    echo "<td>" . $row['customerAddInfo'] . "</td>";
					echo "<td><a href='editCustomer.php?target=". $row['customerID'] ."'>Update</a></td>";
				echo "</tr>";
                echo "</tbody>";
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
<!--Script to control search function-->
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


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
    
    #searchInput{
        padding: 0.4em;
        margin: 1em auto;
    }
        
    #filter_options{
        height: 2.5em; 
        margin-top: 1em;
        margin-right: 0.5em;
        margin-left: 0.5em;
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
                        <li><a href="displaystaff.php">Staff</a></li>
                    </ul>
                    
                    <div class="btm-menu">
                        <ul class="nav nav-pills nav-stacked">
						<?php
						  if($role == "Manager"){
						      echo "<li class='dropdown-btn'><a href='#'>Settings</a>";
						      echo "<ul class='nav nav-stacked nav-pills dropdown-container'>";
						      echo "<li><a href='#'>Manage Users</a></li>";
						      echo "<li><a href='#'>Manage Services</a></li>";
						      echo "</ul>";
						      echo "</li>";
						  }
						  echo ("<script>console.log('Role: ".$role."')</script>");
				        ?>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
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
            
        echo "<input type='text' id='searchInput' placeholder='Search table' onkeyup='Filter()'/>";
        
        echo "<select id='filter_options'>
                    <option value='0' selected='selected'>Customer ID</option>
                    <option value='1'>Customer Type</option>
                    <option value='2'>Name</option>
                    <option value='3'>Date of Birth</option>
                    <option value='4'>Gender</option>
                    <option value='5'>Phone Number</option>
                    <option value='6'>Additional Info</option>
                  </select>";
            
        echo "<a href='addCustomer.php' id='add_link'>Add new customer</a>";
            
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
				echo "<th colspan='2'>Action</th>";
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
                    echo "<td><a href='addCustProcess.php?action=remove&custID=". $row['customerID'] ."' onclick=\"javascript: return confirm('Are you sure you want to remove this customer?');\">Remove</a></td>";
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
    
    
<!--Script to control search function-->
<script>
    function Filter()
	{
		var search, search_input, display_table, tr, td, i;
		search = document.getElementById("searchInput");
		search_input = search.value.toUpperCase();
		display_table = document.getElementById("display_table");
		tr = display_table.getElementsByTagName("tr");
 
		for (i = 0; i < tr.length; i++) 
		{
            var filter_option = document.getElementById('filter_options');
            
			td = tr[i].getElementsByTagName("td")[filter_option.value];
			
			if (td) {
				if (td.innerHTML.toUpperCase().indexOf(search_input) > -1) 
				{
					tr[i].style.display = "";
				} 
				else 
				{
					tr[i].style.display = "none";
				}
			} 
		}
	}
</script>
</body>
</html>
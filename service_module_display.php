<!DOCTYPE html>
<html lang="en">
    <?php
        include "session_check.php";
    ?>
<head>
    <title>Services Display</title>
    
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
    
    #itemSearch{
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
    <div id="npage">   
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
                        <h1>Services</h1>         
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-12">
                    
                                                          
<?php      
$sql = "SELECT * FROM service";
					            
if($result = mysqli_query($connect, $sql))
{    
    if(mysqli_num_rows($result) > 0)
	{
            echo "<div id='display_module_manager'>";
            
            echo "<input type='text' id='itemSearch' placeholder='Search by' onkeyup='Filter()'/>";
            
            echo "<select id='filter_options'>
                    <option value='0' selected='selected'>Name</option>
                    <option value='1'>Charge</option>
                  </select>";
            
            echo "<a href='service_module_add.php' id='add_link'>Record New Service</a>";
            
            echo "</div>";
        
            echo "<table id='display_table'>";
        
                echo "<tr>";
                    echo "<th>Service</th>";
                    echo "<th>Fee (RM)</th>";
                    echo "<th>Action</th>";
                echo "</tr>";
        
            while($row = mysqli_fetch_array($result))
			{
                echo "<tr>";
                    echo "<td>" . $row['serviceName'] . "</td>";
                    echo "<td>" . $row['serviceCharge'] . "</td>";
                    echo "<td><input id='serviceID' type='hidden' value='" . $row['serviceID'] . "'/><button id='delete_link' onclick='confirmDelete()'>Delete</button></td>";
                echo "</tr>";
			}                           
            
            echo "</table>";

		mysqli_free_result($result);
    } 
	else
	{
        echo "</br> <a href='service_module_add.php' id='add_link'>Record New Service</a> </br>";
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
    function Filter()
	{
		var search, search_input, display_table, tr, td, i;
		search = document.getElementById("itemSearch");
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
    
    function confirmDelete()
    {
        var id = document.getElementById("serviceID").value;
        
        if(confirm("Confirm deleting this service?"))
        {
            location.href = "service_module_delete.php?target=" + id;       
        }
    }
</script>
</body>
</html>

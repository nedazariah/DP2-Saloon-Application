<!DOCTYPE html>
<html lang="en">
    <?php
    include "session_check.php";
    ?>
<head>
    <title>Inventory Display</title>
    
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
            
            echo "<input type='text' id='itemSearch' placeholder='Search by' onkeyup='Filter()'/>";
            
            echo "<select id='filter_options'>
                    <option value='0' selected='selected'>Name</option>
                    <option value='1'>Description</option>
                    <option value='2'>Type</option>
                    <option value='3'>Buying Price</option>
                    <option value='4'>Selling Price</option>
                  </select>";
            
            echo "<a href='stock_module_add.php' id='add_link'>Record New Item</a>";
            
            echo "</div>";
        
            echo "<table id='display_table'>";
        
                echo "<tr>";
                    echo "<th>Item Name</th>";
                    echo "<th>Description</th>";
                    echo "<th>Type</th>";
                    echo "<th>Buying Price (RM)</th>";
                    echo "<th>Selling Price (RM)</th>";
                    echo "<th>Quantity</th>";
                    echo "<th colspan='2'>Action</th>";
                echo "</tr>";

            while($row = mysqli_fetch_array($result))
			{
                echo "<tr>";
                    echo "<td>" . $row['itemName'] . "</td>";
                    echo "<td>" . $row['itemDesc'] . "</td>";
                    echo "<td>" . $row['itemType'] . "</td>"; 
                    echo "<td>" . $row['itemBPrice'] . "</td>";
                    echo "<td>" . $row['itemSPrice'] . "</td>";
                    echo "<td>" . $row['itemQuantity'] . "</td>"; 
                    echo "<td><a href='stock_module_edit.php?target=". $row['itemID'] ."'>Update</a></td>";
                    echo "<td><input id='itemID' type='hidden' value='" . $row['itemID'] . "'/><button id='delete_link' onclick='confirmDelete()'>Delete</button></td>";                
                echo "</tr>";
			}                           
            
            echo "</table>";

		mysqli_free_result($result);
    } 
	else
	{
        echo "</br> <a href='stock_module_add.php' id='add_link'>Record New Item</a> </br>";
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
        var id = document.getElementById("itemID").value;
        
        if(confirm("Confirm deleting this item record?"))
        {
            location.href = "stock_module_delete.php?target=" + id;       
        }
    }    
</script>
</body>
</html>

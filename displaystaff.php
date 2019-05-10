<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Staffs</title>
    
    <meta charset="UTF-8">
    <meta name="language" content="english" />
    <meta name="keywords" content="Display,View,Staff,Style and Smile Saloon House, Saloon" />
    <meta name="description" content="Style and Smile Saloon House Viewing/Display Staff" />
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    
	<!--Custom Style-->
	<link href="css/nstyle.css" rel="stylesheet"/>
	<link href="css/nav_style.css" rel="stylesheet"/>
   
    <style>
        th, td{  
            padding: .5em; 	
            text-align: center;
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
            text-align: center;
        } 

        #display_module_manager{
            text-align: left;
            margin: 0 auto;
            width: 90%;
        }

        #header{
            background-color: beige;
        }
        
        .btn_action{
            background:none;
            border:none; 
            color: steelblue;
            padding-top: 0;
            cursor: pointer;            
        } 
        
        .btn_action:hover{
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php    
    include "session_check.php";
    $sql2 = "SELECT * FROM user";

    if($result = mysqli_query($connect, $sql2)) {
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result)) {
                    $uIDs[] = $row['userID'];
                }
            }
    }
    ?>

    <div class="npage">
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
                        <h1>Staffs</h1>  
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
<?php
$sql = "SELECT * FROM staff";
					            
if($result = mysqli_query($connect, $sql))
{    
    if(mysqli_num_rows($result) > 0)
	{
        echo "<div id='display_module_manager'>";
            
        echo "<input type='text' id='searchInput' placeholder='Search table' onkeyup='Filter()'/>";
        
        echo "<select id='filter_options'>
                    <option value='0'>Staff ID</option>
                    <option value='1' selected='selected'>Name</option>
                    <option value='2'>Date of Birth</option>
                    <option value='3'>Gender</option>
                    <option value='4'>Phone Number</option>
                    <option value='5'>Email</option>
                    <option value='6'>Role</option>
                    <option value='7'>Address</option>
              </select>";
        
        echo "<a href='addstaff.php' class='btn btn-default'>Add new staff</a>";
            
        echo "</div>";
    
        echo "<table id='display_table' class='table table-striped table-responsive table-hover'>";
        
        echo "<thead id='header'>
                <tr>
                    <th>Staff ID</th>
                    <th>Staff Name</th>
                    <th>Staff Date of Birth</th>
                    <th>Staff Gender</th>
                    <th>Staff Phone No.</th>
                    <th>Staff Email</th>
                    <th>Staff Role</th>
                    <th>Staff Address</th>
                    <th colspan='2'>Action</th>
                    <th>Account</th>
                </tr>
             </thead>";
        
            while($row = mysqli_fetch_array($result))
			{
                echo "<tbody id='filterTable'>";
				echo "<tr>";
					echo "<td>" . $row['staffID'] . "</td>";
					echo "<td>" . $row['staffName'] . "</td>";
					echo "<td>" . $row['staffDoB'] . "</td>"; 
                    echo "<td>" . $row['staffGender'] . "</td>";
					echo "<td>" . $row['staffPhone'] . "</td>";
					echo "<td>" . $row['staffEmail'] . "</td>";
                    echo "<td>" . $row['staffRole'] . "</td>";
                    echo "<td>" . $row['staffAddress'] . "</td>";
					echo "<td><a href='editstaff.php?staffID=". $row['staffID'] ."'>Update</a></td>
                          <td><a href='deletestaff.php?staffID=". $row['staffID'] ."' onclick=\"javascript: return confirm('Are you sure you want to delete this record?');\">Remove</a></td>";
                          
                          if(in_array($row['staffID'], $uIDs)) {
                                echo "<td><button type='button' class='btn_action' onclick='removeAcc(" . $row['staffID'] . ")'>Remove</a></td>";
                          } else {
                                echo "<td><button type='button' class='btn_action' onclick='createAcc(" . $row['staffID'] . ")')>Create</button></td>";
                          }
                
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
    
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

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

    function createAcc(staffID) {
        if (confirm("Create account for this staff?")) {
            var hasPws = 0;
            while (hasPws == 0) {
            var password = prompt("Please enter a password.");

                if (password.length > 0) {
                    hasPws = 1;
                }
            }

            location.href = "user_module_add.php?target=" + staffID + "&pws=" + password; 
        }
    }

    function removeAcc(staffID) {
        if (confirm("Remove this user from the user?")) {
            location.href = "user_module_delete.php?target=" + staffID;
        }
    }

</script>
</body>

</html>

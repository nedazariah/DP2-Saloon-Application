<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staffs</title>
    <meta name="language" content="english" />
    <meta name="keywords" content="Display,View,Staff,Style and Smile Saloon House, Saloon" />
    <meta name="description" content="Style and Smile Saloon House Viewing/Display Staff" />
    <script>
        function updateStaff(staffID) {
            window.location.href = "editstaff.php?staffID="+staffID;
        }
        
        function addStaff() {
            window.location.href = "addstaff.php";
        }
    </script>
</head>

<body>
    <?php    
    $servername = "localhost";
    $username = "root";
    $pass = "";
    $db = "saloon";

    $conn = mysqli_connect($servername, $username, $pass, $db);
    $sql = "SELECT * FROM staff";
    ?>
    
    <div>
    <?php
    if($result = mysqli_query($conn, $sql))
    {    
        if(mysqli_num_rows($result) > 0)
        {
            echo "<table>";
                echo "<tr>";
                    echo "<th>Staff ID</th>";
                    echo "<th>Staff Name</th>";
                echo "</tr>";

                while($row = mysqli_fetch_array($result))
                {
                    echo "<tr>";
                        echo "<td>" . $row['staffID'] . "</td>";
                        echo "<td>" . $row['staffName'] . "</td>";
                        echo "<td><button type='button' onclick='updateStaff(". $row['staffID'] .")' >Update</button></td>";
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
        echo "Error: Could not execute $sql. " . mysqli_error($conn);
    }
    mysqli_close($conn);
    ?>
    <br><br>
    <button type="button" onclick="addStaff()">Add Staff</button>
    </div>
</body>

</html>

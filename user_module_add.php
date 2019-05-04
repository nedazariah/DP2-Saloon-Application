<?php
include "session_check.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Set User Password</title>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
</head>
<body> 
<?php
function errorProcess($message)
{
    echo $message;
    echo "</br></br>Redirecting back.";
    header('Refresh: 3; url=displaystaff.php');
}   
    
if(isset($_GET['target']) && !empty(trim($_GET['target'])) && isset($_GET['pws']) && !empty(trim($_GET['pws'])))
{ 
    $pws = trim($_GET['pws']);
    $target = trim($_GET['target']);
    
    $sql = "SELECT * FROM user WHERE userID = " . $target;
    
    if($result = mysqli_query($connect, $sql))
    {    
        if(mysqli_num_rows($result) == 0)
        {
            mysqli_free_result($result);
            
            $sql = "INSERT INTO user (userID, userPass) VALUES ($target, '$pws')";
            
            if(mysqli_query($connect, $sql))
            {
                header("location: displaystaff.php");
                exit();
            }
            else 
            { 
                errorProcess("Error: Could not execute $sql." . mysqli_error($connect));
            } 
        }
        else
        {
            mysqli_free_result($result);
            errorProcess("Error: User ID not found.");
        }
    }
    else
    {
        $msg = "Error: Could not execute $sql. " . mysqli_error($connect);
        errorProcess($msg);
    }
}
else
{
    errorProcess("Error: User ID not found.");
}
?>
</body>
</html>
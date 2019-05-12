<!DOCTYPE html>
<html lang="en">
<?php
include "session_check.php";
?>
<head>
    <title>Delete Service</title>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
</head>
<body> 
<?php
function errorProcess($message)
{
    mysqli_close($connect);
    echo $message;
    echo "</br></br>Redirecting back.";
    header('Refresh: 3; url=service_module_display.php');
} 
    
if(isset($_GET['target']) && !empty(trim($_GET['target'])))
{
    $target = trim($_GET['target']);

    $sql = "DELETE FROM service WHERE serviceID = " . $target;

    if (mysqli_query($connect, $sql))
    {
        mysqli_close($connect);
        header("location: service_module_display.php");
        exit();
    }
    else 
    {
       
        errorProcess("Error: " . $sql . "</br>" . die(mysqli_error($connect))); 
    }
}
else
{
   
    errorProcess("Error: service ID not found."); 
}
?>
</body>
</html>

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
if(isset($_GET['target']) && !empty(trim($_GET['target'])))
{
    $target = trim($_GET['target']);

    $sql = "DELETE FROM service WHERE serviceID = " . $target;

    if (mysqli_query($connect, $sql))
    {
        header("location: service_module_display.php");
        exit();
    }
    else 
    {
        echo "Error: " . $sql . "</br>" . die(mysqli_error($connect));
        echo "Redirecting back.";
        header('Refresh: 3; url=service_module_display.php');
    }
}
else
{
    echo "Error: service ID not found.";
    echo "Redirecting back.";
    header('Refresh: 3; url=service_module_display.php');
}
?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<?php
include "session_check.php";
?>
<head>
    <title>Delete Item Record</title>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
</head>
<body> 
<?php
if(isset($_GET['target']) && !empty(trim($_GET['target'])))
{
    $target = trim($_GET['target']);

    $sql = "DELETE FROM inventory WHERE itemID = " . $target;

    if (mysqli_query($connect, $sql))
    {
        header("location: stock_module_display.php");
        exit();
    }
    else 
    {
        echo "Error: " . $sql . "</br>" . die(mysqli_error($connect));
        echo "Redirecting back.";
        header('Refresh: 3; url=stock_module_display.php');
    }
}
else
{
    echo "Error: item ID not found.";
    echo "Redirecting back.";
    header('Refresh: 3; url=stock_module_display.php');
}
?>
</body>
</html>
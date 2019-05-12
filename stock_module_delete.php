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
function errorProcess($message)
{
    mysqli_close($connect);
    echo $message;
    echo "</br></br>Redirecting back.";
    header('Refresh: 3; url=stock_module_display.php');
}     
    
if(isset($_GET['target']) && !empty(trim($_GET['target'])))
{
    $target = trim($_GET['target']);

    $sql = "DELETE FROM inventory WHERE itemID = " . $target;

    if (mysqli_query($connect, $sql))
    {
        mysqli_close($connect);
        header("location: stock_module_display.php");
        exit();
    }
    else 
    {
        errorProcess("Error: " . $sql . "</br>" . die(mysqli_error($connect)));
    }
}
else
{
    errorProcess("Error: item ID not found.");
}
?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<?php
include "session_check.php";
?>
<head>
    <title>Remove User</title>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
</head>
<body> 
<?php
if(isset($_GET['target']) && !empty(trim($_GET['target'])))
{
    $target = trim($_GET['target']);

    $sql = "DELETE FROM user WHERE userID = " . $target;

    if (mysqli_query($connect, $sql))
    {
        header("location: displaystaff.php");
        exit();
    }
    else 
    {
        echo "Error: " . $sql . "</br>" . die(mysqli_error($connect));
        echo "</br> Redirecting back.";
        header('Refresh: 3; url=displaystaff.php');
    }
}
else
{
    echo "Error: User ID not found.";
    echo "Redirecting back.";
    header('Refresh: 3; url=displaystaff.php');
}
?>
</body>
</html>
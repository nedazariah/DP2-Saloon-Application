<html lang="en">

<head>
    <meta charset="utf-8">
</head>



<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $pw = "";
    $db = "salon";
    $conn = mysqli_connect($servername, $username, $pw, $db);
    if (!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    $c = 0;
    if (isset($_POST["cancel"])){
        $cancelButton = $_POST["cancel"];   
        while ($cancelButton!="cancel".$c){
            $c++;
        }
        $appointmentArray = $_POST["appointmentID"];
        $appointmentID = $appointmentArray[$c];
        $deleteSQL = "DELETE FROM appointment WHERE appointmentID = '$appointmentID'";
        if (mysqli_query($conn,$deleteSQL)){
            echo '<script type="text/javascript">alert("Successfully Delete Record");</script>';
        }else{
            echo "<script type='text/javascript'>alert('Failed to Delete Record');</script>";        
        }
    }
    echo '<script>window.history.back();</script>';

?>
</body>

</html>

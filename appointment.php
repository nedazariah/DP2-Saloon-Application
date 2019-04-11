<!DOCTYPE html>
<html lang="en" data-ng-app="">

<head>
    <title>Appointment Booking</title>
    <meta name="viewport" content="width=device-width, initialscale=1.0" />
    <meta charset="utf-8" />
</head>

<body>
   <h1>Appointment Records</h1>
    <?php
    $servername = "localhost";
    $username = "root";
    $pw = "";
    $db = "saloon";
    $conn = mysqli_connect($servername, $username, $pw, $db);
    if (!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    $select = "SELECT * FROM appointment";
    $result = mysqli_query($conn,$select);
    while ($row = mysqli_fetch_assoc($result)){
        echo '<table>';
        echo '<tr>';
        echo '<th>Appointment ID</th>';
        echo '<th>Customer ID</th>';
        echo '<th>Customer Name</th>';
        echo '<th>Date</th>';
        echo '<th>Time</th>';
        echo '<th>Phone Number</th>';
        echo '<th>Appointment Service</th>';
        echo '<th>Description<th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><input type="hidden" name="appointmentID" value="'.$row["appointmentID"].'"/>'.$row["appointmentID"].'</td>';
        echo '<td>'.$row["customerID"].'</td>';
        echo '<td>'.$row["customerName"].'</td>';
        echo '<td>'.$row["appointmentDate"].'</td>';
        echo '<td>'.$row["appointmentTime"].'</td>';
        echo '<td>'.$row["customerPhone"].'</td>';
        echo '<td>'.$row["appointmentService"].'</td>';
        echo '<td>'.$row["appointmentNotes"].'</td>';
        echo '<td><button type="button">Edit</button></td>';
        echo '</tr>';
        echo '</table>';
    }
    ?>


    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/angular.min.js"></script>
</body>

</html>

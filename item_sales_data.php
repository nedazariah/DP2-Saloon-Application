<?php
include 'session_check.php';

$sql = "SELECT itemName, SUM(qtyPurchased) as totalQty, YEAR(datePurchased) as year, MONTH(datePurchased) as month FROM item_sales JOIN inventory WHERE item_sales.itemID = inventory.itemID GROUP BY itemName, month, year ORDER BY datePurchased DESC";

if($result = mysqli_query($connect,$sql)){
    while($row = mysqli_fetch_array($result)){
        $array[] =["itemName"=>$row['itemName'], "qty"=>$row['totalQty'], "year"=>$row['year'], "month"=>$row['month']];
    }
    
    echo json_encode($array); 
}



?>
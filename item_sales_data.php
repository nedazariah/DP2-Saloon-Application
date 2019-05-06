<?php
include 'session_check.php';

$sql = "SELECT itemName, qtyPurchased, datePurchased FROM item_sales JOIN inventory WHERE item_sales.itemID = inventory.itemID";
$tempArray = [];
if($result = mysqli_query($connect,$sql)){
    while($row = mysqli_fetch_array($result)){
        //$salesID = $row['salesID'];
        //$itemID = $row['itemID'];
            $array["itemName"] = $item['itemName'];
            $array["qty"] = $row['qtyPurchased'];
            $array["date"] = $row['datePurchased'];
//        foreach($row as $key=>$value){
//            $array["itemName"] = $item['itemName'];
//            $array["qty"] = $row['qtyPurchased'];
//            $array["date"] = $row['datePurchased'];
//            $array = $tempArray[$key];
//        }
        
    }
}

//echo $salesID;
//echo $itemID;
//echo $itemName;
//echo $qtyPurchased;
//echo $datePurchased;
//echo $result;

for($i=0;$i<sizeof($array);$i++){
    echo json_encode($array);
}

?>
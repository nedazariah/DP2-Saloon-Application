<?php

    include "dbconnect.php";
    
    if(isset($_POST['custFullname'],$_POST['custDob'],$_POST['custGender'],$_POST['custType'],$_POST['custPhoneNum'],$_POST['custInfo'])){
        
        $custFullname = $_POST['custFullname'];
        $custDob = $_POST['custDob'];
        $custGender = $_POST['custGender'];
        $custType = $_POST['custType'];
        $custPhoneNum = $_POST['custPhoneNum'];
        $custInfo = $_POST['custInfo'];
        
        $sql = "INSERT INTO customer(customerType,customerName,customerDoB,customerGender,customerPhone,customerAddInfo) VALUES('$custType','$custFullname','$custDob','$custGender','$custPhoneNum','$custInfo')";
        
        $insert_cust = mysqli_query($connect,$sql);
        
        if($insertCust){
            echo "Insert Successful";
            header("URL=displayCustomer.php");
        }
    }
    
?>

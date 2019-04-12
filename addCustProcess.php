<?php

    include "dbconnect.php";
    
   $action = $_GET['action'];
   $custID = $_GET['custID'];
   
	   	if(isset($_POST['custFullname'],$_POST['custDob'],$_POST['custGender'],$_POST['custType'],$_POST['custPhoneNum'],$_POST['custInfo'])){
        
	           $custFullname = $_POST['custFullname'];
	           $custDob = $_POST['custDob'];
	           $custGender = $_POST['custGender'];
	           $custType = $_POST['custType'];
	           $custPhoneNum = $_POST['custPhoneNum'];
	           $custInfo = $_POST['custInfo'];
			   
			   if($action == "update"){
				   $updateSql = "UPDATE customer SET customerType = '$custType', customerName = '$custFullname', customerDoB = '$custDob', customerGender = '$customerGender', customerPhone = '$custPhoneNum', customerAddInfo = '$custInfo' WHERE customerID = '$custID'";
				   
				   $update_cust = mysqli_query($connect,$updateSql);
				   
				   if($update_cust){
					   echo "Update Successful";
					   sleep(3);
					   header("location: displayCustomer.php");
				   }
				   
			   }else{
		           $sql = "INSERT INTO customer(customerType,customerName,customerDoB,customerGender,customerPhone,customerAddInfo) VALUES('$custType','$custFullname','$custDob','$custGender','$custPhoneNum','$custInfo')";
        
		           $insert_cust = mysqli_query($connect,$sql);
        
		           if($insertCust){
		               echo "Insert Successful";
					   sleep(3);
		               header("location: displayCustomer.php");
		           }
			   }
        
	           
	       }
    
    
?>

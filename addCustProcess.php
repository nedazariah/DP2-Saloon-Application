<?php
    include "dbconnect.php";
    
    $action = $_GET['action'];
    $custID = $_GET['custID'];

    echo ("<script>console.log('Action: ". $action. "')</script>");
   
    
	   	if(isset($_POST['submit'])){
        
	           $custFullname = $_POST['custFullname'];
               $custDob = $_POST['custDob'];
               $custGender = $_POST['custGender'];
               $custType = $_POST['custType'];
               $custPhoneNum = $_POST['custPhoneNum'];
               $custInfo = $_POST['custInfo'];
            
               echo ("<script>console.log('Name: ". $custFullname. "')</script>");
            
               $sql = "INSERT INTO customer(customerType,customerName,customerDoB,customerGender,customerPhone,customerAddInfo) VALUES('$custType','$custFullname','$custDob','$custGender','$custPhoneNum','$custInfo')";
            
               $updateSql = "UPDATE customer SET customerType = '$custType', customerName = '$custFullname', customerDoB = '$custDob', customerGender = '$custGender', customerPhone = '$custPhoneNum', customerAddInfo = '$custInfo' WHERE customerID = '$custID'";
        
               if($action == "add"){
                   $insert_cust = mysqli_query($connect,$sql);
        
		           if($insert_cust){
		              header("location: displayCustomer.php");
		           }
               }
		       
			   
			   if($action == "update"){
                   
                   echo ("<script>console.log('ID: ". $custID. "')</script>");
                   echo ("<script>console.log('Name: ". $custFullname. "')</script>");
                   
				   $update_cust = mysqli_query($connect,$updateSql);
				   
				   if($update_cust){
					   header("location: displayCustomer.php");
				   }
				   
			   }
        
	           
	       }

//           if($action == "update"){
//               
//           }
    
    
?>

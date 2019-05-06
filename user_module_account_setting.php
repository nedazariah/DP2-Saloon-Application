<!DOCTYPE html>
<html lang="en">
<?php
include "session_check.php";
?>
<head>
    <title>Account Settings</title>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    
	<!--Custom Style-->
	<link href="css/nstyle.css?v=<?php echo time(); ?>" rel="stylesheet"/>
	<link href="css/nav_style.css" rel="stylesheet"/> 

</head>
<body> 
    
    <div id="npage">
        <div class="row">
            <div class="col-md-2">
                <div class="sideNav">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="dropdown-btn"><a href="#">Appointment</a>
                            <ul class="nav nav-pills nav-stacked dropdown-container">
                                <li><a href="appointmentform.php">Add Appointment</a></li>
                                <li><a href="pendingappointment.php">Pending Appointments</a></li>
                                <li><a href="appointment.php">All Appointments</a></li>
                            </ul>
                        </li>
                        
                        <li><a href="displayCustomer.php">Customers</a></li>
                        <li><a href="stock_module_display.php">Stock</a></li> 
                        <?php
				            if($role == "Manager"){ 
                                echo "<li><a href='service_module_display.php'>Services</a></li>";
                                echo "<li><a href='displaystaff.php'>Staff</a></li>";
				            }
						    echo ("<script>console.log('Role: ".$role."')</script>");
				        ?>
                    </ul>
                    
                    <div class="btm-menu">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="user_module_account_setting.php">Account</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>        
           
            <div class="col-md-10">
              
<?php

function runQuery($connect, $sql)
{	
	if (mysqli_query($connect, $sql)) {
        mysqli_close($connect);	
		header("location: user_module_account_setting.php");
		exit();
	}
	else 
	{
		alertUser("Error: " . $sql . "</br>" . die(mysqli_error($connect)));
    }
}
                
//Form data processing block
if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $sql = "SELECT * FROM user WHERE userID = " . $loggedUser;
    
    if (mysqli_query($connect, $sql)) 
    {
        $results = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($results);

        $SQ = $row['secQuestion'];
        $SA = $row['secAnswer'];
        $storedPWS = $row['userPass'];
            
        mysqli_free_result($results);

        //Initialize fields
        $userPWS = $userSQ = $userSA ="";
        $hasError = false;
        $hasNewPws = $hasNewSQ = $hasNewSA = false;

        //Processing New Password <Start>
        $input_OPWS = $_POST["userOPWS"];
        $input_PWS = $_POST["userPWS"];
        $input_CPWS = $_POST["userCPWS"];

        if(!(empty($input_PWS)))
        {

            if($input_OPWS == $storedPWS)
            {
                $message .= "Error: Entered old password does not match current password. </br>";
                $hasError = true;
            }
            else if($input_PWS == $input_CPWS)
            {
                $message .= "Error: Entered new password does not match re-entered password. </br>";
                $hasError = true;
            }
            else
            {
                $hasNewPws = true;
                $userPWS = $input_PWS;
            }         
        }
        else
        {
            $hasNewPws = false;    
        }
        //Processing New Password <End>

        //Processing Securty Question <Start>
        $input_SQ = SanitizeData($_POST["userSQ"]);

        if(empty($input_SQ) || ($input_SQ == $SQ)){
            $hasNewSQ = false;
        }
        else
        {
            $hasNewSQ = true;
            $userSQ = MysqliEscape($connect, $input_SQ);
        }	
        //Processing Securty Question <End>

        //Processing Securty Answer <Start>
        $input_SA = SanitizeData($_POST["userSA"]);

        if(empty($input_SA) || ($input_SA == $SA)){
            $hasNewSA = false;
        }
        else
        {
            $hasNewSA = true;
            $userSA = MysqliEscape($connect, $input_SA);
        }	
        //Processing Securty Answer <End>

        if($hasNewPws)
        {
            $sql = "UPDATE user SET userPass = '$userPWS' WHERE userID = " . $loggedUser; 

            if(!($hasError))
            {
                runQuery($connect, $sql);    
            }
            else
            {
                alertUser($message);
            }

        }

        if($hasNewSQ)
        {
            $sql = "UPDATE user SET secQuestion = '$userSQ' WHERE userID = " . $loggedUser; 
            runQuery($connect, $sql);        
        }

        if($hasNewSA)
        {
            $sql = "UPDATE user SET secAnswer = '$userSA' WHERE userID = " . $loggedUser; 
            runQuery($connect, $sql);
        }  
    }
    else 
    {
        alertUser("Error: " . $sql . "</br>" . die(mysqli_error($connect)));
    }    
}
else
{
    $sql = "SELECT * FROM user WHERE userID = " . $loggedUser;
    
    if (mysqli_query($connect, $sql)) 
    {
        $results = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($results);

        $SQ = $row['secQuestion'];
        $SA = $row['secAnswer'];
            
        mysqli_free_result($results);
    }
    else 
    {
        alertUser("Error: " . $sql . "</br>" . die(mysqli_error($connect)));
    }

    mysqli_close($connect);	
}
?> 
                <form id="nform" name="nform" method="post" action="user_module_account_setting.php">
   
                    <div class="row">
                        <div class="col-md-12">
                            <h1>My Account</h1>                    
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="userID" class="col-md-offset-4 col-md-1">ID: </label><input type="text" disabled="disabled" id="userID" name="userID" value="<?php echo $loggedUser ?>" class="col-md-4"/>
                        </div>
                    </div>
                    
                    <br/>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="inputOPWS" class="col-md-offset-3 col-md-3">Old Password: </label><input type="password" id="inputOPWS" name="userOPWS" maxlength="20" class="col-md-3"/><br/><br/> 
                        </div>
                    </div> 
                
                    <div class="row">
                        <div class="col-md-12">
                            <label for="inputPWS" class="col-md-offset-3 col-md-3">New Password: </label><input type="password" id="inputPWS" name="userPWS" maxlength="20" class="col-md-3"/><br/><br/>
                        </div>
                    </div> 
                
                    <div class="row">
                        <div class="col-md-12">
                            <label for="inputCPWS" class="col-md-offset-3 col-md-3">Confirm Password: </label><input type="password" id="inputCPWS" name="userCPWS" maxlength="20" class="col-md-3"/><br/><br/>
                        </div>
                    </div>     
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="inputSQ" class="col-md-offset-2 col-md-2">Security Question: </label><textarea id="inputSQ" name="userSQ" maxlength="250" class="control-label col-md-6"><?php echo $SQ ?></textarea><br/><br/><br/>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="userSA" class="col-md-offset-2 col-md-2">Answer: </label><textarea id="inputSA" name="userSA" maxlength="250" class="col-md-6"><?php echo $SA ?></textarea><br/><br/><br/>                        
                        </div>
                    </div>                                                                                                                                                                                   
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" id="setting_change">Update</button>
                        </div>
                    </div>  
                                  
                </form>
                
<?php
function alertUser($str)
{
    echo $str;
}   
?>
                
            </div>
        </div>
    </div>

<!-- jQuery – required for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- All Bootstrap plug-ins file -->
<script src="js/bootstrap.min.js"></script>
<!-- Basic AngularJS -->
<script src="js/angular.min.js"></script>
<!--Javascript for Navigation Menu-->
<script src="js/nav.js"></script>
</body>
</html>

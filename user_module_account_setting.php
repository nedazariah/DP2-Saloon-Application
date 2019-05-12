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
	<link href="css/nav_style.css" rel="stylesheet"/> 
    <style>
        h1{
            text-align: center;
        }
        
        .btn{
            width: 10em;
        }
    </style> 

</head>
<body> 
    
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="sideNav">
		    <?php
                        include "navigation.php";
                    ?>
                </div>
            </div>        
           
            <div class="col-md-10">
              
<?php
//Message variable to be used for back-end validation
$opws_error = $cpws_error = $server_comm_error = "";
                
//Function definition for running queries
function runQuery($connect, $sql)
{	
	if (mysqli_query($connect, $sql)) {
        mysqli_close($connect);	
		header("location: user_module_account_setting.php");
		exit();
	}
	else 
	{
        mysqli_close($connect);
		$server_comm_error = "Error: " . $sql . "</br>" . die(mysqli_error($connect));
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
        $userSQ = $userSA = $message = "";
        $hasError = false;
        $hasNewPws = $hasNewSQ = $hasNewSA = false;

        //Processing New Password <Start>
        $input_OPWS = $_POST["userOPWS"];
        $input_PWS = $_POST["userPWS"];
        $input_CPWS = $_POST["userCPWS"];

        if(!(empty($input_PWS)))
        {
            $pws_hash = password_hash($input_PWS, PASSWORD_DEFAULT);
            
            if(password_verify($input_OPWS, $storedPWS))
            {
                if($input_PWS != $input_CPWS)
                {
                    $cpws_error = "Entered new password does not match re-entered password.";
                    $hasError = true;
                }
                else
                {
                    $hasNewPws = true;
                }                
            }
            else
            {
                $opws_error = "Entered old password does not match current password.";
                $hasError = true;
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

        if(!($hasError))
        {
            if($hasNewPws && !($hasNewSQ) && !($hasNewSA))
            {
                $sql = "UPDATE user SET userPass = '$pws_hash' WHERE userID = " . $loggedUser; 
            }
            else if($hasNewSQ && !($hasNewPws) && !($hasNewSA))
            {
                $sql = "UPDATE user SET secQuestion = '$userSQ' WHERE userID = " . $loggedUser;          
            }
            else if($hasNewSA && !($hasNewPws) && !($hasNewSQ))
            {
                $sql = "UPDATE user SET secAnswer = '$userSA' WHERE userID = " . $loggedUser;   
            }
            else if($hasNewPws && $hasNewSA && !($hasNewSQ))
            {
                $sql = "UPDATE user SET userPass = '$pws_hash', secAnswer = '$userSA' WHERE userID = " . $loggedUser; 
            }
            else if($hasNewPws && $hasNewSQ && !($hasNewSA))
            {
                $sql = "UPDATE user SET userPass = '$pws_hash', secQuestion = '$userSQ' WHERE userID = " . $loggedUser; 
            }
            else if($hasNewSA && $hasNewSQ && !($hasNewPws))
            {
                $sql = "UPDATE user SET secQuestion = '$userSQ', secAnswer = '$userSA' WHERE userID = " . $loggedUser;
            }
            else if($hasNewPws && $hasNewSQ && $hasNewSA)
            {
                $sql = "UPDATE user SET userPass = '$pws_hash', secQuestion = '$userSQ', secAnswer = '$userSA' WHERE userID = " . $loggedUser;
            }
            
            runQuery($connect, $sql);    
        }
    }
    else 
    {
       $server_comm_error = "Error: " . $sql . "</br>" . die(mysqli_error($connect));
    }
    
    mysqli_close($connect);
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
        $server_comm_error = "Error: " . $sql . "</br>" . die(mysqli_error($connect));
    }

    mysqli_close($connect);	
}
?>
                <h1>My Account</h1>
                
                <form id="nform" name="nform" method="post" action="user_module_account_setting.php">
   
                    <div class="form-group">
                        <label for="userID">ID: </label>
                        <input type="text" disabled="disabled" class="form-control" id="userID" name="userID" value="<?php echo $loggedUser ?>"/>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputOPWS">Old Password: </label>
                        <input type="password" id="inputOPWS" class="form-control" name="userOPWS" maxlength="20"/>
                        <span id="oldPasswordError" class="text-danger"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputPWS">New Password: </label>
                        <input type="password" id="inputPWS" class="form-control" name="userPWS" maxlength="20"/>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputCPWS">Confirm Password: </label>
                        <input type="password" id="inputCPWS" class="form-control" name="userCPWS" maxlength="20"/>
                        <span id="confirmPasswordError" class="text-danger"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputSQ">Security Question: </label>
                        <textarea id="inputSQ" name="userSQ" class="form-control" maxlength="250"><?php 
                                if($_SERVER["REQUEST_METHOD"] == "POST")
                                    echo $_POST["userSQ"];
                                else 
                                    echo $SQ; ?></textarea>
                    </div>
                   
                    <div class="form-group">
                        <label for="userSA">Answer: </label>
                        <textarea id="inputSA" name="userSA" class="form-control" maxlength="250"><?php  
                                if($_SERVER["REQUEST_METHOD"] == "POST")
                                    echo $_POST["userSA"];
                                else 
                                    echo $SA; ?></textarea>
                    </div>
                           
                    <div class="form-group text-center">        
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>   
        
                </form>
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
<!--Back-end form validation error output-->
<script>
    var opws_error = "<?php echo $opws_error; ?>";
    var cpws_error = "<?php echo $cpws_error; ?>";
    var server_error = "<?php echo $server_comm_error; ?>";
    
    if(opws_error.length !== 0)
    {
        document.getElementById("oldPasswordError").innerHTML = opws_error;
    }   
    
    if(cpws_error.length !== 0)
    {
        document.getElementById("confirmPasswordError").innerHTML = cpws_error;
    }
    
    if(server_error.length !== 0)
    {
        alert(server_error);
    }
</script>
</body>
</html>

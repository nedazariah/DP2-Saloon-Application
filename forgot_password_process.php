<?php
    require_once "dbconnect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password</title>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <style>
        h1{
            text-align: center;
        }
        
        .btn{
            width: 10em;
        }
    </style>    
   
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    
    <!-- jQuery – required for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- All Bootstrap plug-ins file -->
    <script src="js/bootstrap.min.js"></script>
    
</head>

<body>
<?php
//Form data processing block
if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    //Initialize all inventory fields
    $userID = SanitizeData($_POST["target"]);
    $userNPass = $message = "";   
    
    $hasError = false;
    
    //Processing User SA <Start>
    $input_userSA = SanitizeData($_POST["sa"]);
    $storedSA = SanitizeData($_POST["ssa"]);
    
    if(empty($input_userSA)){
		$hasError = true;
        $message .= "Error: Input answer for security question not found </br>";
    }
	else if($input_userSA != $storedSA)
    {
        $hasError = true;
        $message .= "Error: Security answer is incorrect </br>";   
	}	
    //Processing User SA <End>
        
    //Processing password <Start>
    $input_userNPass = SanitizeData($_POST["pws"]);
    $input_userCNPass = SanitizeData($_POST["re_pws"]);
    
    if(empty($input_userNPass)){
		$hasError = true;
        $message .= "Error: New password not found </br>";
    }
    if(empty($input_userCNPass)){
		$hasError = true;
        $message .= "Error: Re-entered password not found </br>";
    }
	else if($input_userNPass != $input_userCNPass)
    {
        $hasError = true;
        $message .= "Error: Entered passwords do not match </br>";        
    }
    else
	{
        $userNPass = MysqliEscape($connect, $input_userNPass);
	}	
    //Processing password <End>
    
    submit($userID, $userNPass, $hasError, $connect, $message);
}
else
{
    if(isset($_GET['target']) && !empty(trim($_GET['target'])))
    {
        $target = trim($_GET['target']);

        $sql = "SELECT * FROM user WHERE userID = " . $target;
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
    else
    {
        header("location: login.php");
        exit();
    }
}  
?> 
    <div class="container">    
        
        <div class="row">
            <div class="col-md-12">
                <h1>Verify Credentials</h1>
            </div>
        </div>
        
        <div class="row">
           
            <div class="col-md-12">
               
                <form name="f_password" id="f_password" method="post" action="forgot_password_process.php">
                   
                    <!--User ID-->
                    <div class="form-group">
                        <label for="user">User ID: </label>
                        <input type="text" name="user" id="user" maxlength="11" class="form-control" disabled="disabled" value="<?php echo $target ?>"/>
                        <input type="hidden" name="target" value="<?php echo $target ?>"/>
                    </div>
                    
                    <!--Security Question-->
                    <div class="form-group">
                        <label for="sq">Security Question: </label>
                        <textarea name="sq" id="sq" maxlength="250" class="form-control" disabled="disabled"><?php echo $SQ ?></textarea>
                        <input type="hidden" name="ssa" value="<?php echo $SA ?>"/>
                    </div>
                    
                    <!--Security Answer-->                                  
                    <div class="form-group">
                        <label for="sa">Answer: </label>
                        <textarea name="sa" id="sa" class="form-control" maxlength="250"></textarea>
                    </div>
                    
                    <!--New Password-->
                    <div class="form-group">
                        <label for="pws">New Password: </label>
                        <input type="password" name="pws" class="form-control" id="pws" maxlength="20"/>
                    </div>

                    <!--Confirm password-->
                    <div class="form-group">
                        <label for="re_pws">Re-Enter Password: </label>
                        <input type="password" name="re_pws" class="form-control" id="re_pws" maxlength="20"/>
                    </div>                       
                
                    <!--Buttons-->
                    <div class="form-group text-center">  
                        <input type="submit" name="reset" id="reset_pws_button" value="Reset Password" class="btn btn-primary"/>
                        <a href="forgot_password.php" class="btn btn-default">Go Back</a>
                    </div>  
                    
                </form>
                
            </div>
            
        </div>
        
        <div class="row">
            
            <div class="col-md-12" id="echo">
               
<?php
function submit($userID, $userNPass, $hasError, $connect, $message)
{
	//If there is no error, proceed to insert data
	if(!($hasError))
	{
        $pws_hash = password_hash($userNPass, PASSWORD_DEFAULT);
        
		$sql = "UPDATE user SET userPass = '$pws_hash' WHERE userID = " . $userID;
		
		if (mysqli_query($connect, $sql)) {
			header("location: login.php");
			exit();
		}
		else 
		{
			alertUser("Error: " . $sql . "</br>" . die(mysqli_error($connect)));
		} 		
	}
	else
	{
        $message .= "Error: Please check input fields.";
        alertUser($message);
	}	
    
    mysqli_close($connect);	    
}

function alertUser($str){
    echo $str;
}
?>            
                    
            </div>
            
        </div>
        
    </div>
    
</body>
</html>

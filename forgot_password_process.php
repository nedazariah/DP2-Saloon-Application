<?php
    require_once "dbconnect.php";
?>
<!DOCTYPE html>
<html data-ng-app="" lang="en">
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
//Message variable to be used for back-end validation
$pws_error = $repws_error = $sa_error = $server_comm_error = $verify_error = "";
    
//Form data processing block
if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    //Initialize all inventory fields
    $userID = SanitizeData($_POST["target"]);
    $userNPass = "";   
    
    $hasError = false;
    
    //Processing User SA <Start>
    $input_userSA = SanitizeData($_POST["sa"]);
    $storedSA = SanitizeData($_POST["ssa"]);
    
    if(empty($input_userSA))
    {
		$hasError = true;
        $sa_error = "Security answer not found.";
    }
	else if($input_userSA != $storedSA)
    {
        $hasError = true;
        $verify_error = "Verification failed.";   
	}	
    //Processing User SA <End>
        
    //Processing password <Start>
    $input_userNPass = SanitizeData($_POST["pws"]);
    $input_userCNPass = SanitizeData($_POST["re_pws"]);
    
    if(empty($input_userNPass))
    {
		$hasError = true;
        $pws_error = "New password not found.";
    }
    if(empty($input_userCNPass))
    {
		$hasError = true;
        $repws_error = "Re-entered password not found.";
    }
	else
	{
        $userNPass = MysqliEscape($connect, $input_userNPass);
	}	
    //Processing password <End>
    
    //If there is no error, proceed to insert data
	if(!($hasError))
	{
        $pws_hash = password_hash($userNPass, PASSWORD_DEFAULT);
        
		$sql = "UPDATE user SET userPass = '$pws_hash' WHERE userID = " . $userID;
		
		if (mysqli_query($connect, $sql)) {
            mysqli_close($connect);	 
			header("location: login.php");
			exit();
		}
		else 
		{
			$server_comm_error = "Error: " . $sql . "</br>" . die(mysqli_error($connect));
		} 		
	}
    
    mysqli_close($connect);    
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
            $server_comm_error = "Error: " . $sql . "</br>" . die(mysqli_error($connect));//
        }

        mysqli_close($connect);	
    }
    else
    {
        mysqli_close($connect);
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
                        <input type="text" name="user" id="user" maxlength="11" class="form-control" disabled="disabled" 
                        value="<?php 
                                if($_SERVER["REQUEST_METHOD"] == "POST")
                                    echo $_POST["target"];
                                else 
                                    echo $target; ?>"/>
                        <input type="hidden" name="target" 
                        value="<?php 
                               if($_SERVER["REQUEST_METHOD"] == "POST")
                                    echo $_POST["target"];
                                else 
                                    echo $target; ?>"/>
                    </div>
                    
                    <!--Security Question-->
                    <div class="form-group">
                        <label for="sq">Security Question: </label>
                        <textarea name="sq" id="sq" maxlength="250" class="form-control" disabled="disabled"><?php 
                                if($_SERVER["REQUEST_METHOD"] == "POST")
                                    echo $_POST["ssa"];
                                else 
                                    echo $SA; ?></textarea>
                        <input type="hidden" name="ssa" 
                        value="<?php 
                                if($_SERVER["REQUEST_METHOD"] == "POST")
                                    echo $_POST["ssa"];
                                else 
                                    echo $SA; ?>"/>
                    </div>
                    
                    <!--Security Answer-->                                  
                    <div class="form-group">
                        <label for="sa">Answer: </label>
                        <textarea name="sa" id="sa" class="form-control" maxlength="250"><?php 
                                if($_SERVER["REQUEST_METHOD"] == "POST")
                                    echo $_POST["sa"];?></textarea>
                        <span class="text-danger" id="ans_error"></span>
                    </div>
                    
                    <!--New Password-->
                    <div class="form-group">
                        <label for="pws">New Password: </label>
                        <input type="password" name="pws" class="form-control" id="pws" value="<?php echo $_POST["pws"]; ?>" maxlength="20"/>
                        <span class="text-danger" id="pws_error"></span>
                    </div>

                    <!--Confirm password-->
                    <div class="form-group">
                        <label for="re_pws">Re-Enter Password: </label>
                        <input type="password" name="re_pws" class="form-control" id="re_pws" value="<?php echo $_POST["re_pws"]; ?>" maxlength="20"/>
                        <span class="text-danger" id="repws_error"></span>
                    </div>                       
                
                    <!--Buttons-->
                    <div class="form-group text-center">  
                        <input type="submit" name="reset" id="reset_pws_button" value="Reset Password" class="btn btn-primary"/>
                        <a href="forgot_password.php" class="btn btn-default">Go Back</a>
                    </div>  
                    
                </form>
                
            </div>
            
        </div>
        
    </div>

<!--Back-end form validation error output-->
<script>
    var pws_error = "<?php echo $pws_error; ?>";
    var repws_error = "<?php echo $repws_error; ?>";
    var sa_error = "<?php echo $sa_error; ?>";
    var verify_error = "<?php echo $verify_error; ?>";
    var server_error = "<?php echo $server_comm_error; ?>";
    
    function checkError(str, id)
    {
        if(str.length !== 0)
        {
            document.getElementById(id).innerHTML = str;
        }
    }
    
    checkError(pws_error, "pws_error");
    checkError(repws_error, "repws_error");
    checkError(sa_error, "ans_error");
    
    if(server_error.length !== 0)
    {
        alert(server_error);
    }
    
    if(verify_error.length !== 0)
    {
        alert(verify_error);        
    }
</script>    
</body>
</html>

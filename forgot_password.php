<?php
    require_once "dbconnect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password</title>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="css/login_style.css?v=<?php echo time(); ?>"/>   
   
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    
    <!-- jQuery – required for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- All Bootstrap plug-ins file -->
    <script src="js/bootstrap.min.js"></script>
    
</head>

<body>
   
    <div class="container">    
        
        <div class="row">
            <div class="col-md-12">
                <h1>Verify Credentials</h1>
            </div>
        </div>
        
        <div class="row">
           
            <div class="col-md-12">
               
                <form name="f_password" id="f_password" method="post" action="forgot_password.php">
                   
                    <div class="row">
                        <div class="col-md-12">
                            <label id="label_user" for="user">User ID: </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" name="user" id="user" maxlength="11"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label id="label_email" for="email">Email: </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" name="email" id="email" maxlength="40"/>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label id="label_newpassword" for="pws">New Password: </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <input type="password" name="pws" id="pws" maxlength="20"/>
                        </div>
                    </div>   

                    <div class="row">
                        <div class="col-md-12">
                            <label id="label_repassword" for="re_pws">Re-Enter Password: </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <input type="password" name="re_pws" id="re_pws" maxlength="20"/>
                        </div>
                    </div>              
                
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" name="reset" id="reset_pws_button" value="Reset Password"/>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <a href="login.php" id="forgot_back">Go Back</a>
                        </div>
                    </div>
                    
                </form>
                
            </div>
            
        </div>
        
        <div class="row">
            
            <div class="col-md-12" id="echo">
               
<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{ 
	//Validate ID	
    $input_user = SanitizeData($_POST["user"]);
	if(empty($input_user)){
		echo "Error: Username not found." . "</br>";
		$hasError = true;
    } 
	else
	{
        $user = $input_user;
    }	
	
	//Validate email
    $input_email = SanitizeData($_POST["email"]);
    if(empty($input_email)){
		echo "Error: Email not found." . "</br>";
		$hasError = true;
    }
	else
	{
        $email = $input_email;
    }
    
    //Validate password
    $input_pws = SanitizeData($_POST["pws"]);
    if(empty($input_pws)){
		echo "Error: Password not found." . "</br>";
		$hasError = true;
    }
	else
	{
        $pws = $input_pws;
    }
    
    //Validate confirm password
    $input_repws = SanitizeData($_POST["re_pws"]);
    if(empty($input_repws)){
		echo "Error: Password not re-entered." . "</br>";
		$hasError = true;
    }
	else if($pws !== $input_repws)
	{
        echo "Error: Entered passwords do not match." . "</br>";
        $hasError = true;
    }
    else
    {
        $repws = $input_repws;
    }

	if(!($hasError))
	{
		$sql = "SELECT * FROM staff WHERE staffID ='$user'";
		$results = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($results);

		if(($row['staffID'] == $user) && ($row['staffEmail'] == $email))
		{   
            $sql = "UPDATE user SET userPass = '$pws' WHERE userID = $user";

            if (mysqli_query($connect, $sql)) 
            {
                mysqli_free_result($results);
                header("location: login.php");
                exit();
            }
            else 
            {
                echo "Error: Cannot update user account.";
            }
		}
		else
		{ 
			echo "Account does not exist or credentials does not match.";
		}
	}
}
?>            
                    
            </div>
            
        </div>
        
    </div>
    
</body>
</html>

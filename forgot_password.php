<?php
    require_once "dbconnect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password</title>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="css/login_style.css"/>   
   
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
                            <label id="label_email" for="pws">Email: </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" name="email" id="email" maxlength="40"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" name="login" id="send_pws_button" value="Send New Password"/>
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
	//Validate email	
    $input_user = SanitizeData($_POST["user"]);
	if(empty($input_user)){
		echo "Error: Username not found." . "</br>";
		$hasError = true;
    } 
	else
	{
        $user = $input_user;
    }	
	
	//Validate password
    $input_email = SanitizeData($_POST["email"]);
    if(empty($input_email)){
		echo "Error: Email not found." . "</br>";
		$hasError = true;
    }
	else
	{
        $email = $input_email;
    }		

	if(!($hasError))
	{
		$sql = "SELECT * FROM staff WHERE staffID ='$user'";
		$results = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($results);

		if(($row['staffID'] == $user) && ($row['staffEmail'] == $email))
		{		
            $new_pws = rand(100000, 999999);
            
            $sql = "UPDATE user SET userPass = '$new_pws' WHERE userID = $user";

            if (mysqli_query($connect, $sql)) {
                $message = "SSS Application: Your new password is " . $new_pws;
                mail($email, "SSS Account Verification", $message);
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
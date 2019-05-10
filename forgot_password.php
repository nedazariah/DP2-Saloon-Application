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
                <h1>Reset Password</h1>
            </div>
        </div>
        
        <div class="row">
           
            <div class="col-md-12">
               
                <form name="f_password" id="f_password" method="post" action="forgot_password.php">
                   
                    <!--User ID-->
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
                
                    <div class="form-group text-center">
                        <input type="submit" name="reset" id="confirm_button" class="btn btn-primary" value="Confirm"/><br/>
                        <a href="login.php" id="forgot_back">Go Back</a>
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
		echo "Error: User ID not found." . "</br>";
    } 
	else
	{
        $checkSQL = "SELECT * FROM user WHERE userID = " . $input_user;
        $result = mysqli_query($connect, $checkSQL);
        $user = mysqli_fetch_assoc($result);
        if($user)
        {
            $url = "forgot_password_process.php?target=" . $input_user;
            header("location: $url");
            exit();
        }
        else
        {
            echo "Error: User does not exist." . "</br>";
        }
        mysqli_free_result($result);
	}
}
?>            
                    
            </div>
            
        </div>
        
    </div>
    
</body>
</html>

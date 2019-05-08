<?php
    require_once "dbconnect.php";
    
    //If logout is set (via clicking the Logout button), unsets the users logged in status, destroys the session and redirects to login page
    if(!isset($_SESSION['logged']) && ($_SESSION['logged'] == true)) 
    { 
        unset($_SESSION['logged']);
        $_SESSION = array();
        session_destroy();
        header("location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SSS Login</title>
    
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
                <h1>SSS Login</h1>
            </div>
        </div>
        
        <div class="row">

            <div class="col-md-12">
               
                <form name="login" id="login" class="form-horizontal" method="post" action="login.php">
                   
                    <div class="form-group">
                        <label for="user" class="col-md-1 col-md-offset-4">User ID: </label>
                        <input type="text" name="user" id="user" maxlength="11" class="col-md-3"/> <br/><br/>
                        
                        <label for="pws" class="col-md-1 col-md-offset-4">Password: </label>
                        <input type="password" name="pws" id="pws" maxlength="20" class="col-md-3"/>
                    </div>
                    
                    <input type="submit" name="login" id="login_button" value="Login"/> <br/>
                    
                    <a href="forgot_password.php" id="forgot_pws_link">Forgot Password</a>
                     
                    
                </form>
                
            </div>
            
        </div>
        
        <div class="row">
           
            <div class="col-md-12" id="echo">
<?php
session_start(); 

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
    $input_pws = SanitizeData($_POST["pws"]);
    if(empty($input_pws)){
		echo "Error: Password not found." . "</br>";
		$hasError = true;
    }
	else
	{
        $pws = $input_pws;
    }		

	if(!($hasError))
	{
		$sql = "SELECT * FROM user WHERE userID ='$user'";
		$results = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($results);

		if(($row['userID'] == $user) && password_verify($pws, $row['userPass']))
		{
			$_SESSION['logged'] = true;	
            $_SESSION['loggedUser'] = $user; //Added by Almira
			mysqli_free_result($results);
			header("location: pendingappointment.php"); 
			exit();
		}
		else
		{ 
			echo "Login Failed.";
		}
	}
}
?>                
            </div>
            
        </div>
        
    </div>
    
</body>
</html>

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
                <h1>SSS Login</h1>
            </div>
        </div>
        
        <div class="row">
           
            <div class="col-md-12">
               
                <form name="login" id="login" method="post" action="login.php">
                   
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
                            <label id="label_pws" for="pws">Password: </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <input type="password" name="pws" id="pws" maxlength="20"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" name="login" id="login_button" value="Login"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <a href="forgot_password.php" id="forgot_pws_link">Forgot Password</a>
                        </div>
                    </div>
                    
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

		if(($row['userID'] == $user) && ($row['userPass'] == $pws))
		{
			$_SESSION['logged'] = true;			
			mysqli_free_result($results);
			header("location: stock_module_display.php"); 
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

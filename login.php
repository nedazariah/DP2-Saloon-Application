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
    
    <!--Custom style-->
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
                        <input type="text" name="user" id="user" maxlength="11" class="col-md-3"/>
                        <br/> 
                        <span id="userIDError" class="text-danger text-left col-md-3 col-md-offset-5"></span>
                    </div>
                       
                    <div class="form-group">   
                        <label for="pws" class="col-md-1 col-md-offset-4">Password: </label>
                        <input type="password" name="pws" id="pws" maxlength="20" class="col-md-3"/>
                        <br/> 
                        <span id="pwsError" class="text-danger text-left col-md-3 col-md-offset-5"></span>
                    </div>
                    
                    <div class="form-group text-center">
                        <input type="submit" name="login" id="login_button" class="btn btn-primary" value="Login"/><br/>
                        <a href="forgot_password.php" id="forgot_pws_link">Forgot Password</a>
                    </div>
                    
                </form>

            </div>
            
        </div>
        
        <div class="row">
           
            <div class="col-md-12" id="echo">
<?php
session_start(); 

//Message variable to be used for back-end validation
$user_error = $pws_error = $login_error = "";

//Form data processing block
if($_SERVER["REQUEST_METHOD"] == "POST")
{ 
	//Validate user id
    $input_user = SanitizeData($_POST["user"]);    
    if(empty($input_user))
    {
        $user_error = "User ID not found.";
        $hasError = true;
    }
    else 
    {
        $user = $input_user;
    } 
    
	//Validate password
    $input_pws = SanitizeData($_POST["pws"]);
    if(empty($input_pws))
    {
		$pws_error = "Password not found.";
		$hasError = true;
    }
	else
	{
        $pws = $input_pws;
    }		

	if(!($hasError))
	{ 
		$sql = "SELECT * FROM user WHERE userID ='$user'";
        
        if($result = mysqli_query($connect, $sql))
        {
            $row = mysqli_fetch_array($result); 
                        
            if(password_verify($pws, $row['userPass']))
            {
                $_SESSION['logged'] = true;	
                $_SESSION['loggedUser'] = $user; //Added by Almira
                mysqli_free_result($results);
                header("location: pendingappointment.php"); 
                exit();
            }
            else
            { 
                mysqli_free_result($results);
                $login_error = "Login failed.";
            }            
        }
        else
        {
            $login_error = "Login failed.";
        }
	}
}
?>                
            </div>
            
        </div>
        
    </div>
    
<!--Back-end form validation error output-->
<script>
    var user_error = "<?php echo $user_error; ?>";
    var pws_error = "<?php echo $pws_error; ?>";
    var login_error = "<?php echo $login_error; ?>";
    
    if(user_error.length !== 0)
    {
        document.getElementById("userIDError").innerHTML = user_error;
    }
    
    if(pws_error.length !== 0)
    {
        document.getElementById("pwsError").innerHTML = pws_error;
    }    
    
    if(login_error.length !== 0)
    {
        alert(login_error);
    }
</script>   
</body>
</html>

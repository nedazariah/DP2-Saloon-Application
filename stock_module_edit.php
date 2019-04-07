<?php
    require_once "dbconnect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Stock</title>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
	
	<!--Custom Style-->
	<link href="css/stock_style.css" rel="stylesheet"/>
	<link href="css/nav_style.css" rel="stylesheet"/>
    
    <!-- jQuery – required for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- All Bootstrap plug-ins file -->
    <script src="js/bootstrap.min.js"></script>
	
</head>
<body>
       
        <div id="stock_page">
           
            <div class="row">
               
                <div class="col-md-2">
                    <div class="sideNav">
                        <button class="dropdown-btn">Appointment</button>
                        <div class="dropdown-container">
                            <a href="#">Add Appointment</a>
                            <a href="#">Pending Appointments</a>
                            <a href="#">All Appointments</a>
                        </div>
                        <a href="#">Customers</a>
                        <a ref="stock_module_display.php">Stock</a>
                        <a href="#">Staff</a>

                        <div class="btm-menu">
                            <button class="dropdown-btn">Settings</button>
                            <div class="dropdown-container">
                                <a href="#">Manage Users</a>
                                <a href="#">Manage Services</a>
                            </div>
                            <a href="#">Logout</a>
                        </div>
                    </div>
                </div>
                              
                <div class="col-md-10">
                    
                    <form id="stock_form">
                   
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Update Stock</h1>                    
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" id="itemName" name="itemName" placeholder="Product Name  (required)" required="required"/> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="itemDesc" id="itemDesc" placeholder="Description"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <select name="itemType" id="itemType">
                                    <option value="" disabled selected hidden>Item Type</option>
                                    
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="itemBPrice">Buying Price:</label><input type="number" id="itemBPrice" name="itemBPrice"/> 
                                <label for="itemSPrice">Selling Price:</label><input type="number" id="itemSPrice" name="itemSPrice"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="itemQuantity">Number of stock:</label><input type="number" id="itemQuantity" name="itemQuantity"/>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12"><input type="submit" id="itemSubmit" value="Update"/></div>
                        </div>
                    </form>
                </div>
            </div>                
        </div>

<!--Javascript for Navigation Menu-->
<script src="js/nav.js"></script>
</body>
</html>

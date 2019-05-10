<?php
    ob_start();
?>
<!DOCTYPE html>
<html lang="en" data-ng-app="">

<head>
    <meta charset="UTF-8">
    <title>Item Sales Entry</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/nav_style.css">
</head>

<body>

    <?php    
        include "session_check.php";
        $sql = "SELECT * FROM inventory";
    ?>

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
                <h1>Item Sales</h1>
                <form action="itemSalesEntry.php" method="post" name="isForm" novalidate="novalidate">

                    <fieldset>
                        <legend>Item Detail</legend>
                        <div class="form-group">
                            <label for="itemID">Item ID:</label>
                            <select name="itemID" id="itemID" class="form-control" onchange="setName(this)" data-ng-model="itemID" required>
                                <option value="">Select Item ID</option>
                                <?php
                                    if($result = mysqli_query($connect, $sql)) {
                                        if(mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_array($result)) {
                                                echo "<option value='".$row['itemID']."' id='".$row['itemName']."'>".$row['itemID']."</option>";
                                            }
                                        }
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="itemName">Item Name:</label>
                            <input type="text" id="itemName" name="itemName" class="form-control" disabled>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Sales</legend>
                        <div class="form-group">
                            <label for="qPurchased">Quantity Purchased:</label>
                            <input type="number" id="qPurchased" name="qPurchased" class="form-control" data-ng-model="qPurchased" required>
                        </div>

                        <div class="form-group">
                            <label for="dPurchased">Date Purchased:</label>
                            <input type="date" id="dPurchased" name="dPurchased" class="form-control" data-ng-model="dPurchased" required>
                        </div>
                    </fieldset>

                    <div class="form-group text-center">
                        <div data-ng-if="isForm.$invalid">
                            <button type="submit" disabled class="btn btn-primary" data-ng-toggle="tooltip" title="Cannot Have Empty Field(s)">Submit</button>
                            <button type="button" class="btn btn-default" onclick="window.location.replace('item_sales_report.php')">Cancel</button>
                        </div>

                        <div data-ng-if="isForm.$valid">
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            <button type="button" class="btn btn-default" onclick="window.location.replace('item_sales_report.php')">Cancel</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>


    <script src="js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script>
        function setName(id) {
            document.getElementById("itemName").value = id[id.selectedIndex].id;
        }

    </script>
</body>

<?php
    if(isset($_POST['submit'])) {
        $itemID = $_POST['itemID'];
        $quantity = $_POST['qPurchased'];
        $date = $_POST['dPurchased'];
        
        if (!$connect) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO item_sales(itemID, qtyPurchased, datePurchased) VALUES('$itemID','$quantity','$date')";

        if (mysqli_query($connect,$sql)){
            echo "Success";
            header("location: item_sales_report.php");
            ob_enf_fluch();
        }
        else{
            echo "Failed to insert into database";
        }
        
    }
?>

</html>

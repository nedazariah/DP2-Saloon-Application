<!DOCTYPE html>
<html lang="en">
<?php
    include "session_check.php";
?>

<head>
    <title>Item Sales Report</title>
    <script src="getData.js"></script>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/nav_style.css">
    <link rel="stylesheet" type="text/css" href="css/nstyle.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>

    <style>
        h1 {
            padding-right: 15%;
        }

        th,
        td {
            padding: .5em;
            text-align: center;
        }

        #header {
            background-color: beige;

        }

    </style>
</head>

<body>
    <div class="npage">
        <div class="row">
            <div class="col-md-2">
                <div class="sideNav">
                    <?php
                        include "navigation.php";
                    ?>
                </div>
            </div>

            <div class="col-md-10">
                <h1>Item Sales Report</h1><br />
                <div class="row">
                    <div class="col-md-4">
                        <h2>Sales History</h2><br />
                        
                            <?php
                                $sql = "SELECT itemName, qtyPurchased, datePurchased FROM item_sales JOIN inventory WHERE item_sales.itemID = inventory.itemID ORDER BY datePurchased DESC";
                        
                                if($result = mysqli_query($connect, $sql)){
                                    echo "<div class='table-responsive'>";
                                    echo "<table class='table table-striped table-hover'>";
                                        echo "<thead id='header'>";
                                            echo "<tr>";
                                                echo "<th>Item Name</th>";
                                                echo "<th>Quantity Purchased</th>";
                                                echo "<th>Date Purchased</th>";
                                            echo "</tr>";
                                        echo "</thead>";
        
                                        while($row = mysqli_fetch_array($result)){
                                            echo "<tbody>";
				                                echo "<tr>";
					                               echo "<td>" . $row['itemName'] . "</td>";
					                               echo "<td>" . $row['qtyPurchased'] . "</td>";
					                               echo "<td>" . $row['datePurchased'] . "</td>";
				                                echo "</tr>";
                                            echo "</tbody>";
		                                }                           
                                    echo "</table>"; 

		                            mysqli_free_result($result);
                                    echo "</div>";
                                }
                            ?>
                        
                    </div>

                    <div class="col-md-8">
                        <h2>Monthly Sales</h2><br />
                        <canvas id="myChart"></canvas><br/>
                        <a href='itemSalesEntry.php' class='btn btn-default'>Add New Sales</a>
                        <script>
                            getData();
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>
</body>

</html>

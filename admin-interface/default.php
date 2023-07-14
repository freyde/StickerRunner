<?php
include_once("../includes/dbh.inc.php");
include_once("../includes/functions.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Brands</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="page.css">
</head>
<body>
            <h1 class="ms-3">Admin - Dashboard</h1>
                    <div class="row mt-5">
                        
                        <div class="col-3 me-4 ms-5" style="background-color: blue; height: 170px;">
                            <h5 style="color: white; padding-top: 10px;">Daily Revenue</h5>    
                                <?php
                                    $select_total = "SELECT SUM(order_total_price) FROM `orders` WHERE payment_status = 'Paid' AND DATE(`order_date`) = DATE(NOW())";
                                    $result_select_total = mysqli_query($conn, $select_total);
                                   // $number_total = mysqli_num_rows($result_select_total);

                                    while($row = mysqli_fetch_array($result_select_total)){
                                        if(is_null($row['SUM(order_total_price)'])){
                                            echo "<h1 style='color: LightCyan; padding-top: 15px;'> ₱0.00 </h1>"; 
                                        } else {
                                            $total_rev = $row['SUM(order_total_price)' ] + 45;
                                            echo "<h1 style='color: white; padding-top: 15px;'> ₱$total_rev.00 </h1>";
                                        }
                                        
                                    }
                                ?>
                                <a href ="main_dashboard.php?sales_report" style="color: white; padding-top: 20px;">More info...</a>
                        </div>
                        <div class="col-2 me-4" style="background-color: blue;">
                            <h5 style="color: white; padding-top: 10px;">Placed Orders</h5> 
                                <?php
                                    $select_total_shipped = "SELECT * FROM `orders` WHERE order_status = 'Placed'";
                                    $result_select_total_shipped = mysqli_query($conn, $select_total_shipped);
                                    $number_total_shipped = mysqli_num_rows($result_select_total_shipped);

                                    echo "<h1 style='color: White; padding-top: 15px;'> $number_total_shipped </h1>";
                                ?>

                        </div>
                        <div class="col-2 me-4" style="background-color: blue;">
                            <h5 style="color: white; padding-top: 10px;">For Shipping</h5>
                                <?php
                                    $select_all_orders = "SELECT * FROM `orders` WHERE order_status = 'Shipping'";
                                    $result_select_all = mysqli_query($conn, $select_all_orders);
                                    $number_cancelled_orders = mysqli_num_rows($result_select_all);

                                    echo "<h1 style='color: White; padding-top: 15px;'> $number_cancelled_orders </h1>";
                                ?>
                        </div>
                        <div class="col-3" style="background-color: blue; width: 180px;">
                            <h5 style="color: white; padding-top: 10px;">Cancelled Orders</h5>
                                <?php
                                    $select_all_orders = "SELECT * FROM `orders` WHERE order_status = 'Cancelled'";
                                    $result_select_all = mysqli_query($conn, $select_all_orders);
                                    $number_cancelled_orders = mysqli_num_rows($result_select_all);

                                    echo "<h1 style='color: White; padding-top: 15px;'> $number_cancelled_orders </h1>";
                                ?>
                        </div>
                        <div class="col-2 ms-5 mt-5 border border-dark rounded-3" style="background-color: white; width: 170px;">
                            <h6 style="color: gray; padding-top: 10px;">Total # of Products</h6>
                                <?php
                                    $select_all_items = "SELECT * FROM `items`";
                                    $result_select_all = mysqli_query($conn, $select_all_items);
                                    $number_items = mysqli_num_rows($result_select_all);

                                    echo "<h1 style='color: gray; padding-top: 15px;'> $number_items </h1>";
                                ?>
                        </div>
                        <div class="col-2 ms-5 mt-5 border border-dark rounded-3" style="background-color: white; width: 170px;">
                            <h6 style="color: gray; padding-top: 10px;">Total # of Users</h6>
                                <?php
                                    $select_all_users = "SELECT * FROM `users`";
                                    $result_select_all_users = mysqli_query($conn, $select_all_users);
                                    $number_users = mysqli_num_rows($result_select_all_users);

                                    echo "<h1 style='color: gray; padding-top: 15px;'> $number_users </h1>";
                                ?>
                        </div>
                    </div>
</body>
</html>



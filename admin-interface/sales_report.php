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
    <title>Insert Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="page.css"> -->





</head>
    
<body>
    <div class="container shadow-lg bg-white" style="margin-top: 50px; width:100%;">
        <h1 class="text-start pt-3 pb-3">Sales Report</h1>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="main_dashboard.php?products">All Sales</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="main_dashboard.php?add_item">Add Item</a>
                </li> -->
            </ul>                                
    </div>

                    <div class="row mt-5">
                        
                        <div class="col-2 me-4 ms-5 rounded text-center" style="background-color: silver; height: 170px;">
                            <h5 style="color: black; padding-top: 10px;">Daily Sales</h5>    
                                <?php
                                    $select_total = "SELECT SUM(order_total_price) FROM `orders` WHERE payment_status = 'Paid' AND DATE(`order_date`) = DATE(NOW())";
                                    $result_select_total = mysqli_query($conn, $select_total);
                                   // $number_total = mysqli_num_rows($result_select_total);

                                    while($row = mysqli_fetch_array($result_select_total)){
                                        if(is_null($row['SUM(order_total_price)'])){
                                            echo "<h1 style='color: orangered; padding-top: 15px;'> ₱0.00 </h1>"; 
                                        } else {
                                            $total_rev = $row['SUM(order_total_price)' ] + 45;
                                            echo "<h1 style='color: orangered; padding-top: 15px;'> ₱$total_rev.00 </h1>";
                                        }
                                        
                                    }
                                ?>
                                <!-- <a href ="main_dashboard.php?sales_report" style="color: white; padding-top: 20px;">More info...</a> -->
                        </div>

                        <div class="col-2 me-4 ms-5 rounded text-center" style="background-color: silver; height: 170px;">
                            <h5 style="color: black; padding-top: 10px;">Weekly Sales</h5>    
                                <?php
                                    // $select_total = "SELECT MONTHNAME(order_date) FROM orders GROUP BY MONTH(order_date)";
                                    // $result_select_total = mysqli_query($conn, $select_total);
                                   // $number_total = mysqli_num_rows($result_select_total);

                                   $sql = "SELECT SUM(order_total_price) AS total_sales FROM orders WHERE MONTH(order_date) = 3";
                                   $result = $conn->query($sql);

                                   if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $totalSales = $row["total_sales"];
                                        echo  $totalSales;
                                    } else {
                                        $totalSales = 0;
                                    }

                                    // while($row = mysqli_fetch_array($result_select_total)){
                                    //     if(is_null($row['SUM(order_total_price)'])){
                                    //         echo "<h1 style='color: Orangered; padding-top: 15px;'> ₱0.00 </h1>"; 
                                    //     } else {
                                    //         $total_rev = $row['SUM(order_total_price)' ] + 45;
                                    //         echo "<h1 style='color: orangered; padding-top: 15px;'> ₱$total_rev.00 </h1>";
                                    //     }
                                        
                                    // }
                                ?>
                                <!-- <a href ="main_dashboard.php?sales_report" style="color: white; padding-top: 20px;">More info...</a> -->
                        </div>

                        <div class="rounded col-2 me-4 ms-5 text-center" style="background-color: silver; height: 170px;">
                            <h5 style="color: black; padding-top: 10px;">Monthly Sales</h5>    
                                <?php
                                    $select_total = "SELECT SUM(order_total_price) FROM `orders` WHERE payment_status = 'Paid' AND DATE(`order_date`) = DATE(NOW())";
                                    $result_select_total = mysqli_query($conn, $select_total);
                                   // $number_total = mysqli_num_rows($result_select_total);

                                    while($row = mysqli_fetch_array($result_select_total)){
                                        if(is_null($row['SUM(order_total_price)'])){
                                            echo "<h1 style='color: orangered; padding-top: 15px;'> ₱0.00 </h1>"; 
                                        } else {
                                            $total_rev = $row['SUM(order_total_price)' ] + 45;
                                            echo "<h1 style='color: orangered; padding-top: 15px;'> ₱$total_rev.00 </h1>";
                                        }
                                        
                                    }
                                ?>
                                <!-- <a href ="main_dashboard.php?sales_report" style="color: white; padding-top: 20px;">More info...</a> -->
                        </div>

                        <div class="rounded col-2 me-4 ms-5 text-center" style="background-color: silver; height: 170px;">
                            <h5 style="color: black; padding-top: 10px;">Yearly Sales</h5>    
                                <?php
                                    $select_total = "SELECT SUM(order_total_price) FROM `orders` WHERE payment_status = 'Paid' AND DATE(`order_date`) = DATE(NOW())";
                                    $result_select_total = mysqli_query($conn, $select_total);
                                   // $number_total = mysqli_num_rows($result_select_total);

                                    while($row = mysqli_fetch_array($result_select_total)){
                                        if(is_null($row['SUM(order_total_price)'])){
                                            echo "<h1 style='color: orangered; padding-top: 15px;'> ₱0.00 </h1>"; 
                                        } else {
                                            $total_rev = $row['SUM(order_total_price)' ] + 45;
                                            echo "<h1 style='color: orangered; padding-top: 15px;'> ₱$total_rev.00 </h1>";
                                        }
                                        
                                    }
                                ?>
                                <!-- <a href ="main_dashboard.php?sales_report" style="color: white; padding-top: 20px;">More info...</a> -->
                        </div>
                    </div>


                    <div class="sales">

                        <div class="row mt-5 text-center">
                            <div class="col-3 me-3 mb-3" style="background-color: DarkSeaGreen; height: 120px;">
                                <h4>January</h4>

                                <?php
                                    // $select_total = "SELECT MONTHNAME(order_date) FROM orders GROUP BY MONTH(order_date)";
                                    // $result_select_total = mysqli_query($conn, $select_total);
                                   // $number_total = mysqli_num_rows($result_select_total);

                                   $sql = "SELECT SUM(order_total_price) AS total_sales FROM orders WHERE MONTH(order_date) = 1";
                                   $result = $conn->query($sql);


                                   if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $totalSales = $row["total_sales"];
                                        echo  $totalSales;
                                    } else {
                                        echo "0";
                                    }
                                ?>


                            </div>
                            <div class="col-3 me-3 mb-3"style="background-color: DarkSalmon; height: 120px;">
                                <h4>February</h4>

                                <?php
                                    // $select_total = "SELECT MONTHNAME(order_date) FROM orders GROUP BY MONTH(order_date)";
                                    // $result_select_total = mysqli_query($conn, $select_total);
                                   // $number_total = mysqli_num_rows($result_select_total);

                                   $sql = "SELECT SUM(order_total_price) AS total_sales FROM orders WHERE MONTH(order_date) = 2";
                                   $result = $conn->query($sql);


                                   if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $totalSales = $row["total_sales"];
                                        echo  $totalSales;
                                    } else {
                                        echo "0";
                                    }
                                ?>


                            </div>
                            <div class="col-3 me-3 mb-3" style="background-color: GoldenRod; height: 120px;">
                                <h4>March</h4>

                                <?php
                                    // $select_total = "SELECT MONTHNAME(order_date) FROM orders GROUP BY MONTH(order_date)";
                                    // $result_select_total = mysqli_query($conn, $select_total);
                                   // $number_total = mysqli_num_rows($result_select_total);

                                   $sql = "SELECT SUM(order_total_price) AS total_sales FROM orders WHERE MONTH(order_date) = 3";
                                   $result = $conn->query($sql);


                                   if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $totalSales = $row["total_sales"];
                                        echo  $totalSales;
                                    } else {
                                        echo "0";
                                    }
                                ?>

                            </div>
                            <div class="col-3 me-3 mb-3"style="background-color: DarkSalmon; height: 120px;">
                                <h4>April</h4>

                                <?php
                                    // $select_total = "SELECT MONTHNAME(order_date) FROM orders GROUP BY MONTH(order_date)";
                                    // $result_select_total = mysqli_query($conn, $select_total);
                                   // $number_total = mysqli_num_rows($result_select_total);

                                   $sql = "SELECT SUM(order_total_price) AS total_sales FROM orders WHERE MONTH(order_date) = 4";
                                   $result = $conn->query($sql);


                                   if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $totalSales = $row["total_sales"];
                                        echo  $totalSales;
                                    } else {
                                        echo "0";
                                    }
                                ?>

                            </div>
                            <div class="col-3 me-3 mb-3" style="background-color: GoldenRod; height: 120px;">
                                <h4>May</h4>

                                <?php
                                    // $select_total = "SELECT MONTHNAME(order_date) FROM orders GROUP BY MONTH(order_date)";
                                    // $result_select_total = mysqli_query($conn, $select_total);
                                   // $number_total = mysqli_num_rows($result_select_total);

                                   $sql = "SELECT SUM(order_total_price) AS total_sales FROM orders WHERE MONTH(order_date) = 5";
                                   $result = $conn->query($sql);


                                   if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $totalSales = $row["total_sales"];
                                        echo  $totalSales;
                                    } else {
                                        echo "0";
                                    }
                                ?>

                            </div>
                            <div class="col-3 me-3 mb-3" style="background-color: DarkSeaGreen; height: 120px;">
                                <h4>June</h4>

                                <?php
                                    // $select_total = "SELECT MONTHNAME(order_date) FROM orders GROUP BY MONTH(order_date)";
                                    // $result_select_total = mysqli_query($conn, $select_total);
                                   // $number_total = mysqli_num_rows($result_select_total);

                                   $sql = "SELECT SUM(order_total_price) AS total_sales FROM orders WHERE MONTH(order_date) = 6";
                                   $result = $conn->query($sql);


                                   if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $totalSales = $row["total_sales"];
                                        echo  $totalSales;
                                    } else {
                                        echo "0";
                                    }
                                ?>

                            </div>
                            <div class="col-3 me-3 mb-3"style="background-color: DarkSalmon; height: 120px;">
                                <h4>July</h4>

                                <?php
                                    // $select_total = "SELECT MONTHNAME(order_date) FROM orders GROUP BY MONTH(order_date)";
                                    // $result_select_total = mysqli_query($conn, $select_total);
                                   // $number_total = mysqli_num_rows($result_select_total);

                                   $sql = "SELECT SUM(order_total_price) AS total_sales FROM orders WHERE MONTH(order_date) = 7";
                                   $result = $conn->query($sql);


                                   if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $totalSales = $row["total_sales"];
                                        echo  "<h2 style='color: white;'>₱$totalSales.00</h2>";
                                    } else {
                                        echo "0";
                                    }
                                ?>

                            </div>
                            <div class="col-3 me-3 mb-3" style="background-color: GoldenRod; height: 120px;">
                                <h4>August</h4>


                                <?php
                                    // $select_total = "SELECT MONTHNAME(order_date) FROM orders GROUP BY MONTH(order_date)";
                                    // $result_select_total = mysqli_query($conn, $select_total);
                                   // $number_total = mysqli_num_rows($result_select_total);

                                   $sql = "SELECT SUM(order_total_price) AS total_sales FROM orders WHERE MONTH(order_date) = 8";
                                   $result = $conn->query($sql);


                                   if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $totalSales = $row["total_sales"];
                                        echo  $totalSales;
                                    } else {
                                        echo "0";
                                    }
                                ?>
                            </div>
                            <div class="col-3 me-3 mb-3"style="background-color: DarkSalmon; height: 120px;">
                                <h4>September</h4>

                                <?php
                                    // $select_total = "SELECT MONTHNAME(order_date) FROM orders GROUP BY MONTH(order_date)";
                                    // $result_select_total = mysqli_query($conn, $select_total);
                                   // $number_total = mysqli_num_rows($result_select_total);

                                   $sql = "SELECT SUM(order_total_price) AS total_sales FROM orders WHERE MONTH(order_date) = 9";
                                   $result = $conn->query($sql);


                                   if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $totalSales = $row["total_sales"];
                                        echo  $totalSales;
                                    } else {
                                        echo "0";
                                    }
                                ?>


                            </div>
                            <div class="col-3 me-3 mb-3" style="background-color: GoldenRod; height: 120px;">
                                <h4>October</h4>

                                <?php
                                    // $select_total = "SELECT MONTHNAME(order_date) FROM orders GROUP BY MONTH(order_date)";
                                    // $result_select_total = mysqli_query($conn, $select_total);
                                   // $number_total = mysqli_num_rows($result_select_total);

                                   $sql = "SELECT SUM(order_total_price) AS total_sales FROM orders WHERE MONTH(order_date) = 10";
                                   $result = $conn->query($sql);


                                   if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $totalSales = $row["total_sales"];
                                        echo  $totalSales;
                                    } else {
                                        echo "0";
                                    }
                                ?>


                            </div>
                            <div class="col-3 me-3 mb-3"style="background-color: DarkSalmon; height: 120px;">
                                <h4>November</h4>

                                <?php
                                    // $select_total = "SELECT MONTHNAME(order_date) FROM orders GROUP BY MONTH(order_date)";
                                    // $result_select_total = mysqli_query($conn, $select_total);
                                   // $number_total = mysqli_num_rows($result_select_total);

                                   $sql = "SELECT SUM(order_total_price) AS total_sales FROM orders WHERE MONTH(order_date) = 11";
                                   $result = $conn->query($sql);


                                   if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $totalSales = $row["total_sales"];
                                        echo  $totalSales;
                                    } else {
                                        echo "0";
                                    }
                                ?>

                            </div>
                            <div class="col-3 me-3 mb-3" style="background-color: GoldenRod; height: 120px;">
                                <h4>December</h4>

                                <?php
                                    // $select_total = "SELECT MONTHNAME(order_date) FROM orders GROUP BY MONTH(order_date)";
                                    // $result_select_total = mysqli_query($conn, $select_total);
                                   // $number_total = mysqli_num_rows($result_select_total);

                                   $sql = "SELECT SUM(order_total_price) AS total_sales FROM orders WHERE MONTH(order_date) = 12";
                                   $result = $conn->query($sql);


                                   if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $totalSales = $row["total_sales"];
                                        echo  "<h2 style='color: orange;'>$totalSales</h2>";
                                    } else {
                                        echo "0";
                                    }
                                ?>



                            </div>
                        </div>




                    <div class="list-of-products">
        <?php
            $select_list = mysqli_query($conn, "SELECT * FROM orders WHERE order_status = 'Cancelled'");
        ?>

        <table class="table table-bordered border-primary table-success mt-5">
            <thead class="text-center fw-bold">
                <tr>
                    <th>Package Number</th>
                    <!-- <th>Item Code</th> -->
                    <th>Item Image</th>
                    <th>Item Name</th>
                    <th>Item Total Price</th>
                    <th>Ordered At</th>
                    <th>Payment Method</th>
                    <th>Paid</th>
                    <th>Status</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <?php
                while($row = mysqli_fetch_assoc($select_list)){
            ?>
                <tr style="font-size: 14px;">
                    <td class="text-center"><?php echo $row["package_num"] ?></td>
                    <!-- <td class="text-center"><?php echo $row["order_item_code"] ?></td> -->
                    <td class="text-center">
                        <img src="../admin-interface/item_images/<?= $row["order_item_image"] ?>" height="50" width="50" alt="" />
                    </td>
                    <td><?php echo $row["order_item_name"] ?></td>
                    <td class="text-center">₱<?php echo $row["order_item_price"] + 45 ?>.00</td>
                    <td class="text-center"><?php echo $row["order_date"] ?></td>
                    <td class="text-center"><?php echo $row["payment_method"] ?></td>
                    <td class="text-center"><?php echo $row["payment_status"] ?></td>
                    <td class="text-center"><?php echo $row["order_status"] ?></td>
                    <!-- <td class="text-center"><button type="button" class="btn btn-link">Edit</button></td> -->
                    <td class="text-center">
                        <button type="button" name="paidBtn" id="paidBtn" value="<?php echo $row["order_item_code"] ?>" class="btn btn-success">Paid</button>
                    </td>
                </tr>
                    
            <?php
                };
            ?>
        </table>
    </div>  
                    </div>






                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                        <br><br><br>
                                    
    

                 
    
    <script src="../jquery-3.6.3.js"></script>
    <script src="../assets/paid_function.js"></script>


       

</body>
</html>
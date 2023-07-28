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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="page.css"> -->
</head>

<body>
    <div class="container shadow-lg bg-white">
        <h1 class="text-center pt-1 pb-3">Sales Report</h1>
        <h5 style="color: black;">Today Sales</h5>
        <?php
        $select_total = "SELECT SUM(order_total_price) FROM `orders` WHERE payment_status = 'Paid' AND DATE(`order_date`) = DATE(NOW())";
        $result_select_total = mysqli_query($conn, $select_total);
        // $number_total = mysqli_num_rows($result_select_total);

        while ($row = mysqli_fetch_array($result_select_total)) {
            if (is_null($row['SUM(order_total_price)'])) {
                echo "<h1 style='color: orangered;'> ₱0.00 </h1>";
            } else {
                $total_rev = $row['SUM(order_total_price)'];
                echo "<h1 style='color: orangered;'> ₱$total_rev.00 </h1>";
            }
        }
        ?>
        <!-- <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="main_dashboard.php?products">All Sales</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" href="main_dashboard.php?add_item">Add Item</a>
                </li>
        </ul> -->
    </div>

    <div class="row mt-1">
        <div class="col-md-10">
            <div class="row mt-4">
                <div class="mb-4 col-md-4">
                    <label for="exampleFormControlInput1" class="form-label">From:</label>
                    <input id="startDate" type="date" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="mb-4 col-md-4">
                    <label for="exampleFormControlTextarea1" class="form-label">To:</label>
                    <input id="endDate" type="date" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="mt-4 col-md-3 d-flex align-items-center">
                    <button id="generateReportBtn" name="generateReportBtn" type="submit" class="btn btn-primary mb-3">Generate Report</button>
                </div>
            </div>
        </div>
    </div>


    <div class="sales">
        <div class="list-of-products table-responsive">
            <button id="printReportBtn" name="printReportBtn" class="float-end btn btn-primary mb-3">Print Report</button>
            <table id="salesTable" class="table table-bordered table-striped align-middle">
                <thead class="table-light text-center fw-bold">
                    <tr>
                        <th>Order Date</th>
                        <!-- <th>Item Code</th> -->
                        <th>Order ID</th>
                        <th>Item Name</th>
                        <th>Item Price</th>
                        <th>Item Quantity</th>
                        <th>Payment Method</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <script src="../jquery-3.6.3.js"></script>
    <script src="../assets/paid_function.js"></script>
</body>

</html>
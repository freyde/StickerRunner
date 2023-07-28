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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="page.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <h1 class="ms-3">Admin - Dashboard</h1>
    <div class="row">
        <div class="col-md-6">
            <h4>Top Selling Products</h4>
            <canvas id="topSelling"></canvas>
        </div>
        <div class="col-md-6">
        <h4>Operational Data</h4>
        <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daily Sales</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><?= date("Y-m-d") ?></h6>
                            <?php
                            $select_total = "SELECT SUM(order_total_price) FROM `orders` WHERE payment_status = 'Paid' AND DATE(`order_date`) = DATE(NOW())";
                            $result_select_total = mysqli_query($conn, $select_total);
                            // $number_total = mysqli_num_rows($result_select_total);
                            echo "<figure class='text-end'>";
                            while ($row = mysqli_fetch_array($result_select_total)) {
                                if (is_null($row['SUM(order_total_price)'])) {
                                    echo "<h1> ₱0.00 </h1>";
                                } else {
                                    $total_rev = $row['SUM(order_total_price)'];
                                    echo "<h1> ₱$total_rev.00 </h1>";
                                }
                            }
                            echo "</figure>";
                            ?>
                            <a class="float-end" href="main_dashboard.php?sales_report">More info...</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Placed Orders</h5>
                            <?php
                            $select_total_shipped = "SELECT * FROM `orders` WHERE order_status = 'Placed'";
                            $result_select_total_shipped = mysqli_query($conn, $select_total_shipped);
                            $number_total_shipped = mysqli_num_rows($result_select_total_shipped);

                            echo "<figure class='text-end'>
                            <h1> $number_total_shipped </h1>
                         </figure>";
                            ?>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">To Ship</h5>
                            <br>
                            <?php
                            $select_all_orders = "SELECT * FROM `orders` WHERE order_status = 'Shipping'";
                            $result_select_all = mysqli_query($conn, $select_all_orders);
                            $number_cancelled_orders = mysqli_num_rows($result_select_all);

                            echo "<figure class='text-end'>
                    <h1> $number_cancelled_orders </h1>
                    </figure>";
                            ?>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h4>Monthly Sales</h4>
            <canvas id="monthlySales"></canvas>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-3">
            <h4>Order Success Rate</h4>
            <canvas id="orderStatus"></canvas>
        </div>
    </div>

    <!-- <div class="row">

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
    </div> -->
</body>

<script src="../jquery-3.6.3.js"></script>
<script>
    const topSelling = document.getElementById('topSelling');
    const monthlySales = document.getElementById('monthlySales');
    // const labels = Utils.months({
    //     count: 7
    // });

    $(document).ready(function() {
        $.ajax({
            method: "POST",
            url: "charts.php",
            data: {
                "type": 'topSelling',
            },
            success: function(result) {
                var data = JSON.parse(result);
                var itemNames = [];
                var itemSold = [];
                for (var i = 1; i < data.length; i++) {
                    itemNames.push(data[i]['item_name'].split(" "));
                    itemSold.push(data[i]['num_sold']);
                }

                new Chart(topSelling, {
                    type: 'bar',
                    data: {
                        labels: itemNames,
                        datasets: [{
                            data: itemSold,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        barThickness: 50,
                        plugins: {
                            legend: {
                                display: false,
                            },
                        }
                    },
                });
            },
            error: function(response) {
                alert("Something went wrong");
            }
        });


        var year = new Date().getFullYear();
        $.ajax({
            method: "POST",
            url: "charts.php",
            data: {
                "type": 'monthlySales',
                "year": year,
            },
            success: function(result) {
                var data = JSON.parse(result);
                var monthsText = ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"]
                var months = [];
                var totalPrice = [];
                for (var i = 1; i < data.length; i++) {
                    months.push(monthsText[data[i]['month(order_date)']]);
                    totalPrice.push(data[i]['sum(order_total_price)']);
                }

                new Chart(monthlySales, {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: [{
                            data: totalPrice,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        tension: 0.3,
                        plugins: {
                            legend: {
                                display: false,
                            },
                        }
                    }
                });
            },
            error: function(response) {
                alert("Something went wrong");
            }
        });

        $.ajax({
            method: "POST",
            url: "charts.php",
            // dataType: "json",
            data: {
                "type": 'orderStatus',
            },
            success: function(result) {
                var data = JSON.parse(result);
                var status = [];
                var count = [];
                console.log(data);
                for (var i = 1; i < data.length; i++) {
                    status.push(data[i]['order_status']);
                    count.push(data[i]['count(order_status)']);
                }

                new Chart(orderStatus, {
                    type: 'pie',
                    data: {
                        labels: status,
                        datasets: [{
                            label: 'Order Status',
                            data: count,
                        }]
                    }
                });
            },
            error: function(response) {
                alert("Something went wrong");
            }
        });
    });
</script>

</html>
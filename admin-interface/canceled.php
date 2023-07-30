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
    <div class="container shadow-lg bg-white" style="margin-top: 50px; width:100%;">
        <h1 class="text-start pt-3 pb-3">Cancelled Orders List</h1>
        <ul class="nav nav-tabs nav-fill">
            <li class="nav-item">
                <a class="nav-link" href="main_dashboard.php?orders">Orders List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="main_dashboard.php?placed_orders">Placed Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="main_dashboard.php?to_ship">To Ship</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="main_dashboard.php?in_transit">In-Transit</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="main_dashboard.php?delivered">Delivered</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="main_dashboard.php?cancelled"><strong><u>Cancelled</u></strong></a>
            </li>
        </ul>
    </div>
    <div class="list-of-products">
        <?php
        $select_list = mysqli_query($conn, "SELECT * FROM orders WHERE order_status='Cancelled' ORDER BY order_date DESC");
        ?>

        <table class="table table-bordered table-striped border-primary table-hover" id="orderTable">
            <thead class="text-center fw-bold">
                <th>Package Number</th>
                <th>Customer Email</th>
                <!-- <th>Item Code</th> -->
                <th>Item Image</th>
                <th>Item Name</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Item Total Price</th>
                <th>Ordered At</th>
                <th>Payment Method</th>
                <th>GCash Reference No.</th>
                <th>Paid</th>
                <th style="width:14%">Status</th>
                <!-- <th colspan="2">Action</th> -->
            </thead>
            <?php
            if (mysqli_num_rows($select_list) > 0) {
                $pre = "";
                while ($row = mysqli_fetch_assoc($select_list)) {
                    if ($row["package_num"] != $pre) {
            ?>
                        <tr style="font-size: 14px;">
                            <td class="text-center"><b><?php echo $row["package_num"] ?></b></td>
                            <td class="text-center"><?php echo $row["order_email_add"] ?></td>
                            <td class="text-center">
                                <?php
                                if ($row["order_item_code"] == $row["order_item_name"]) {
                                    $name = "Custom - " . $row["order_item_name"];
                                    $files = glob("../custom/" . $row['order_item_image'] . "/*");
                                ?>
                                    <img src="../custom/<?= $files[1] ?>" height="50" width="50" alt="" />
                                <?php
                                } else {
                                    $name = $row["order_item_name"];
                                ?>
                                    <img src="item_images/<?= $row['order_item_image'] ?>" height="50" width="50" alt="" />
                                <?php
                                }
                                ?>
                            </td>
                            <td class="text-center"><?php echo $name ?></td>
                            <td class="text-center"><?php echo $row["order_item_size"] ?></td>
                            <td class="text-center"><?php echo $row["order_item_quantity"] ?></td>
                            <td class="text-center">₱<?php echo $row["order_total_price"] + 45 ?>.00</td>
                            <td class="text-center"><?php echo $row["order_date"] ?></td>
                            <td class="text-center"><?php echo $row["payment_method"] ?></td>
                            <td class="text-center"><?php echo $row["gcash_ref"] ?></td>
                            <td class="text-center" style="width:14%">
                                <?php
                                if ($row["payment_status"] == "Paid") {
                                    echo "<select class='form-select' payment-id= '" . $row['package_num'] . "' payment-email='" . $row['order_email_add'] . "' name='payment_status_change' aria-label='Default select example' disabled>";
                                ?>
                                    <option value="<?php echo $row["payment_status"]; ?>" selected><?php echo $row["payment_status"]; ?></option>
                                <?php
                                } else if ($row["payment_status"] == "Not Paid") {
                                    echo "<select class='form-select' payment-id= '" . $row['package_num'] . "' payment-email='" . $row['order_email_add'] . "' name='payment_status_change' aria-label='Default select example'>";
                                ?>
                                    <option value="Paid">Paid</option>
                                    <option value="Paid" selected>Not Paid</option>
                                <?php
                                }
                                ?>
                                </select>
                            </td>
                            <td class="text-center" style="width:15%">
                                <select class="form-select" status-id=<?php echo $row["package_num"]; ?> status-email=<?php echo $row["order_email_add"]; ?> name="order_status_change" aria-label="Default select example">
                                    <?php
                                    if ($row["order_status"] == "Placed") {
                                    ?>
                                        <option value="Placed" selected>Placed</option>
                                        <option value="To Ship">To Ship</option>
                                        <option value="In-Transit">In-Transit</option>
                                        <option value="Delivered">Delivered</option>
                                        <option value="Cancelled">Cancelled</option>
                                    <?php
                                    } else if ($row["order_status"] == "To Ship") {
                                    ?>
                                        <option value="Placed" disabled>Placed</option>
                                        <option value="To Ship" selected disabled>To Ship</option>
                                        <option value="In-Transit">In-Transit</option>
                                        <option value="Delivered">Delivered</option>
                                        <option value="Cancelled">Cancelled</option>
                                    <?php
                                    } else if ($row["order_status"] == "In-Transit") {
                                    ?>
                                        <option value="Placed" disabled>Placed</option>
                                        <option value="To Ship" disabled>To Ship</option>
                                        <option value="In-Transit" selected disabled>In-Transit</option>
                                        <option value="Delivered">Delivered</option>
                                        <option value="Cancelled" disabled>Cancelled</option>
                                    <?php
                                    } else if ($row["order_status"] == "Delivered") {
                                    ?>
                                        <option value="Placed" disabled>Placed</option>
                                        <option value="To Ship" disabled>To Ship</option>
                                        <option value="In-Transit" disabled>In-Transit</option>
                                        <option value="Delivered" selected disabled>Delivered</option>
                                        <option value="Cancelled" disabled>Cancelled</option>
                                    <?php
                                    } else if ($row["order_status"] == "Cancelled") {
                                    ?>
                                        <option value="Cancelled" selected disabled>Cancelled</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    <?php
                        $pre = $row["package_num"];
                    } else {
                    ?>
                        <tr style="font-size: 14px;">
                            <td></td>
                            <td></td>
                            <td class="text-center">
                                <?php
                                if ($row["order_item_code"] == $row["order_item_name"]) {
                                    $name = "Custom - " . $row["order_item_name"];
                                    $files = glob("../custom/" . $row['order_item_image'] . "/*");
                                ?>
                                    <img src="../custom/<?= $files[1] ?>" height="50" width="50" alt="" />
                                <?php
                                } else {
                                    $name = $row["order_item_name"];
                                ?>
                                    <img src="item_images/<?= $row['order_item_image'] ?>" height="50" width="50" alt="" />
                                <?php
                                }
                                ?>
                            </td>
                            <td class="text-center"><?php echo $name ?></td>
                            <td class="text-center"><?php echo $row["order_item_size"] ?></td>
                            <td class="text-center"><?php echo $row["order_item_quantity"] ?></td>
                            <td class="text-center">₱<?php echo $row["order_item_price"] + 45 ?>.00</td>
                            <td class="text-center"><?php echo $row["order_date"] ?></td>
                            <td class="text-center"><?php echo $row["payment_method"] ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                <?php
                    }
                }
            } else {
                ?>
                <tr>
                    <td colspan="12" class="text-center"><strong>No Item</strong></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>



    <script src="../jquery-3.6.3.js"></script>
    <script src="../assets/paid_function.js"></script>

    <script>
        $(document).ready(function() {
            $('select[name="order_status_change"]').change(function() {
                var status = $(this).val();
                var package_num = $(this).attr("status-id");
                var email = $(this).attr("status-email");

                // alert(status);
                // alert(getid);
                // alert(email);

                $.ajax({
                    method: "POST",
                    url: "../includes/change_status.php",
                    data: {
                        status: status,
                        package_num: package_num,
                        email: email
                    },
                    success: function(response) {
                        alert("Order status update successful!");
                        location.reload();
                    },
                    error: function(response) {
                        alert("Error");
                    }
                });

            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('select[name="payment_status_change"]').change(function() {
                var Pstatus = $(this).val();
                var package_num = $(this).attr("payment-id");
                var email = $(this).attr("payment-email");

                // alert(Pstatus);
                // alert(getcode);
                // alert(email);

                $.ajax({
                    method: "POST",
                    url: "../includes/change_payment.php",
                    data: {
                        Pstatus: Pstatus,
                        package_num: package_num,
                        email: email
                    },
                    success: function(response) {
                        alert("Payment status update successful!");
                        location.reload();
                    },
                    error: function(response) {
                        alert("Error");
                    }
                });

            });
        });
    </script>
</body>

</html>
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

        <div class="row mx-auto">
            <div class="col-md-3">
                <h1 class="text-start pt-3">Orders List</h1>
            </div>
            <div class="col-md-9 align-middle">
                <div class="float-end mt-4">
                    <input class="form-control form-control-sm rounded-pill block" onkeyup="searchFunction()" type="text" id="searchString" name="searchString" placeholder="Search" aria-label="Search">
                </div>
            </div>
        </div>
        <div>
            <ul class="nav nav-tabs nav-fill">
                <li class="nav-item">
                    <a class="nav-link" href="main_dashboard.php?orders"><strong><u>Orders List</u></strong></a>
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
                    <a class="nav-link" href="main_dashboard.php?cancelled">Cancelled</a>
                </li>
            </ul>
            <div class="list-of-products">
                <?php
                $select_list = mysqli_query($conn, "SELECT * FROM orders ORDER BY order_date DESC");
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
        </div>
    </div>
    <div class='modal fade' id='expectedDeliveryModal' tabindex='-1' aria-labelledby='expectedDeliveryModal' aria-hidden='true'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='exampleModalLabel'>Expected Delivery Date</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    <input class="form-control" type="date" id="deliveryDate" name="deliveryDate">
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                    <button type='button' class='btn btn-primary' id="updateDeliveryDateBtn">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</body>



<script src=" ../jquery-3.6.3.js">
</script>
<script src="../assets/paid_function.js"></script>

<script>
    var status;
    var package_num;
    var email;
    $(document).ready(function() {
        $('select[name="order_status_change"]').change(function() {
            status = $(this).val();
            package_num = $(this).attr("status-id");
            email = $(this).attr("status-email");

            if (status == "To Ship")
                $('#expectedDeliveryModal').modal('show');
            else
                updateStatus(status, package_num, email);
        });

        $("#updateDeliveryDateBtn").click(function() {
            var delivery_date = $('#deliveryDate').val();
            updateStatus(status, package_num, email, delivery_date);
        });
    });

    function updateStatus(status, package_num, email) {
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
    }

    function updateStatus(status, package_num, email, delivery_date) {
        $.ajax({
            method: "POST",
            url: "../includes/change_status.php",
            data: {
                status: status,
                package_num: package_num,
                email: email,
                delivery_date: delivery_date
            },
            success: function(response) {
                alert("Order status update successful!");
                location.reload();
            },
            error: function(response) {
                alert("Error");
            }
        });
    }
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

        var $rows = $('#orderTable tr:not(:first)');
        $('#searchString').keyup(function() {

            var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
                reg = RegExp(val, 'i'),
                text;

            $rows.show().filter(function() {
                text = $(this).text().replace(/\s+/g, ' ');
                return !reg.test(text);
            }).hide();
        });
    });
</script>

</html>
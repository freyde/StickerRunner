<?php
session_start();
include('dbh.inc.php');



if (isset($_SESSION["userEmailAdd"])) {
    $selectData = "SELECT * FROM users WHERE email_add ='{$_SESSION["userEmailAdd"]}'";
    $query = mysqli_query($conn, $selectData);

    if (mysqli_num_rows($query)) {
        while ($users = mysqli_fetch_array($query)) {
            $email_add = $users["email_add"];
        }
    }

    if (isset($_POST["orders_id"])) {
        $ordersId = $_POST["orders_id"];
        $payment = $_POST["payment_method"];
        $package_unique_num = mt_rand(100000000000, 999999999999);

        $_SESSION['pack_num'] = $package_unique_num;

        foreach ($ordersId as $order_id) {
            echo $order_id;
            $select = "SELECT * FROM `cart_table` WHERE item_id = '$order_id' AND email_add = '$email_add'";

            $result = mysqli_query($conn, $select);

            while ($row = mysqli_fetch_assoc($result)) {
                $item_id = $row["item_id"];
                $item_code = $row["item_code"];
                $item_name = $row["item_name"];
                $item_price = $row["item_price"];
                $item_size = $row["size"];
                $item_quantity = $row["quantity"];
                $item_image = $row["item_image"];

                $total_price = ($item_price * $item_quantity);

                // echo $package_unique_num . " " . $item_id . " " . $item_code  . " " . $item_name  . " " . $item_price  . " " . $item_size  . " " . $item_quantity  . " " . $email_add;

                $place_item = "INSERT INTO `orders` 
                    (package_num, order_item_code, order_item_name, order_item_price, 
                    order_item_size, order_item_quantity, order_total_price, payment_method,
                     payment_status, order_item_image, order_email_add, order_date, order_status)
                    VALUES ('$package_unique_num', '$item_code', '$item_name',
                    '$item_price', '$item_size', '$item_quantity', '$total_price', '$payment', 'Not Paid', '$item_image', '$email_add', NOW(), 'Placed')";

                $result_place_item = mysqli_query($conn, $place_item);
            }
            $delete_items = "DELETE FROM `cart_table` WHERE item_id = '$order_id'";
            $result = mysqli_query($conn, $delete_items);
        }
    } else {
        echo "no";
    }
}

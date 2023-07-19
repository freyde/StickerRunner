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
        $gcashRef = $_POST['gcashRef'];
        $package_unique_num = mt_rand(100000000000, 999999999999);

        $_SESSION['pack_num'] = $package_unique_num;
        echo $_SESSION['checkout'];
        if ($_SESSION['checkout']) {
            foreach ($ordersId as $order_id) {
                $select = "SELECT * FROM `checkout_items` WHERE check_id = '$order_id' AND check_email_add = '$email_add'";

                $result = mysqli_query($conn, $select);

                while ($row = mysqli_fetch_assoc($result)) {
                    $item_id = $row["check_id"];
                    $item_code = $row["check_code"];
                    $item_name = $row["check_name"];
                    $item_price = $row["check_price"];
                    $item_size = $row["check_size"];
                    $item_quantity = $row["check_quantity"];
                    $item_image = $row["check_image"];

                    $total_price = ($item_price * $item_quantity);

                    // echo $package_unique_num . " " . $item_id . " " . $item_code  . " " . $item_name  . " " . $item_price  . " " . $item_size  . " " . $item_quantity  . " " . $email_add;

                    $place_item = "INSERT INTO `orders` 
                    (package_num, order_item_code, order_item_name, order_item_price, 
                    order_item_size, order_item_quantity, order_total_price, payment_method,
                     payment_status, order_item_image, order_email_add, order_date, order_status, gcash_ref)
                    VALUES ('$package_unique_num', '$item_code', '$item_name',
                    '$item_price', '$item_size', '$item_quantity', '$total_price', '$payment', 'Not Paid', '$item_image', '$email_add', NOW(), 'Placed', '$gcashRef')";

                    $result_place_item = mysqli_query($conn, $place_item);
                }

                $delete_items = "DELETE FROM `checkout_items` WHERE check_id = '$order_id'";
                $result = mysqli_query($conn, $delete_items);
            }
            unset($_SESSION['checkout']);
        } else if (isset($_SESSION['custom'])) {
           echo"asdasd";
            foreach ($ordersId as $order_id) {
                $select = "SELECT * FROM `custom_shirt` WHERE custom_id = '$order_id' AND custom_email = '$email_add'";

                $result = mysqli_query($conn, $select);

                while ($row = mysqli_fetch_assoc($result)) {
                    $item_id = $row["check_id"];
                    $item_code = $row["custom_id"];
                    $item_name = $row["custom_id"];
                    $item_price = $row["custom_price"];
                    $item_size = $row["custom_size"];
                    $item_quantity = 1;
                    if ($row["custom_front"] != NULL)
                        $item_image = $row["custom_front"];
                    else
                        $item_image = $row["custom_back"];

                    $total_price = ($item_price * $item_quantity);

                    // echo $package_unique_num . " " . $item_id . " " . $item_code  . " " . $item_name  . " " . $item_price  . " " . $item_size  . " " . $item_quantity  . " " . $email_add;

                    $place_item = "INSERT INTO `orders` 
                    (package_num, order_item_code, order_item_name, order_item_price, 
                    order_item_size, order_item_quantity, order_total_price, payment_method,
                     payment_status, order_item_image, order_email_add, order_date, order_status, gcash_ref)
                    VALUES ('$package_unique_num', '$item_code', '$item_name',
                    '$item_price', '$item_size', '$item_quantity', '$total_price', '$payment', 'Not Paid', '$item_image', '$email_add', NOW(), 'Placed', '$gcashRef')";

                    $result_place_item = mysqli_query($conn, $place_item);
                }

                $delete_items = "DELETE FROM `custom_shirt` WHERE custom_id = '$item_code'";
                $result = mysqli_query($conn, $delete_items);
            }
            unset($_SESSION['custom']);
        } else {
            foreach ($ordersId as $order_id) {
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
                     payment_status, order_item_image, order_email_add, order_date, order_status, gcash_ref)
                    VALUES ('$package_unique_num', '$item_code', '$item_name',
                    '$item_price', '$item_size', '$item_quantity', '$total_price', '$payment', 'Not Paid', '$item_image', '$email_add', NOW(), 'Placed', '$gcashRef')";

                    $result_place_item = mysqli_query($conn, $place_item);
                }
                // echo "<script>alert('asdasdas')</script>";
                $delete_items = "DELETE FROM `cart_table` WHERE item_id = '$order_id'";
                $result = mysqli_query($conn, $delete_items);
                // echo "asdasd";
            }
        }
    } else {
        echo "no";
    }
}

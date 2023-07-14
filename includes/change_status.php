<?php
session_start();
include('dbh.inc.php');

    if(isset($_POST["status"])){
        $status = $_POST["status"];
        $getid = $_POST["getid"];
        $getemail = $_POST["email"];

            $update_status = "UPDATE `orders` SET order_status = '$status' WHERE order_item_code = '$getid' AND order_email_add = '$getemail'";
            return $result_update_status = mysqli_query($conn, $update_status);

    }
?>
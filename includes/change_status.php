<?php
session_start();
include('dbh.inc.php');

    if(isset($_POST["status"])){
        $status = $_POST["status"];
        $package_num = $_POST["package_num"];
        $getemail = $_POST["email"];

            $update_status = "UPDATE `orders` SET order_status = '$status' WHERE package_num = '$package_num' AND order_email_add = '$getemail'";
            return $result_update_status = mysqli_query($conn, $update_status);

    }
?>
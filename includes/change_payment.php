<?php
session_start();
include('dbh.inc.php');

    if(isset($_POST["Pstatus"])){
        $Pstatus = $_POST["Pstatus"];
        $package_num = $_POST["package_num"];
        $getemail = $_POST["email"];

            $update_payment_status = "UPDATE `orders` SET payment_status = '$Pstatus' WHERE package_num = '$package_num' AND order_email_add = '$getemail'";
            return $result_update_payment_status = mysqli_query($conn, $update_payment_status);
    }
?>

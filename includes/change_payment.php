<?php
session_start();
include('dbh.inc.php');

    if(isset($_POST["Pstatus"])){
        $Pstatus = $_POST["Pstatus"];
        $getcode = $_POST["getcode"];
        $getemail = $_POST["email"];

            $update_payment_status = "UPDATE `orders` SET payment_status = '$Pstatus' WHERE order_item_code = '$getcode' AND order_email_add = '$getemail'";
            return $result_update_payment_status = mysqli_query($conn, $update_payment_status);
    }
?>

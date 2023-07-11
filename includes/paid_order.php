<?php
    session_start();
    include('dbh.inc.php');

    if(isset($_POST['item_code'])){
        $i_c = $_POST['item_code'];
        
        $update_order = "UPDATE orders SET payment_status = 'Paid' WHERE order_item_code = '$i_c'";
        return $result = mysqli_query($conn, $update_order);

    } else {
        return 'aye';
    }

?>
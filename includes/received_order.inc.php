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

    if(isset($_POST["package_num"])){
        $package = $_POST["package_num"];
        
        $select_packages = "SELECT * FROM `orders` WHERE package_num = '$package'";
        $result_select_packages = mysqli_query($conn, $select_packages);

        if(mysqli_num_rows($result_select_packages) > 0){
            $update_package = "UPDATE `orders` SET order_status = 'Received' WHERE package_num = '$package' AND order_email_add = '$email_add'";
            $result_update_package = mysqli_query($conn, $update_package);

                if($result_update_package){
                    echo "Order has been received!";
                } else {
                    echo "Something went wrong!";
                }

        } else {
            echo "Something went wrong";
        }
    }
    else{
        echo "no";
    }
}
?>
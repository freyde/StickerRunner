<?php
    session_start();
    include_once("dbh.inc.php");
    global $conn;

        if(isset($_POST["save"])){
            $first_name = ucwords($_POST["e_first_name"]);
            $last_name = ucwords($_POST["e_last_name"]);
            $email_address = $_POST["e_email_or_phone"];
            $street_number = $_POST["street_num"];
            $barangay = $_POST["barangay"];
            $cityMun = $_POST["city_municipality"];
            $province = $_POST["provinces"];
            $mobile_number = $_POST["e_contact_number"];

            $updateAccount = "UPDATE `users` SET first_name = '$first_name', last_name = '$last_name',
            email_add = '$email_address', street_number = '$street_number', barangay = '$barangay',
            citymunicipality = '$cityMun', province = '$province', mobile_number = '$mobile_number'
            WHERE user_id ='{$_SESSION['user_Id']}' ";
            $result_update_account = mysqli_query($conn, $updateAccount);

            if($result_update_account){
                echo '<script>alert("Account has been successfully updated!")</script>';
                header("Location: ../manage_account.php");
            } else {
                echo '<script>alert("Something went wrong!v")</script>';
                header("Location: ../manage_account.php");
            }
        }
        else {
            echo '<script>alert("Something went wrong!a")</script>';
        }
?>
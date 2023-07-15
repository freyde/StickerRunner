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

            if(isset($_POST['scope'])){
                $scope = $_POST['scope'];
                switch ($scope){

                    case "add":
                        $item_code = $_POST['item_code'];
                        $item_qty = $_POST['item_qty'];
                        $item_size = $_POST['item_size'];

                        $select_query = "SELECT * FROM `items` WHERE item_code = '$item_code'";
                        $result_query = mysqli_query($conn, $select_query);

                        while ($row = mysqli_fetch_assoc($result_query)) {
                            $item_name = $row["item_name"];
                            $item_price = $row["item_price"];
                            $item_image = $row["item_image1"];
                        }   

                        $check_cart_item = "SELECT * FROM `cart_table` WHERE item_code = '$item_code' AND email_add = '$email_add' AND size = '$item_size'";
                        $result_check_cart_item = mysqli_query($conn, $check_cart_item);

                        if(mysqli_num_rows($result_check_cart_item) > 0){
                            $update_quantity = "UPDATE `cart_table` SET quantity= quantity + $item_qty WHERE item_code = '$item_code' AND email_add = '$email_add' AND size = '$item_size'";
                            $result_update_quantity= mysqli_query($conn, $update_quantity);
                        } else {
                            $insert_to_cartTbl = "INSERT INTO `cart_table` (item_code, item_name, item_price, size, quantity, item_image, email_add)
                            VALUES ('$item_code', '$item_name', '$item_price', '$item_size', '$item_qty', '$item_image', '$email_add')";
                            $insert_result = mysqli_query($conn, $insert_to_cartTbl);
                        }

                        break;


                    // case "place":
                        
                    //     if(isset($_POST["check_id_code"])){
                    //         echo '<script language="javascript">';
                    //         echo 'alert("message successfully sent")';
                    //         echo '</script>';
            
                    //         foreach ($_POST["check_id_code"] as $check_id_code){
                    //             $select = "SELECT * FROM `checkout_items` WHERE check_code = '$check_id_code'";
                    //             $result = mysqli_query($conn, $select);
            
                    //             while ($row = mysqli_fetch_assoc($result)) {
                    //                 $item_id = $row["check_id"];
                    //                 $item_code = $row["check_code"];
                    //                 $item_name = $row["check_name"];
                    //                 $item_price = $row["check_price"];
                    //                 $item_size = $row["check_size"];
                    //                 $item_quantity = $row["check_quantity"];
                    //                 $item_total_price = $row["SUM(total_price)"] + 45;
                    //                 $item_image = $row["check_image"];
                    //                 $email_address = $row["check_email_add"];
                                   
            
                    //                // $total_price = $item_price * $item_quantity;
            
                    //                $insert_to_Orders = "INSERT INTO `orders` (order_item_code, order_item_name, order_item_price, order_item_size, order_item_quantity, order_total_price, order_item_image,
                    //                order_item_email_add, order_date, order_status) VALUES ('$item_code', '$item_name', '$item_price', '$item_size',
                    //                 '$item_quantity', '$item_total_price', '$item_image', '$email_address', NOW(), 'To Be Delivered')";
                    //                $insert_Orders = mysqli_query($conn, $insert_to_Orders);
                    //             }
            
                    //         }
                    //         echo "successfully placed the item in the database";
                    //     } else {
                    //         echo "NOOOO";
                    //     }

                    //     break;

                        case "buy":
                            $item_code = $_POST['item_code'];
                            $item_qty = $_POST['item_qty'];
                            $item_size = $_POST['item_size'];
    
                            $select_query = "SELECT * FROM `items` WHERE item_code = '$item_code'";
                            $result_query = mysqli_query($conn, $select_query);
    
                            while ($row = mysqli_fetch_assoc($result_query)) {
                                $item_name = $row["item_name"];
                                $item_price = $row["item_price"];
                                $item_image = $row["item_image1"];
                            }
    
                           
                                $insert_to_check_Table = "INSERT INTO `checkout_items` (check_code, check_name, check_price, check_size, check_quantity, check_image, check_email_add)
                                VALUES ('$item_code', '$item_name', '$item_price', '$item_size', '$item_qty', '$item_image', '$email_add')";
                                $insert_result = mysqli_query($conn, $insert_to_check_Table);
                            break;
                    
                    case "update":
                        $item_code = $_POST['item_code'];
                        $item_qty = $_POST['item_qty'];
                        $item_size = $_POST['item_size'];

                        $check_cart_item = "SELECT * FROM `cart_table` WHERE item_code = '$item_code' AND email_add = '$email_add' AND size = '$item_size'";
                        $result_check_cart_item = mysqli_query($conn, $check_cart_item);

                        if(mysqli_num_rows($result_check_cart_item) > 0){
                            $update_query = "UPDATE `cart_table` SET quantity = '$item_qty' WHERE item_code = '$item_code' AND email_add = '$email_add' AND size = '$item_size' ";
                            $result_update_query = mysqli_query($conn, $update_query);

                                if($result_update_query){
                                    echo "Item quantity has been updated. Quantity: $item_qty";
                                } else {
                                    echo "Something went wrong!";
                                }

                        } else {
                            echo "Something went wrong";
                        }
                        break;

                    case "delete":
                        $item_code = $_POST['item_code'];
                        $item_size = $_POST['item_size'];
                        
                        $check_cart_item = "SELECT * FROM `cart_table` WHERE item_code = '$item_code' AND email_add = '$email_add' AND size = '$item_size'";
                        $result_check_cart_item = mysqli_query($conn, $check_cart_item);

                        if(mysqli_num_rows($result_check_cart_item) > 0){
                            $delete_query = "DELETE FROM `cart_table` WHERE item_code = '$item_code' AND email_add = '$email_add' AND size = '$item_size'";
                            $result_delete_query= mysqli_query($conn, $delete_query);

                                if($result_delete_query){
                                    echo ("Item has been successfully deleted!");
                                } else {
                                    echo ("Something went wrong!");
                                }
                        } else {
                            echo ("Something went wrong!");
                        }
                        break;
                    
                        // case "update_checkout":
                        //     $check_id_code
                        //     break;

                    default:
                        echo "Something went wrong!";
                }
            }

            if(isset($_POST["id"])){
                foreach ($_POST["id"] as $id){
                    $delete_all_query = "DELETE FROM `cart_table` WHERE item_id = '$id' ";
                    $result_delete_all_query = mysqli_query($conn, $delete_all_query);
                }
            }

            if(isset($_POST["item_id"])){
                $current_price = 0;
                $count = 0;
                foreach ($_POST["item_id"] as $item_id){
                    $fetch_price = "SELECT * FROM `cart_table` WHERE item_id = '$item_id' ";
                    $result_fetch_query = mysqli_query($conn, $fetch_price);
                    
                    if (mysqli_num_rows($result_fetch_query)) {
                        
                        while ($fetch = mysqli_fetch_array($result_fetch_query)) {

                            $price = $fetch["item_price"];
                            $quantity = $fetch["quantity"];
                            $pPrice = intval($price);
                            $pQuantity = intval($quantity);
                            $total_price = intval($price) * intval($quantity);
                            $current_price = $current_price + $total_price;

                        }
                    }
                }
                echo $current_price;
            }



            if(isset($_POST["check_id"])){
                foreach ($_POST["check_id"] as $check_id){
                    $select = "SELECT * FROM `cart_table` WHERE item_id = '$check_id'";
                    $result = mysqli_query($conn, $select);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $item_id = $row["item_id"];
                        $item_code = $row["item_code"];
                        $item_name = $row["item_name"];
                        $item_price = $row["item_price"];
                        $item_size = $row["size"];
                        $item_quantity = $row["quantity"];
                        $item_image = $row["item_image"];
                        $email = $row["email_add"];

                        $total_price = $item_price * $item_quantity;

                        $place_item = "INSERT INTO `checkout_items` (check_id, check_code, check_name, check_price,
                        check_size, check_quantity, total_price, check_image, check_email_add) VALUES ('$check_id', '$item_code', '$item_name',
                        '$item_price', '$item_size', '$item_quantity', '$total_price', '$item_image', '$email')";
                        $result_place_item = mysqli_query($conn, $place_item);
                    }

                }
                echo "successfully placed the item in the database";
            }

            if(isset($_POST["check_id_code"])){
                foreach ($_POST["check_id_code"] as $check_id_code){
                    $select = "SELECT * FROM `cart_table` WHERE item_id = '$check_id_code'";
                    $result = mysqli_query($conn, $select);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $item_id = $row["item_id"];
                        $item_code = $row["item_code"];
                        $item_name = $row["item_name"];
                        $item_price = $row["item_price"];
                        $item_size = $row["size"];
                        $item_quantity = $row["quantity"];
                        $item_image = $row["item_image"];
                        $email = $row["email_add"];

                        $total_price = $item_price * $item_quantity;

                        $place_item = "INSERT INTO `checkout_items` (check_id, check_code, check_name, check_price,
                        check_size, check_quantity, total_price, check_image, check_email_add) VALUES ('$check_id', '$item_code', '$item_name',
                        '$item_price', '$item_size', '$item_quantity', '$total_price', '$item_image', '$email')";
                        $result_place_item = mysqli_query($conn, $place_item);
                    }

                }
                echo "successfully placed the item in the database";
            } 

            











        } 






?>
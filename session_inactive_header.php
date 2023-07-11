<?php

include_once("includes/dbh.inc.php");
include_once("includes/functions.inc.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TopBuds Clothing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="page.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" />
    <script src="jquery-3.6.3.js"></script>
</head>
<body>
     <!----Promo Banner----->
    <div class="promo">
        <h4 class = "h6" style="text-align: center; color: white; padding-top: 5px;">Get P100 off on your first purchase for a min spend of P2,000</h4>
    </div>
    <!----Header----->
    <div class="header" id="myHeader">
        <ul class="list-group list-group-horizontal-sm" style="padding-top: 20px; padding-left: 100px; list-style: none;">
            <li><a href="homepage.php"><h2 style="color: white; padding-top: 7px;">TopBuds</h2></a></li>
            <li style="padding-bottom: -90px; padding-left: 250px;">
                <nav class="navbar navbar-light">
                    <div class="container-fluid" style="padding-left: 400px;">
                        <form method="get" class="d-flex" action="" style="width: 300px;">
                            <input type="search" class="form-control me-2" name="search_query" placeholder="Search">
                            <input type="submit" class="btn btn-outline-warning" value="search" name="search_btn"></input>
                        </form>
                    </div>
                  </nav>
            </li>
            <li style="padding-left: 10px;">
            <?php
                if (isset($_SESSION["userEmailAdd"])) {
                    $selectData = "SELECT * FROM users WHERE email_add ='{$_SESSION["userEmailAdd"]}'";
                    $query = mysqli_query($conn, $selectData);
                    if (mysqli_num_rows($query)) {
                        while ($users = mysqli_fetch_array($query)) {
                            $email_add = $users["email_add"];
                    ?>
                    <?php
                        $cart_quantity = "SELECT * FROM users WHERE email_add ='{$_SESSION["userEmailAdd"]}'";
                        $sql = "SELECT * FROM cart_table WHERE email_add ='{$_SESSION["userEmailAdd"]}'";
                        $mysqliStatus = mysqli_query($conn, $sql);
                        $rows_count_value = mysqli_num_rows($mysqliStatus);         
                    ?>
                         <a href="shoppingcartpage.php?email_add=<?php echo $email_add ?>">
                                <img style="width: 35px; height: 50px; padding-top: 6px;" src="shopping_cart.png" alt="">
                                <span class="badge bg-danger rounded-pill" style="padding-top: -110px; margin-left: -20px;">
                                <?php echo $rows_count_value ?></span>
                        </a>
                    <?php        
                        } 
                    }
                }  else {
                    ?>
                    <a href="loginpage.php">
                        <img style="width: 30px; height: 43px; padding-top: 13px;" src="shopping_cart.png" alt="">
                    </a>
                    <?php
                }
            ?>
               
            </li>
            <li style="padding-left: 10px;">
                <?php
                   if(isset($_SESSION["userEmailAdd"])){
                    $selectData = "SELECT * FROM users WHERE email_add ='{$_SESSION["userEmailAdd"]}'";
                    $query = mysqli_query($conn, $selectData);
                    if(mysqli_num_rows($query)){
                        while($users = mysqli_fetch_array($query)){
                    ?>
                            <div class="accdropdown">
                                <button onclick="clickAccDropdown()" class="accdropbtn dropdown-toggle" 
                                style="text-align: right; width: 70px; margin-top: 11px;" 
                                data-toggle="dropdown"><?php echo $users["first_name"]; ?></button>
                                <div id="myAccDropdown" class="accdropdown-content float-end" style="text-align: right; width: 10px;">
                                    <a href="manage_account.php">Manage Account</a>
                                    <a href="#">My Orders</a>
                                    <a href="includes/logout.inc.php">Log Out</a>
                                </div>
                            </div>
                        <?php
                        }      
                    } 
                } else { 
                ?>
                    <a href="loginpage.php">
                        <img style="width: 30px; height: 43px; padding-top: 13px;" src="user_icon.png" alt="">
                    </a>
                <?php                    
                }
                ?>
            </li>
        </ul>

        <!---- UL for Categories ----->

        <!-- <ul class="list-group list-group-horizontal-sm" style="list-style: none; padding-left: 590px; margin-top: -35px;">
            <li>
                <h6 style="color: white;">All Products</h6>
            </li>
            <li style="padding-left: 50px;">
                <a href="aboutus.php">About Us</a>
            </li>
        </ul> -->
            
            <ul class="list-group list-group-horizontal-sm" style="list-style:none; margin-top: -11px; padding-left: 690px;">
                <li style="padding-right: 20px;">
                <a href="all_products.php">All Products</a>
                </li>
                <li>
                    <a href="aboutus.php">About Us</a>
                </li>

            </ul>

    </div>
            </body>
    
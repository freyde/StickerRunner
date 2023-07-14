<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once("includes/dbh.inc.php");
include_once("includes/functions.inc.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sticker Runners</title>
    <link rel="icon" type="image/png" href="../StickerRunner/images/stickerRunnerLogo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="page.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" />
    <script src="jquery-3.6.3.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="jquery-3.6.3.js"></script>
    <!-- Calling jQuery -->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/fabric@5.3.0/dist/fabric.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
    <!----Promo Banner----->
    <!-- <div class="promo">
        <h4 class = "h6" style="text-align: center; color: white; padding-top: 5px;">Get P100 off on your first purchase for a min spend of P2,000</h4>
    </div> -->
    <!----Header----->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="index.php">
                <div class="row">
                    <div class="col-md-2">
                        <img src="..//StickerRunner/images/stickerRunnerLogo.png" alt="StickerRunner" style="height: 43px; width: 43px">
                    </div>
                    <div class="col-md-10">
                        <h2 style="color: white; padding-top: 5px">Sticker Runners </h2>
                    </div>
                </div>
            </a>
            
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="all_products.php" class="nav-link">All Products</a>
                    </li>
                    <li class="nav-item">
                        <a href="designer.php" class="nav-link">Make Your Own</a>
                    </li>
                    <li class="nav-item">
                        <a href="aboutus.php" class="nav-link">About Us</a>
                    </li>
                </ul>
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item">
                        <form class="d-flex" role="search" method="get" action="search_item.php">
                            <input class="form-control me-2 rounded-pill" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-light" type="submit">Search</button>
                        </form>
                    </li>
                    <li class="nav-item">
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
                                        <img style="width: 35px; height: 50px;" src="shopping_cart.png" alt="">
                                        <span class="badge bg-danger rounded-pill" style="padding-top: -110px; margin-left: -20px;">
                                            <?php echo $rows_count_value ?></span>
                                    </a>
                            <?php
                                }
                            }
                        } else {
                            ?>
                            <a href="loginpage.php">
                                <img style="width: 35px; height: 35px; margin-left: 40px" src="shopping_cart.png" alt="">
                            </a>
                        <?php
                        }
                        ?>
                    </li>
                    <li class="nav-item">
                        <?php
                        if (isset($_SESSION["userEmailAdd"])) {
                            $selectData = "SELECT * FROM users WHERE email_add ='{$_SESSION["userEmailAdd"]}'";
                            $query = mysqli_query($conn, $selectData);
                            if (mysqli_num_rows($query)) {
                                while ($users = mysqli_fetch_array($query)) {
                        ?>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-link mt-2 dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                            <?php echo $users["first_name"]; ?>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-lg-end">
                                            <li><button class="dropdown-item" type="button" onclick="window.location.href='manage_account.php'">Manage Account</button></li>
                                            <li><button class="dropdown-item" type="button" onclick="window.location.href='my_orders.php'">My Orders</button></li>
                                            <li><button class="dropdown-item" type="button" onclick="window.location.href='includes/logout.inc.php'">Log Out</button></li>
                                        </ul>
                                    </div>
                                    <!-- <div class="accdropdown">
                                    <button onclick="clickAccDropdown()" class="accdropbtn dropdown-toggle"
                                    style="text-align: right; width: 70px; margin-top: 11px;"
                                    data-toggle="dropdown"></button>
                                    <div id="myAccDropdown" class="accdropdown-content dropdown-menu-start" style="text-align: right; width: 10px;">
                                        <a href="manage_account.php">Manage Account</a>
                                        <a href="my_orders.php">My Orders</a>
                                        <a href="includes/logout.inc.php">Log Out</a>
                                    </div>
                                </div> -->
                            <?php
                                }
                            }
                        } else {
                            ?>
                            <a href="loginpage.php">
                                <img style="width: 30px; height: 30px; margin-left: 10px; margin-right:20px" src="user_icon.png" alt="">
                            </a>
                        <?php
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


</body>
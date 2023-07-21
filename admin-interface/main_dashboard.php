<?php
include_once("../includes/dbh.inc.php");
include_once("../includes/functions.inc.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sticker Runner - Administrator</title>
    <link rel="icon" type="image/png" href="../images/stickerRunnerLogo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="page.css"> -->
    <script src="https://kit.fontawesome.com/d5585e7213.js" crossorigin="anonymous"></script>
    <script src="../jquery-3.6.3.js"></script>
    <script src="../assets/generate_report.js"></script><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</head>

<body>

    <?php
    if (isset($_SESSION["auth"])) {
        if (isset($_SESSION["role"]) == "admin") {
    ?>
            <div class="container-fluid p-0">
                <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: black;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="../images/stickerRunnerLogo.png" alt="StickerRunner" style="height: 43px; width: 43px">
                            </div>
                            <div class="col-md-10">
                                <h3 style="color: white; padding-top: 5px">Sticker Runner Admin</h3>
                            </div>
                            <!-- <a class="navbar-brand" href="#">Sticker Runners</a> -->
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                        <ul class="navbar-nav justify-content-end">
                            <li class="nav-item">
                                <?php
                                if (isset($_SESSION["userEmailAdd"])) {
                                    $selectData = "SELECT * FROM users WHERE email_add ='{$_SESSION["userEmailAdd"]}'";
                                    $query = mysqli_query($conn, $selectData);
                                    if (mysqli_num_rows($query)) {
                                        while ($users = mysqli_fetch_array($query)) {
                                ?>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark btn-lg dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                                    Admin - <?php echo $users["first_name"]; ?>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-lg-end">
                                                    <li><button class="dropdown-item" type="button" onclick="window.location.href='../includes/logout.inc.php'">Log Out</button></li>
                                                </ul>
                                            </div>
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
                </nav>


                <!-- SIDEBAR -->

                <div class="row">
                    <div class="col-md-2 bg-dark">
                        <div class="d-flex flex-column flex-shrink-0  text-white " style="height: 600px; width: 280px;">
                            <ul class="nav nav-pills flex-column mb-auto">
                                <li>
                                    <a href="main_dashboard.php?dashboard" class="nav-link text-white">
                                        <i class="fa-sharp fa-regular fa-grid-horizontal"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="main_dashboard.php?orders" class="nav-link text-white">
                                        Orders
                                    </a>
                                </li>
                                <li>
                                    <a href="main_dashboard.php?products" class="nav-link text-white">
                                        Products
                                    </a>
                                </li>
                                <li>
                                    <a href="main_dashboard.php?custom" class="nav-link text-white">
                                        Custom Shirts
                                    </a>
                                </li>
                                <li>
                                    <a href="main_dashboard.php?users" class="nav-link text-white">
                                        Users
                                    </a>
                                </li>
                            </ul>
                            <hr>
                        </div>
                    </div>

                    <div class="col-10">
                        <div class="container" style="margin-top: 10px;">
                            <?php
                            if (isset($_GET["products"])) {
                                include("products.php");
                                if (isset($_GET["products_list"])) {
                                    include("products.php");
                                }
                                if (isset($_GET["add_item"])) {
                                    include("add_item.php");
                                }
                            }
                            if (isset($_GET["dashboard"])) {
                                include("default.php");
                            }
                            if (isset($_GET["orders"])) {
                                include("orders.php");
                            }
                            if (isset($_GET["custom"])) {
                                include("custom.php");
                            }
                            if (isset($_GET["custom_pending"])) {
                                include("custom_pending.php");
                            }
                            if (isset($_GET["users"])) {
                                include("users.php");
                            }
                            if (isset($_GET["add_item"])) {
                                include("add_item.php");
                            }
                            if (isset($_GET["sales_report"])) {
                                include("sales_report.php");
                            }
                            if (isset($_GET["placed_orders"])) {
                                include("placed_orders.php");
                            }
                            if (isset($_GET["to_ship"])) {
                                include("to_ship.php");
                            }
                            if (isset($_GET["in_transit"])) {
                                include("in_transit.php");
                            }
                            if (isset($_GET["delivered"])) {
                                include("delivered.php");
                            }
                            if (isset($_GET["cancelled"])) {
                                include("canceled.php");
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    <?php
        } else {
            header("Location: ../index.php");
        }
    } else {
        header("Location: ../loginpage.php?");
    }
    ?>
</body>

</html>
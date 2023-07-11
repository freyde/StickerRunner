<?php
include_once("../includes/dbh.inc.php");
include_once("../includes/functions.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TopBuds - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="page.css"> -->
</head>
<body>


    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: black;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Topbuds</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            
        </div>
        </nav>


            <!-- SIDEBAR -->

            <div class="row">
                <div class="col-3">
                    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="height: 600px; width: 280px;">
                        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
                        <span class="fs-4">Admin Panel</span>
                        </a>
                        <hr>
                        <ul class="nav nav-pills flex-column mb-auto">
                        <li>
                            <a href="main_dashboard.php?dashboard" class="nav-link text-white">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
                            Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="main_dashboard.php?orders" class="nav-link text-white">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                            Orders
                            </a>
                        </li>
                        <li>
                            <a href="main_dashboard.php?products" class="nav-link text-white">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                            Products
                            </a>
                           
                        </li>
                        <li>
                            <a href="main_dashboard.php?users" class="nav-link text-white">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                            Users
                            </a>
                        </li>
                        </ul>
                        <hr>
                        <!-- <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong>mdo</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                        </div> -->
                    </div>
                </div>

                <div class="col-9">
                    <div class="container" style="margin-top: 50px; margin-left: -50px;">
                        <?php
                            if(isset($_GET["products"])){
                                include("products.php");
                                if(isset($_GET["products_list"])){
                                    include("products.php");
                                }
                                if(isset($_GET["add_item"])){
                                    include("add_item.php");
                                }
                            }
                            if(isset($_GET["dashboard"])){
                                include("default.php");
                            }
                            if(isset($_GET["orders"])){
                                include("orders.php");
                            }
                            if(isset($_GET["users"])){
                                include("users.php");
                            }
                            if(isset($_GET["add_item"])){
                                include("add_item.php");
                            } 
                            if(isset($_GET["sales_report"])){
                                include("sales_report.php");
                            }
                            if(isset($_GET["placed_orders"])){
                                include("placed_orders.php");
                            }
                            if(isset($_GET["to_ship"])){
                                include("to_ship.php");
                            } 
                            if(isset($_GET["in_transit"])){
                                include("in_transit.php");
                            } 
                            if(isset($_GET["delivered"])){
                                include("delivered.php");
                            } 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
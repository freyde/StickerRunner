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
    <title>Insert Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="page.css">
</head>
<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: black;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Topbuds</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="main_dashboard.php">Orders</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Accounts</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Products</a>
                </li>
            </ul>
            <span class="navbar-text">
                Navbar text with an inline element
            </span>
            </div>
        </div>
        </nav>

        <div class="container mt-4 shadow-lg" style="height: 750px; border: 1px solid darkgray;">
            <h1 class="text-center pt-4">Admin Dashboard</h1>
                <div class="btn-group mt-2" role="group" aria-label="Basic mixed styles example" style="height: 60px; margin-left: 20px;">
                    <button type="button" class="btn btn-warning" style="border: 2px solid darkorange">
                        <a href="admin_dashboard.php?add_mens_category" style="text-decoration: none; color: black;">Add Men's Category</a>
                    </button>
                    <button type="button" class="btn btn-warning" style="border: 2px solid darkorange">
                    <a href="admin_dashboard.php?view_mens_category" style="text-decoration: none; color: black;">View Men's Categories</a>
                    </button>
                    <button type="button" class="btn btn-warning" style="border: 2px solid darkorange">
                        <a href="admin_dashboard.php?add_womens_category" style="text-decoration: none; color: black;">Add Women's Category</a>
                    </button>
                    <button type="button" class="btn btn-warning" style="border: 2px solid darkorange">
                    <a href="admin_dashboard.php?view_womens_category" style="text-decoration: none; color: black;">View Women's Categories</a>
                    </button>
                    <button type="button" class="btn btn-warning" style="border: 2px solid darkorange">
                    <a href="admin_dashboard.php?add_item" style="text-decoration: none; color: black;">Add Item</a>
                    </button>
                    <button type="button" class="btn btn-warning" style="border: 2px solid darkorange">
                    <a href="admin_dashboard.php?add_brand" style="text-decoration: none; color: black;">Add Brand</a>
                    </button>
                    <button type="button" class="btn btn-warning" style="border: 2px solid darkorange">
                    <a href="admin_dashboard.php?add_item" style="text-decoration: none; color: black;">Add Item</a>
                    </button>
                    <button type="button" class="btn btn-warning" style="border: 2px solid darkorange">View Product</button>
                </div>
                
            <div class="container" style="margin-top: 50px; margin-left: 0px;">
                <?php
                    if(isset($_GET["add_mens_category"])){
                        include("add_mens_category.php");
                    }
                    if(isset($_GET["view_mens_category"])){
                        include("view_mens_category.php");
                    }
                    if(isset($_GET["add_womens_category"])){
                        include("add_womens_category.php");
                    }
                    if(isset($_GET["view_womens_category"])){
                        include("view_womens_category.php");
                    }
                    if(isset($_GET["add_item"])){
                        include("add_item.php");
                    }
                ?>
        </div>
                        <br><br><br><br><br><br>
        </div>
    </div>
</body>
</html>
<?php
include_once("../includes/dbh.inc.php");
include_once("../includes/functions.inc.php");

if (isset($_POST["updateItemBtn"])) {
    if (!isset($_POST['size_check'])) {
        echo "<script>alert('Please set available sizes.')</script>";
    } else {
        $size_raw = $_POST['size_check'];
        $uc_first = array_map('ucfirst', $size_raw);
        $size = implode(", ", $uc_first);

        $status = $_POST['status_check'];

        $item_code = $_GET['item_code'];
        $item_name = $_POST["item_name"];
        $item_price = $_POST["item_price"];
        $item_description = $_POST["item_description"];
        $item_keyword = $_POST["item_keyword"];
        $item_category = $_POST["item_category"];

        //accessing item images
        $item_image1 = $_FILES["item_image1"]["name"];
        $item_image2 = $_FILES["item_image2"]["name"];
        $item_image3 = $_FILES["item_image3"]["name"];

        //accessing image tmp name
        $temp_item_image1 = $_FILES["item_image1"]["tmp_name"];
        $temp_item_image2 = $_FILES["item_image2"]["tmp_name"];
        $temp_item_image3 = $_FILES["item_image3"]["tmp_name"];

        // checks if any forms are empty
        if (
            empty($item_name) || empty($item_price) || empty($item_description) || empty($item_keyword) || empty($item_category)
        ) {
            echo "<script>alert('Please fill all the available fields!')</script>";
            exit();
        } else {

            $update_item = "UPDATE items SET 
            item_name = '$item_name',
            item_price = '$item_price',
            sizes_available = '$size',
            item_description = '$item_description',
            item_keyword = '$item_keyword',
            item_category = '$item_category',";

            if (!empty($item_image1)) {
                move_uploaded_file($temp_item_image1, "./item_images/$item_image1");
                $update_item = $update_item . "item_image1 = '$item_image1',";
            }
            if (!empty($item_image2)) {
                move_uploaded_file($temp_item_image2, "./item_images/$item_image2");
                $update_item = $update_item . "item_image2 = '$item_image2',";
            }
            if (!empty($item_image3)) {
                move_uploaded_file($temp_item_image3, "./item_images/$item_image3");
                $update_item = $update_item . "item_image3 = '$item_image3',";
            }

            //insert query

            $item_description = mysqli_real_escape_string($conn, $item_description);
            $update_item = $update_item . "
            item_status = '$status'
            WHERE item_code = $item_code";
            $result_update = mysqli_query($conn, $update_item);
            if ($result_update) {
                header("Location: ../admin-interface/main_dashboard.php?products");
                // echo "<script>alert('Item has been updated successfully!')</script>";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="page.css"> -->
</head>

<body>

    <div class="container-fluid p-0">
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
                                <a href="main_dashboard.php?users" class="nav-link text-white">
                                    Users
                                </a>
                            </li>
                        </ul>
                        <hr>
                    </div>

                    <div class="col-9">
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
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="container">
                        <div id="edit_form">

                            <h1>Update Data</h1>
                            <?php
                            if (isset($_GET['item_code'])) {
                                $item_code = $_GET['item_code'];

                                $select = "SELECT * FROM items WHERE item_code = '$item_code'";
                                $result = mysqli_query($conn, $select);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $item_name = $row["item_name"];
                                    $item_price = $row["item_price"];
                                    $item_description = $row["item_description"];
                                    $item_category = $row["item_category"];
                                    $item_keyword = $row["item_keyword"];
                                    $item_image1 = $row["item_image1"];
                                    $item_image2 = $row["item_image2"];
                                    $item_image3 = $row["item_image3"];
                                }
                            }
                            ?>

                            <br>
                            <form action="" method="post" enctype="multipart/form-data"> <!-- enctype attribute to accept images in form -->
                                <div class="row">
                                    <div class="col-7" style=" height: 200px;">
                                        <div class="btn-group">
                                            <div class="form-group ps-3" style="height: 75px; width: 400px;">
                                                <small id="s1" class="form-text fst-italic">Item Name<span style="color: red;">*</span></small>
                                                <input type="text" class="form-control" name="item_name" id="item_name" value="<?php echo $item_name ?>" placeholder="<?php echo $item_name ?>" autocomplete="off" required="required">
                                            </div>
                                            <div class="form-group ps-3" style="background-color: rgb(255, 255, 255); height: 75px;">
                                                <small id="s2" class="form-text fst-italic">Item Price<span style="color: red;">*</span></small>
                                                <input type="text" class="form-control" name="item_price" value="<?php echo $item_price ?>" id="item_price" placeholder="Enter Item Price" required="required">
                                            </div>
                                        </div>

                                        <div class="size pt-2 pb-2">
                                            <small id="s2" class="form-text fst-italic ps-3">Size<span style="color: red;">*</span></small>
                                            <!-- <input class="form-check-input ms-3" type="checkbox" value="small" name="size_check[]" required>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Small
                                            </label>

                                            <input class="form-check-input" type="checkbox" value="medium" name="size_check[]">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Medium
                                            </label>

                                            <input class="form-check-input" type="checkbox" value="large" name="size_check[]">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Large
                                            </label>

                                            <input class="form-check-input" type="checkbox" value="extra Large" name="size_check[]">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Extra Large
                                            </label> -->

                                            <div class="form-check form-check-inline checkbox-group" required>
                                                <input class="form-check-input ms-1" type="checkbox" value="small" name="size_check[]">
                                                <label class="form-check-label" for="inlineCheckbox1">Small</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="medium" name="size_check[]">
                                                <label class="form-check-label" for="inlineCheckbox2">Medium</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="large" name="size_check[]">
                                                <label class="form-check-label" for="inlineCheckbox3">Large</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="extra Large" name="size_check[]">
                                                <label class="form-check-label" for="inlineCheckbox3">Extra Large</label>
                                            </div>
                                        </div>



                                        <div class="form-group ps-3" style="background-color: rgb(255, 255, 255); height: 75px;  margin-bottom: 50px;">
                                            <!---<label for="item_description">Item Description</label>-->
                                            <small id="s3" class="form-text fst-italic">Item Description<span style="color: red;">*</span></small>
                                            <textarea class="form-control" style="height: 100px;" name="item_description" id="item_description" placeholder="<?php echo $item_description ?>" required="required"><?php echo $item_description ?></textarea>
                                        </div>
                                        <div class="btn-group pt-3">

                                            <div class="form-group ps-3" style="width: 300px;">
                                                <small id="s5" class="form-text fst-italic">Select a Category<span style="color: red;">*</span></small>
                                                <select class="form-select" name="item_category" id="item_category" aria-label="Default select example" required="required">
                                                    <option disabled selected hidden>Select a Category</option>
                                                    <?php
                                                    $select_query = "SELECT * FROM mens_categories";
                                                    $resultOfSelectQuery = mysqli_query($conn, $select_query);

                                                    while ($row = mysqli_fetch_assoc($resultOfSelectQuery)) {
                                                        $category_name = $row["mens_category_name"];
                                                        $category_id = $row["mens_category_id"];
                                                        if ($item_category == $category_name)
                                                            echo "<option value='$category_name' selected>$category_name</option>";
                                                        else
                                                            echo "<option value='$category_name'>$category_name</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="col-4" style="height: 215px;">

                                        <div class="form-check">
                                            <input class="form-check-input" name="status_check" type="radio" value="Available" id="status_check">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Available
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" name="status_check" type="radio" value="Out of Stock" id="status_check">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Out of Stock
                                            </label>
                                        </div>


                                        <div class="form-group" style="background-color: rgb(255, 255, 255); height: 75px; width: 260px;">
                                            <small id="s4" class="form-text fst-italic">Item Keyword<span style="color: red;">*</span></small>
                                            <input type="text" class="form-control" name="item_keyword" value="<?php echo $item_keyword ?>" id="item_keyword" placeholder="Enter Item Keyword" required="required">
                                            <small id="emailHelp" class="form-text text-muted"></small>
                                        </div>
                                        <?php
                                        if (isset($_GET['item_code'])) {
                                        ?>
                                            <div class="form-group" style="background-color: rgb(255, 255, 255); height: 75px;">
                                                <small id="s6" class="form-text fst-italic">Item Image 1</small>
                                                <input type="file" class="form-control" name="item_image1" id="item_image1">
                                                <small id="emailHelp" class="form-text text-muted"></small>
                                            </div>
                                            <div class="form-group" style="background-color: rgb(255, 255, 255); height: 75px;">
                                                <small id="s7" class="form-text fst-italic">Item Image 2</small>
                                                <input type="file" class="form-control" name="item_image2" id="item_image2">
                                                <small id="emailHelp" class="form-text text-muted"></small>
                                            </div>
                                            <div class="form-group">
                                                <small id="s7" class="form-text fst-italic">Item Image 3</small>
                                                <input type="file" class="form-control" name="item_image3" id="item_image3">
                                                <small id="emailHelp" class="form-text text-muted"></small>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="form-group" style="background-color: rgb(255, 255, 255); height: 75px;">
                                                <small id="s6" class="form-text fst-italic">Item Image 1<span style="color: red;">*</span></small>
                                                <input type="file" class="form-control" name="item_image1" id="item_image1" required="required">
                                                <small id="emailHelp" class="form-text text-muted"></small>
                                            </div>
                                            <div class="form-group" style="background-color: rgb(255, 255, 255); height: 75px;">
                                                <small id="s7" class="form-text fst-italic">Item Image 2<span style="color: red;">*</span></small>
                                                <input type="file" class="form-control" name="item_image2" id="item_image2" required="required">
                                                <small id="emailHelp" class="form-text text-muted"></small>
                                            </div>
                                            <div class="form-group">
                                                <small id="s7" class="form-text fst-italic">Item Image 3<span style="color: red;">*</span></small>
                                                <input type="file" class="form-control" name="item_image3" id="item_image3" required="required">
                                                <small id="emailHelp" class="form-text text-muted"></small>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>

                                <button type="submit" name="updateItemBtn" class="btn btn-warning" style="margin-left: 40px; width: 50%; margin-top: 120px; font-size: 20px;">Update</button>

                                <br><br><br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="../jquery-3.6.3.js"></script>
    <script src="./assets/checkout_function.js"></script>


    <script>
        $('input#status_check').on('change', function() {
            $('input#status_check').not(this).prop('checked', false);
        });
    </script>

</body>

</html>
<?php
include_once("../includes/dbh.inc.php");
include_once("../includes/functions.inc.php");

if(isset($_POST["updateItemBtn"])){

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
    if(empty($item_name) || empty($item_price) || empty($item_description) || empty($item_keyword) || empty($item_category)
    || empty($item_image1) || empty($item_image2) || empty($item_image3)){
        echo "<script>alert('Please fill all the available fields!')</script>";
        exit();
    } else {
        // move_uploaded_file($temp_item_image1, "./item_images/$item_image1");
        // move_uploaded_file($temp_item_image2, "./item_images/$item_image2");
        // move_uploaded_file($temp_item_image3, "./item_images/$item_image3");

        //insert query

        $item_description = mysqli_real_escape_string($conn, $item_description);

    
            $update_item = "UPDATE items SET 
            item_name = '$item_name',
            item_price = '$item_price',
            sizes_available = '$size',
            item_description = '$item_description',
            item_keyword = '$item_keyword',
            item_category = '$item_category',
            item_image1 = '$item_image1',
            item_image3 = '$item_image2',
            item_image2 = '$item_image3',
            item_status = '$status'
            WHERE item_code = $item_code";
            $result_update = mysqli_query($conn, $update_item);
            if($result_update){
                header("Location: http://localhost/topbuds/admin-interface/main_dashboard.php?products");
                // echo "<script>alert('Item has been updated successfully!')</script>";
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
            <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Orders</a>
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


            <!-- SIDEBAR -->

            <div class="row">
                <div class="col-3">
                    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="height: 600px; width: 280px;">
                        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
                        <span class="fs-4">Sidebar</span>
                        </a>
                        <hr>
                        <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="main_dashboard.php?home" class="nav-link text-white" aria-current="page">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                            Home
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link text-white">
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
                        <div id="edit_form">

                <h1>Update Data</h1>
                <?php 
                    if(isset($_GET['item_code'])){
                        $item_code = $_GET['item_code'];
                        
                        $select = "SELECT * FROM items WHERE item_code = '$item_code'";
                        $result = mysqli_query($conn, $select);

                        while($row = mysqli_fetch_assoc($result)){
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
                                <input type="text" class="form-control" name="item_price" value="<?php echo $item_price ?>"  id="item_price" placeholder="Enter Item Price" required="required">
                            </div>
                        </div>

                        <div class="size pt-2 pb-2">
                            <small id="s2" class="form-text fst-italic ps-3">Size<span style="color: red;">*</span></small>
                                <input class="form-check-input ms-3" type="checkbox" value="small" name="size_check[]">
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
                                    </label>
                        </div>
                       


                            <div class="form-group ps-3" style="background-color: rgb(255, 255, 255); height: 75px;  margin-bottom: 50px;">
                                <!---<label for="item_description">Item Description</label>-->
                                <small id="s3" class="form-text fst-italic">Item Description<span style="color: red;">*</span></small>
                                <textarea class="form-control" style="height: 100px;" name="item_description" id="item_description" placeholder="<?php echo $item_description ?>" required="required"></textarea>
                            </div>
                            <div class="btn-group pt-3">
                                <div class="form-group ps-3" style="width: 200px;">
                                    <small id="s5" class="form-text fst-italic">Gender<span style="color: red;">*</span></small>
                                        <select class="form-select" name="gender_category" id="gender_category" style="" 
                                         onchange="checkGenderValue(this.value)" aria-label="Default select example" required="required">
                                            <option disabled selected>Select a Gender</option>
                                            <?php
                                                $select_query = "SELECT * FROM `categories`";
                                                $resultOfSelectQuery = mysqli_query($conn, $select_query);
                                                
                                                while($row = mysqli_fetch_assoc($resultOfSelectQuery)){
                                                    $category_name = $row["category_name"];
                                                    $category_id = $row["category_id"];

                                                    echo "<option value='$category_name'>$category_name</option>";
                                                }
                                            
                                            ?>
                                        </select>
                                </div>
                                <div class="form-group ps-3" style="width: 300px;">
                                    <small id="s5" class="form-text fst-italic">Select a Category<span style="color: red;">*</span></small>
                                        <select class="form-select" name="item_category" id="item_category" style="" aria-label="Default select example" required="required">
                                        <option disabled selected>Select a Category</option>
                                            <?php
                                                $select_query = "SELECT * FROM mens_categories";
                                                    $resultOfSelectQuery = mysqli_query($conn, $select_query);
                           
                                                    while($row = mysqli_fetch_assoc($resultOfSelectQuery)){
                                                       $category_name = $row["mens_category_name"];
                                                       $category_id = $row["mens_category_id"];
                           
                                                      echo "<option value='$category_name'>$category_name</option>";
                                                   }

                                                   $select_query1 = "SELECT * FROM womens_categories";
                                                   $resultOfSelectQuery1 = mysqli_query($conn, $select_query1);
                          
                                                   while($row = mysqli_fetch_assoc($resultOfSelectQuery1)){
                                                      $category_name1 = $row["womens_category_name"];
                                                      $category_id1 = $row["womens_category_id"];
                          
                                                     echo "<option value='$category_name1'>$category_name1</option>";
                                                  }
                                            ?>
                                        </select>
                                </div>
                            </div>

                            
                            
                    </div>
                        <div class="col-4" style="height: 215px;">

                        <div class="form-check">
                            <input class="form-check-input" name="status_check" type="checkbox" value="Available" id="status_check">
                            <label class="form-check-label" for="flexCheckDefault">
                                Available
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" name="status_check" type="checkbox" value="Out of Stock" id="status_check">
                            <label class="form-check-label" for="flexCheckDefault">
                                Out of Stock
                            </label>
                        </div>
                                                

                            <div class="form-group" style="background-color: rgb(255, 255, 255); height: 75px; width: 260px;">
                                <small id="s4" class="form-text fst-italic">Item Keyword<span style="color: red;">*</span></small>
                                <input type="text" class="form-control" name="item_keyword" value="<?php echo $item_keyword ?>" id="item_keyword" placeholder="Enter Item Keyword" required="required">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
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
                            <div class="form-group" style="">
                                <small id="s7" class="form-text fst-italic">Item Image 3<span style="color: red;">*</span></small>
                                <input type="file" class="form-control" name="item_image3" id="item_image3" required="required">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                </div>
                
                <button type="submit" name="updateItemBtn" class="btn btn-warning" style="margin-left: 40px; width: 50%;
                margin-top: 120px; font-size: 20px;">Update</button>

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
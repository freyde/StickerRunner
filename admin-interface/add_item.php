<?php
include_once("../includes/dbh.inc.php");
include_once("../includes/functions.inc.php");

if (isset($_POST["addItemBtn"])) {
    $item_code = rand(1000, 9999);
    $item_name = $_POST["item_name"];
    $item_price = $_POST["item_price"];
    $item_description = $_POST["item_description"];
    $item_keyword = $_POST["item_keyword"];
    $item_category = $_POST["item_category"];
    $sizes_available = implode($_POST["size_check"]);
    $item_status = ($_POST["status_check"]);

    $size_raw = $_POST['size_check'];
    $uc_first = array_map('ucfirst', $size_raw);
    $size = implode(", ", $uc_first);

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
        || empty($item_image1) || empty($item_image2) || empty($item_image3)
    ) {
        echo "<script>alert('Please fill all the available fields!')</script>";
        // exit();
    } else {
        move_uploaded_file($temp_item_image1, "./item_images/$item_image1");
        move_uploaded_file($temp_item_image2, "./item_images/$item_image2");
        move_uploaded_file($temp_item_image3, "./item_images/$item_image3");

        //insert query
        $insert_item = "INSERT INTO `items` 
                                (item_code, item_name, item_price, sizes_available, item_description, item_keyword, item_category, item_image1, item_image2, item_image3, date_added, item_status) 
                        VALUES ('$item_code', '$item_name', '$item_price', '$size', '$item_description', '$item_keyword', '$item_category', '$item_image1', '$item_image2', '$item_image3', NOW(), '$item_status')";

        $result_query = mysqli_query($conn, $insert_item);
        if ($result_query) {
            echo "<script>alert('Item has been successfully delivered to the database!')</script>";
        } else {
            echo "<script>alert('Error! Item is not successfully delivered to the database!')</script>";
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
    <title>Insert Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="page.css">
</head>

<body>
    <div class="container shadow-lg bg-white" style="margin-top: 50px; width:100%;">
        <h1 class="text-start pt-3 pb-3">Insert Item</h1>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="main_dashboard.php?products">Products List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="main_dashboard.php?add_item">Add Item</a>
            </li>
        </ul>
    </div>

    <div class="container shadow-lg bg-white" style="margin-top: -1px; width:100%;">
        <form action="" method="post" enctype="multipart/form-data"> <!-- enctype attribute to accept images in form -->
            <div class="row">
                <div class="col-7" style=" height: 200px;">
                    <div class="btn-group">
                        <div class="form-group ps-3" style="height: 75px; width: 400px;">
                            <small id="s1" class="form-text fst-italic">Item Name<span style="color: red;">*</span></small>
                            <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Enter Item Name" autocomplete="off" required="required">
                        </div>
                        <div class="form-group ps-3" style="background-color: rgb(255, 255, 255); height: 75px;">
                            <small id="s2" class="form-text fst-italic">Item Price<span style="color: red;">*</span></small>
                            <input type="text" class="form-control" name="item_price" id="item_price" placeholder="Enter Item Price" required="required">
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
                        <textarea class="form-control" style="height: 100px;" name="item_description" id="item_description" placeholder="Enter Description" required="required"></textarea>
                    </div>
                    <div class="btn-group pt-3">
                        <!-- <div class="form-group ps-3" style="width: 200px;">
                                    <small id="s5" class="form-text fst-italic">Gender<span style="color: red;">*</span></small>
                                        <select class="form-select" name="gender_category" id="gender_category" style="" 
                                         onchange="checkGenderValue(this.value)" aria-label="Default select example" required="required">
                                            <option disabled selected>Select a Gender</option>
                                            <?php
                                            $select_query = "SELECT * FROM `categories`";
                                            $resultOfSelectQuery = mysqli_query($conn, $select_query);

                                            while ($row = mysqli_fetch_assoc($resultOfSelectQuery)) {
                                                $category_name = $row["category_name"];
                                                $category_id = $row["category_id"];

                                                echo "<option value='$category_name'>$category_name</option>";
                                            }

                                            ?>
                                        </select>
                                </div> -->
                        <div class="form-group ps-3" style="width: 300px;">
                            <small id="s5" class="form-text fst-italic">Select a Category<span style="color: red;">*</span></small>
                            <select class="form-select" name="item_category" id="item_category" style="" aria-label="Default select example" required="required">
                                <option selected hidden>Select a Category</option>
                                <?php
                                $select_query = "SELECT * FROM mens_categories";
                                $resultOfSelectQuery = mysqli_query($conn, $select_query);

                                while ($row = mysqli_fetch_assoc($resultOfSelectQuery)) {
                                    $category_name = $row["mens_category_name"];
                                    $category_id = $row["mens_category_id"];

                                    echo "<option value='$category_name'>$category_name</option>";
                                }

                                //    $select_query1 = "SELECT * FROM womens_categories";
                                //    $resultOfSelectQuery1 = mysqli_query($conn, $select_query1);

                                //    while($row = mysqli_fetch_assoc($resultOfSelectQuery1)){
                                //       $category_name1 = $row["womens_category_name"];
                                //       $category_id1 = $row["womens_category_id"];

                                //      echo "<option value='$category_name1'>$category_name1</option>";
                                //   }
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
                        <input type="text" class="form-control" name="item_keyword" id="item_keyword" placeholder="Enter Item Keyword" required="required">
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

            <button type="submit" name="addItemBtn" class="btn btn-warning" style="margin-left: 40px; width: 50%;
                margin-top: 120px; font-size: 20px;">Add Item</button>

            <br><br><br>
        </form>
    </div>

</body>

</html>
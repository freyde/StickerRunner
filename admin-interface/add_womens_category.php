<?php
include_once("../includes/dbh.inc.php");
include_once("../includes/functions.inc.php");

if(isset($_POST["addCategorybtn"])){
    $category_name = $_POST["categoryName"];

    //select the category from the database for checking
    $select_query = "SELECT * FROM `womens_categories` WHERE womens_category_name = '$category_name'";
    $resultOfSelectQuery = mysqli_query($conn, $select_query);
    $numberOfRow = mysqli_num_rows($resultOfSelectQuery);
    //conditional statement to check whether the category already exists on the database or not
    if($numberOfRow>0){
        echo "<script>alert('ERROR: Category already exists in the database')</script>";
    } else {
        //add the category to the database
        $insert_query = "INSERT INTO `womens_categories` (womens_category_name) VALUES ('Womens $category_name')";
        $result = mysqli_query($conn, $insert_query);
        if($result){
            echo "<script>alert('Category has been added to the database successfully!')</script>";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="page.css">
</head>
<body>
    <div class="container shadow-lg bg-white" style="border: 1px solid orangered; margin-top: 50px;">
        <h1 class="text-center pt-3 pb-3 bg-warning">Add Women's Category</h1>
            <form action="" method="post" style="margin-top: 20px; margin-left: 320px;">
                <div class="form-group ps-3" style="height: 75px; width: 400px;">
                    <small id="s1" class="form-text fst-italic">Category Name<span style="color: red;">*</span></small>
                    <input type="text" class="form-control" name="categoryName" id="categoryName" placeholder="Category Name" autocomplete="off" required="required">
                </div>
                    <button type="submit" name="addCategorybtn" class="btn btn-warning" style="width: 382px;
                    margin-left: 17px; font-size: 15px;">Add Category</button>
                <br><br><br>
            </form>
    </div>
</body>
</html>



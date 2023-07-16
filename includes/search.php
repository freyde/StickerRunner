<?php
require_once("dbh.inc.php");


function getSearchItems()
{
    global $conn;

    $searchString = $_GET["searchString"];
    $_SESSION['searchString'] = $searchString;
    $select_query = "SELECT * FROM `items` WHERE MATCH (item_name, item_description, item_keyword) AGAINST ('$searchString' IN NATURAL LANGUAGE MODE)"; //rand() function to randomize items display 
    $result_query = mysqli_query($conn, $select_query);
    if (mysqli_num_rows($result_query) > 0) {
        while ($row = mysqli_fetch_assoc($result_query)) {
            $item_id = $row["item_id"];
            $item_code = $row["item_code"];
            $item_name = $row["item_name"];
            $item_price = $row["item_price"];
            $item_description = $row["item_description"];
            $item_keyword = $row["item_keyword"];
            $item_category = $row["item_category"];
            $item_image1 = $row["item_image1"];

            // displaying items in the HTML index
            echo "<div class=''>
                    <a style='text-decoration: none;' href='itemclickpage.php?item_code=$item_code&item_category=$item_category&click_on_item=$item_name'>
                    <figure class='figure' style='width: 215px; '>
                        <img src='./admin-interface/item_images/$item_image1' class='figure-img img-fluid rounded m-3' style='height: 200px;' alt='$item_name'>
                        <figcaption class='item_name'>$item_name</figcaption>
                        <figcaption class='item_price'>₱$item_price.00</figcaption>
                    </figure>
                    </a>
                </div>";
        }

    } else {
        echo "<h4>No Results Found.</h4>";
    }
}

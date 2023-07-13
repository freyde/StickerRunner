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
    <title>Insert Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="page.css"> -->

    <style>
        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            height: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>




</head>

<body>
    <div class="container shadow-lg bg-white" style="margin-top: 50px; width:100%;">
        <h1 class="text-start pt-3 pb-3">Products List</h1>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="main_dashboard.php?products">Products List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="main_dashboard.php?add_item">Add Item</a>
            </li>
        </ul>
    </div>
    <div class="list-of-products">
        <?php
        $select_list = mysqli_query($conn, "SELECT * FROM items");
        ?>

        <table class="table table-bordered border-primary table-success">
            <thead class="text-center fw-bold">
                <tr>
                    <th>Item Code</th>
                    <th>Item Image</th>
                    <th>Item Name</th>
                    <th>Item Price</th>
                    <th>Sizes</th>
                    <th>Status</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <?php
            while ($row = mysqli_fetch_assoc($select_list)) {
            ?>
                <tr>
                    <td class="text-center"><?php echo $row["item_code"] ?></td>
                    <td class="text-center">
                        <img src="../admin-interface/item_images/<?= $row["item_image1"] ?>" height="50" width="50" alt="" />
                    </td>
                    <td><?php echo $row["item_name"] ?></td>
                    <td class="text-center">₱<?php echo $row["item_price"] ?>.00</td>
                    <td class="text-center"><?php echo $row["sizes_available"] ?></td>
                    <td class="text-center"><?php echo $row["item_status"] ?></td>
                    <!-- <td class="text-center"><button type="button" class="btn btn-link">Edit</button></td> -->
                    <td class="text-center"><button type="button" name="editBtn" id="editBtn" value="<?php echo $row["item_code"]; ?>" class="btn btn-success">Edit</button></td>
                    <td class="text-center"><button type="button" name="delBtn" id="delBtn" value="<?php echo $row["item_code"]; ?>" class="btn btn-danger">Delete</button></td>
                </tr>
            <?php
            };
            ?>
        </table>
    </div>

    <!-- FOR MODAL EDIT -->
    <!-- <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 class="info text-start">Edit Product Info</h3>
            <div id="modal-inside"></div>
        </div>
    </div> -->

    <script src="../jquery-3.6.3.js"></script>
    <script src="../assets/edit_products_function.js"></script>


    <script>
        // Get the modal
        var modal = document.getElementById("editModal");

        // Get the button that opens the modal
        // var btn = document.getElementById("editBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        // btn.onclick = function() {
        //   modal.style.display = "block";
        // }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>

</html>
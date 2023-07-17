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
    <!-- <link rel="stylesheet" href="page.css"> -->

    <!-- <style>
        /* The Modal (background) */
        .modal {
          display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
          z-index: 1; /* Sit on top */
          padding-top: 100px; /* Location of the box */
          left: 0;
          top: 0;
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
          background-color: #fefefe;
          margin: auto;
          padding: 20px;
          border: 1px solid #888;
          width: 70%;
          height: 90%;
        }

        /* The Close Button */
        .close {
          color: #aaaaaa;
          float: right;
          font-size: 28px;
          font-weight: bold;
          margin-left: 860px;
          margin-top: -20px;
        }

        .close:hover,
        .close:focus {
          color: #000;
          text-decoration: none;
          cursor: pointer;
        }
    </style> -->




</head>
    
<body>
    <div class="container shadow-lg bg-white" style="margin-top: 50px; width:100%;">
        <h1 class="text-start pt-3 pb-3">Users List</h1>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="main_dashboard.php?products">Users List</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="main_dashboard.php?add_item">Add Item</a>
                </li> -->
            </ul>                                
    </div>
    <div class="list-of-products">
        <?php
            $select_list = mysqli_query($conn, "SELECT * FROM users");
        ?>

        <table class="table table-bordered border-primary table-striped">
            <thead class="text-center fw-bold">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Address</th>
                    <th>Birthday</th>
                    <th>Gender</th>
                    <!-- <th colspan="2">Action</th> -->
                </tr>
            </thead>
            <?php
                while($row = mysqli_fetch_assoc($select_list)){
            ?>
                <tr>
                    <td class="text-center"><?php echo $row["user_id"] ?></td>
                    <td class="text-center"><?php echo $row["first_name"] . " ". $row["last_name"] ?></td>
                    <td class="text-center"><?php echo $row["email_add"] ?></td>
                    <td class="text-center"><?php echo $row["street_number"] . ", " . $row["barangay"] . ", " . $row["province"] ?></td>
                    <td class="text-center"><?php echo $row["birthday"] ?></td>
                    <td class="text-center"><?php echo $row["gender"] ?></td>
                    <!-- <td class="text-center"><button type="button" class="btn btn-link">Edit</button></td> -->
                    <!-- <td class="text-center"><button type="button" name="editBtn" id="editBtn" value="<?php echo $row["email_add"] ?>" class="btn btn-success">Edit</button></td> -->
                </tr>
                    
            <?php
                };
            ?>
        </table>
    </div>

                 
    
    <script src="jquery-3.6.3.js"></script>
    <script src="assets/edit_products_function.js"></script>


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
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



</head>

<body>
    <div class="container shadow-lg bg-white" style="margin-top: 50px; width:100%;">
        <h1 class="text-start pt-3 pb-3">Custom Items List</h1>
        <ul class="nav nav-tabs nav-fill">
            <li class="nav-item">
                <a class="nav-link" href="main_dashboard.php?custom">Custom Items List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="main_dashboard.php?custom_pending"><strong><u>For Pricing</u></strong></a>
            </li>
        </ul>
    </div>
    <div class="list-of-products">
        <?php
        $select_list = mysqli_query($conn, "SELECT * FROM custom_shirt WHERE custom_price IS NULL ORDER BY custom_id DESC");
        ?>

        <table class="table table-bordered table-striped border-primary table-hover">
            <thead class="text-center fw-bold">
                <tr>
                    <th>Custom No.</th>
                    <th>Customer Email</th>
                    <th>Front Image</th>
                    <th>Back Image</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th></th>
                </tr>
            </thead>
            <?php
            if (mysqli_num_rows($select_list) > 0) {
                while ($row = mysqli_fetch_assoc($select_list)) {
            ?>
                    <form action="">
                        <input hidden id="custom_id_<?= $row["custom_id"] ?>" type="text" value="<?php echo $row["custom_id"] ?>"></input>
                        <tr style="font-size: 14px;">
                            <td class="text-center"><b><?php echo $row["custom_id"] ?></b></td>
                            <td class="text-center"><?php echo $row["custom_email"] ?></td>
                            <td class="text-center">
                                <?php
                                if ($row['custom_front'] == NULL) {
                                ?>
                                    No Front
                                <?php
                                } else {
                                ?>
                                    <img src="../custom/<?= $row['custom_front'] ?>" height="50" width="70" alt="" />
                                <?php
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <?php
                                if ($row['custom_back'] == NULL) {
                                ?>
                                    No Back
                                <?php
                                } else {
                                ?>
                                    <img src="../custom/<?= $row['custom_back'] ?>" height="50" width="70" alt="" />
                                <?php
                                }
                                ?>
                            </td>
                            <td class="text-center"><?php echo $row["custom_size"] ?></td>


                            <td class="text-center">
                                <input type="number" class="form-control-sm" id="price_<?= $row["custom_id"] ?>" placeholder="Input Price" required>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary setPriceBtn" type="submit" value="<?= $row['custom_id'] ?>">Set Price</button>
                            </td>
                        </tr>
                    </form>

                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="10" class="text-center"><strong>No Item</strong></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>



    <script src="../jquery-3.6.3.js"></script>
    <script src="../assets/paid_function.js"></script>

    <script>
        $(document).ready(function() {
            $(".setPriceBtn").click(function() {
                var custom_id = this.value;
                var price = $('#price_' + custom_id).val();

                if (price != "") {
                    $.ajax({
                        method: "POST",
                        url: "setPending.php",
                        data: {
                            "custom_id": custom_id,
                            "price": price,
                        },
                        success: function(response) {
                            alert(response);
                            location.reload();
                        },
                        error: function(response) {
                            alert("Something went wrong");
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>
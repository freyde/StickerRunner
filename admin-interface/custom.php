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
                <a class="nav-link" href="main_dashboard.php?custom"><strong><u>Custom Items List</u></strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="main_dashboard.php?custom_pending">For Pricing</a>
            </li>
        </ul>
    </div>
    <div class="list-of-products">
        <?php
        $select_list = mysqli_query($conn, "SELECT * FROM custom_shirt ORDER BY custom_id DESC");
        ?>

        <table class="table table-bordered table-striped border-primary table-hover">
            <thead class="text-center fw-bold">
                <tr>
                    <th>Custom No.</th>
                    <th>Customer Email</th>
                    <th>Front Image</th>
                    <th>Back Image</th>
                    <th>Size</th>
                </tr>
            </thead>
            <?php
            if (mysqli_num_rows($select_list) > 0) {
                while ($row = mysqli_fetch_assoc($select_list)) {
            ?>
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
                                <button type="button" class="btn preview" data-bs-toggle="modal" data-bs-target="#exampleModal" value="<?= $row['custom_front'] ?>">
                                    <img src="../custom/<?= $row['custom_front'] ?>" height="50" width="70" alt="" />
                                </button>
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
                                <button type="button" class="btn preview" data-bs-toggle="modal" data-bs-target="#exampleModal" value="<?= $row['custom_back'] ?>">
                                    <img src="../custom/<?= $row['custom_back'] ?>" height="50" width="70" alt="" />
                                </button>
                            <?php
                            }
                            ?>
                        </td>
                        <td class="text-center"><?php echo $row["custom_size"] ?></td>
                    </tr>

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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Preview</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="mx-auto d-block" id="previewImg" src="" alt="preview">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>


    <script src="../jquery-3.6.3.js"></script>
    <script src="../assets/paid_function.js"></script>

    <script>
        $(document).ready(function() {
            $(".preview").click(function() {
                // alert(this.value);
                $("#previewImg").attr("src", "../custom/" + this.value);
            });
        });
    </script>

</body>

</html>
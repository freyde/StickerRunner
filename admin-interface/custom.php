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
                    <th>Final Design</th>
                    <th>Assets</th>
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
                            $files = glob("../custom/" . $row['custom_path'] . "/*");
                            echo "<button type='button' class='btn btn-sm' data-bs-toggle='modal' data-bs-target='#final" . $row['custom_id'] . "'>
                                    <img style='height: 50px; width: 70px' src='" . $files[1] . "'>
                                    </button>";
                            ?>
                        </td>
                        <td class="text-center">
                            <?php
                            $files = glob("../custom/" . $row['custom_path'] . "/assets/*");
                            echo "<button type='button' class='btn btn-sm' data-bs-toggle='modal' data-bs-target='#assets" . $row['custom_id'] . "'>
                                    <img style='height: 50px; width: 70px' src='" . $files[0] . "'>
                                    </button>";
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
    <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Preview</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="mx-auto d-block" id="previewImg" src="" alt="preview" style="width:auto">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div> -->

    <?php
    $select_list = mysqli_query($conn, "SELECT * FROM custom_shirt ORDER BY custom_id DESC");
    if (mysqli_num_rows($select_list) > 0) {
        foreach ($select_list as $item) {
            $files = glob("../custom/" . $item['custom_path'] . "/*");
            echo "<div class='modal fade' id='final" . $item['custom_id'] . "' tabindex='-1' aria-labelledby='final" . $item['custom_id'] . "' aria-hidden='true'>
                <div class='modal-dialog modal-fullscreen'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='exampleModalLabel'>Final Design Preview</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>";
                        for ($g = 1; $g < count($files); $g++)
                            echo "<img class='mx-auto d-block img-fluid preview' src='" . $files[$g] . "' alt='preview'>";
                        echo "</div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        <!-- <button type='button' class='btn btn-primary'>Save changes</button> -->
                    </div>
                    </div>
                </div>
                </div>
                ";
        }

        foreach ($select_list as $item) {
            $files = glob("../custom/" . $item['custom_path'] . "/assets/*");
            echo "<div class='modal fade' id='assets" . $item['custom_id'] . "' tabindex='-1' aria-labelledby='assets" . $item['custom_id'] . "' aria-hidden='true'>
                <div class='modal-dialog modal-fullscreen'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='exampleModalLabel'>Assets</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>";
                        for ($g = 0; $g < count($files); $g++)
                            echo "<img class='mx-auto d-block img-fluid preview' src='" . $files[$g] . "' alt='preview'>";
                        echo "</div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        <!-- <button type='button' class='btn btn-primary'>Save changes</button> -->
                    </div>
                    </div>
                </div>
                </div>
                ";
        }
    }
    ?>


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
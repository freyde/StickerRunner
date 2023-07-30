<?php
include("headerCustom.php");
include_once("includes/functions.inc.php");
include("includes/dbh.inc.php");

global $conn;
$email = $_SESSION['userEmailAdd'];
$query = "SELECT user_id FROM users WHERE email_add = '$email'";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $userID = $row['user_id'];
}

$query = "SELECT * FROM custom_shirt WHERE custom_email = '$email'";
$result = mysqli_query($conn, $query);

$customNo = mysqli_num_rows($result);
if(isset($_POST['xsQty'])) $xs = $_POST['xsQty']; else $xs = null;
if(isset($_POST['sQty'])) $s = $_POST['sQty']; else $s = null;
if(isset($_POST['mQty'])) $m = $_POST['mQty']; else $m = null;
if(isset($_POST['lQty'])) $l = $_POST['lQty']; else $l = null;
if(isset($_POST['xlQty'])) $xl = $_POST['xlQty']; else $xl = null;

$timestamp = date('YmdHis');
$path = "$userID/$timestamp";

// echo "<script>alert($timestamp)</script>";
// echo "<script>console.log($timestamp)</script>";
if (mkdir("custom/$path", 0777, true)) {
    $finalCount = count($_FILES["finalDesignUpload"]["name"]);
    for ($a = 0; $a < $finalCount; $a++) {
        $imgName = $_FILES["finalDesignUpload"]["name"][$a];
        $tmp = $_FILES["finalDesignUpload"]["tmp_name"][$a];
        // echo "<script>console.log('$finalCount')</script>";
        move_uploaded_file($tmp, "custom/$path/$imgName");
    }
} else {
    echo "<script>alert('Failed')</script>";
}

if (mkdir("custom/$path/assets", 0777, true)) {
    $finalCount = count($_FILES["assetsUpload"]["name"]);
    for ($a = 0; $a < $finalCount; $a++) {
        $imgName = $_FILES["assetsUpload"]["name"][$a];
        $tmp = $_FILES["assetsUpload"]["tmp_name"][$a];
        echo "<script>console.log('$finalCount')</script>";
        move_uploaded_file($tmp, "custom/$path/assets/$imgName");
    }
} else {
    echo "<script>alert('Failed')</script>";
}

$sizes = array("Extra Small", "Small", "Medium", "Large", "Extra Large");
$values = array($xs, $s, $m, $l, $xl);
for ($x = 0; $x < count($sizes); $x++) {
    if (!($values[$x] == NULL || $values[$x] == "")) {
        $query = "INSERT INTO custom_shirt (custom_email, custom_path, custom_size, custom_quantity)
            VALUES  ('$email', '$path', '$sizes[$x]', '$values[$x]')";
        mysqli_query($conn, $query);
    }
}
?>

<body>
    <div id="page-container">
        <div id="content-wrap">
            <!----2 Columns----->
            <div class="pt-4">
                <!----Column LEFT----->
                <?php

                if (isset($_SESSION["user_Id"])) {
                    $selectData = "SELECT * FROM users WHERE user_id ='{$_SESSION["user_Id"]}'";
                    $query = mysqli_query($conn, $selectData);
                    if (mysqli_num_rows($query)) {
                        while ($users = mysqli_fetch_array($query)) {
                            $first_name = $users["first_name"];
                            $last_name = $users["last_name"];
                        }
                ?>
                        <div class="column left" style="background-color: rgb(255, 255, 255); height: 500px; width: 85%;">
                            <div class="display shadow-lg" style="height: 500px;">
                                <div class="account_info" style="margin-left: 30px;">

                                    <h1 class="text-center">Order Successfully Placed!</h1>

                                    <p class="text-center" style="padding-top: 70px; padding-left: 100px; padding-right: 100px;">
                                        Dear <?php echo "<b>" . $first_name . " " . $last_name . "</b>" ?>,
                                        <br><br>Your customized shirt has been successfully received and will be processed in our end.
                                        <br>Please wait for the confirmation of the price of your shirt.
                                        <br>We appreciate you and hope you enjoy your new purchase.
                                        <br><br><strong>Thank you for choosing Sticker Runner!. <br><br>Your support means a lot to us.</strong>
                                </div>

                                <div class="buttons text-center pt-4">
                                    <a class="btn btn-primary" href="index.php" role="button">Go to Home</a>
                                    <a class="btn btn-primary bg-subtle" href="shoppingcartpage.php?email_add=<?= $email ?>" role="button">My Shopping Cart</a>
                                </div>
                        <?php
                    }
                }
                        ?>
                            </div>
                        </div>
                        <br>
            </div> <!---for row--->


        </div>
    </div>
    <?php
    include("footer.php");
    ?>


    <!---JAVASCRIPT----->
    <script src="jquery-3.6.3.js"></script>
    <script src="assets/checkout_function.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.sidebar .nav-link').forEach(function(element) {

                element.addEventListener('click', function(e) {

                    let nextEl = element.nextElementSibling;
                    let parentEl = element.parentElement;

                    if (nextEl) {
                        e.preventDefault();
                        let mycollapse = new bootstrap.Collapse(nextEl);

                        if (nextEl.classList.contains('show')) {
                            mycollapse.hide();
                        } else {
                            mycollapse.show();
                            // find other submenus with class=show
                            var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                            // if it exists, then close all of them
                            if (opened_submenu) {
                                new bootstrap.Collapse(opened_submenu);
                            }
                        }
                    }
                }); // addEventListener
            }) // forEach
        });
        // DOMContentLoaded  end
    </script>
</body>
<?php
include("headerCustom.php");
include_once("includes/functions.inc.php");
include("includes/dbh.inc.php");

global $conn;
$size = $_POST['customSize'];
$email = $_SESSION['userEmailAdd'];

$query = "SELECT user_id FROM users WHERE email_add = '$email'";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $userID = $row['user_id'];
}

if ($_FILES["frontUpload"]["name"] == "") {
    $backImg = $userID . "-" . $_FILES["backUpload"]["name"];

    $tmpBack = $_FILES["backUpload"]["tmp_name"];

    move_uploaded_file($tmpBack, "custom/$backImg");

    $query = "INSERT INTO custom_shirt (custom_email, custom_back, custom_size)
        VALUES  ('$email', '$backImg', '$size')";
} else if ($_FILES["backUpload"]["name"] == "") {
    $frontImg = $userID . "-" . $_FILES["frontUpload"]["name"];

    $tmpFront = $_FILES["frontUpload"]["tmp_name"];

    move_uploaded_file($tmpFront, "custom/$frontImg");

    $query = "INSERT INTO custom_shirt (custom_email, custom_front, custom_size)
        VALUES  ('$email', '$frontImg', '$size')";
} else {
    $frontImg = $userID . "-" . $_FILES["frontUpload"]["name"];
    $backImg = $userID . "-" . $_FILES["backUpload"]["name"];

    $tmpFront = $_FILES["frontUpload"]["tmp_name"];
    $tmpBack = $_FILES["backUpload"]["tmp_name"];

    move_uploaded_file($tmpFront, "custom/$frontImg");
    move_uploaded_file($tmpBack, "custom/$backImg");

    $query = "INSERT INTO custom_shirt (custom_email, custom_front, custom_back, custom_size)
        VALUES  ('$email', '$frontImg', '$backImg', '$size')";
}
mysqli_query($conn, $query);

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
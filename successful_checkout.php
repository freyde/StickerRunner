<?php
include("header.php");
include_once("includes/functions.inc.php");
//require("includes/checkout.inc.php");
?>

<body>
  <div id="page-container">
    <div id="content-wrap">
      <!-- <div class="pt-4"> -->
        <!----Column LEFT----->
        <?php
        if (isset($_SESSION["user_Id"])) {
          $selectData = "SELECT * FROM users WHERE user_id ='{$_SESSION["user_Id"]}'";
          $query = mysqli_query($conn, $selectData);
          if (mysqli_num_rows($query)) {
            while ($users = mysqli_fetch_array($query)) {
              $first_name = $users["first_name"];
              $last_name = $users["last_name"];
              $email_address = $users["email_add"];
              $account_address = $users["street_number"] . ", Barangay " . $users["barangay"] . ", " . $users["citymunicipality"] . ", " . $users["province"];
              $mobile_number = $users["mobile_number"];
              $birthday = $users["birthday"];
            }
            $select_from_orders = "SELECT * FROM `orders` WHERE order_email_add = '$email_address'";
            $select_query = mysqli_query($conn, $select_from_orders);
            while ($row = mysqli_fetch_assoc($select_query)) {
              $package_unique_num = $row["package_num"];
            }
        ?>
            <div class="row">
              <div class="col-md-12 mx-auto" style="background-color: rgb(255, 255, 255); height: 500px; width: 85%;">
                <div class="display shadow-lg" style="height: 500px;">
                  <div class="account_info" style="margin-left: 30px;">
                    <h1 class="text-center">Order Successfully Placed!</h1>
                    <p class="text-center" style="padding-top: 70px; padding-left: 100px; padding-right: 100px;">Dear <?php echo "<b>" . $first_name . " " . $last_name . "</b>" ?>, Your order which has a package number of (<?php echo "<b>" . $package_unique_num . "</b>" ?>) has been successfully received and processed by our
                      system. We appreciate you and hope you enjoy your new purchase. Thank you for choosing Sticker Runner!. Your support means a lot to us.</p>
                    <!-- <h6 style='margin-top: 20px; color: black;'>Name: <?php echo $first_name . " " . $last_name ?></h6>
                                    <h6 style="color: black">Address: <?php echo $account_address ?></h6>
                                    <h6 style="color: black">Contact Number: <?php echo $mobile_number ?></h6>
                                    <h6 style="color: black ">Email-Address: <?php echo $email_address ?></h6> -->
                  </div>
                  <div class="buttons text-center pt-4">
                    <a class="btn btn-primary" href="index.php" role="button">Go to Home</a>
                    <a class="btn btn-primary" href="my_orders.php" role="button">My Orders</a>
                  </div>
              <?php
                        }
                      }
              ?>
                </div>
              </div>
            </div>
            <br>
      <!-- </div> -->
    </div>
    <?php
    include("footer.php");
    ?>
  </div>
    


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

</html>
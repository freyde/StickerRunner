<?php
include("header.php");
include_once("includes/functions.inc.php");
?>

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


<body>
  <div id="page-container">
    <div id="content-wrap">
      <!----2 Columns----->
      <div class="container">
        <div class="row pt-4">
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
          ?>
                <div class="column left" style="background-color: rgb(255, 255, 255); height: 500px; width: 52%;">
                  <div class="display shadow-lg">
                    <h3 class="fw-light pt-2 ps-3 fs-2 pb-2 bg-primary text-start">Billing Information</h3>
                    <div class="account_info" style="margin-left: 30px;">
                      <h6 style='margin-top: 20px; color: black;'>Name: <?php echo $first_name . " " . $last_name ?></h6>
                      <h6 style="color: black">Address: <?php echo $account_address ?></h6>
                      <h6 style="color: black">Contact Number: <?php echo $mobile_number ?></h6>
                      <h6 style="color: black">Email-Address: <?php echo $email_address ?></h6>
                      <?php
                      $check_code = $_GET["item_code"];
                      $new = explode(",", $check_code);
                      ?>
                    </div>
              <?php
              }
            }
          }
              ?>
              <!-- <form action="includes/checkout.inc.php" method="POST"> -->
              <h3 class="fw-light pt-2 ps-3 fs-2 pb-2 bg-primary text-start">Items</h3>
              <div class="container">
                <?php
                $c_items = get_checkout_Items();
                $_SESSION['checkout'] = false;
                // echo "<script>alert(".$_SESSION['checkout'].")</script>";
                $totalItems = 0;
                foreach ($c_items as $check_Items) {
                  if (isset($_GET['checkout'])) {
                    $_SESSION['checkout'] = true;
                ?>
                    <div class="row">
                      <div class="col-md-12">
                        <div class='card check_item_data shadow-lg mb-1 bg-white rounded' style='height: 130px; background-color: #F0F0F0;'>
                          <div class='btn-group mb-2'>
                            <div class='form-check' style='width: 400px;'>
                              <input type="hidden" class="checkEmail" value='<?= $check_Items['check_email'] ?>'>
                              <input type="hidden" class="checkName" value='<?= $check_Items['check_name'] ?>'>
                              <input type="hidden" class="checkSize" value='<?= $check_Items['check_size'] ?>'>
                              <input type="hidden" class="checkImage" value='<?= $check_Items['check_image'] ?>'>
                              <img class='ms-3 mt-3' style='height: 100px; width: 100px; float: left;' src='admin-interface/item_images/<?= $check_Items['check_image'] ?>' alt=''>
                              <h6 class='fw-bold text-dark pt-3 ps-5' style='margin-left: 80px;'><?= $check_Items['check_name'] ?></h6>
                              <h6 class='fw-bold ps-5' style='margin-left: 80px; color: orangered;'>₱<?= $check_Items['check_price'] ?>.00</h6>
                              <input type="hidden" class="checkPrice" value='<?= $check_Items['check_price'] ?>'>
                              <h6 class='fw-light text-dark ps-5' style='margin-left: 80px; color: orangered;'>Size: <?= $check_Items['check_size'] ?></h6>
                            </div>
                            <div class='wrapper' style='height: 30px; width: 120px; margin-top: 50px; margin-left: 20px;
                                        text-align: center; justify-content: center; display: flex;'>
                              <input type="checkbox" name="code_checkboxes" class="checkCode" checked="checked" value='<?= $check_Items['check_id'] ?>' style="opacity: 0;">
                              <input type="checkbox" name="" class="checkQuantity" value='<?= $check_Items['check_quantity'] ?>' style="opacity: 0;">
                              <?php
                              $totalItems += $check_Items['check_quantity'];
                              echo "
                                                      <p>Quantity: </p>
                                                      <p>{$check_Items['check_quantity']}<p>";
                              ?>
                            </div>
                            <div class='remove'>
                              <button class="btn btn-danger deleteItem_btn" value='<?= $check_Items['check_code'] ?>' style="margin-top: 44px; height: 40px; width: 40px; margin-left: 60px;">
                                <img src='icons8-delete-trash-32.png' style='margin-left: -8px; height: 30px; width: 30px; margin-top: -2px;' alt=''>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php
                  } else if (isset($_GET['custom'])) {
                    $_SESSION['custom'] = true;
                  ?>
                    <div class="row">
                      <div class="col-md-12">
                        <div class='card check_item_data shadow-lg mb-1 bg-white rounded' style='height: 130px; background-color: #F0F0F0;'>
                          <div class='btn-group mb-2'>
                            <div class='form-check' style='width: 400px;'>
                              <input type="hidden" class="checkEmail" value='<?= $check_Items['custom_email'] ?>'>
                              <input type="hidden" class="checkName" value='<?= $check_Items['custom_id'] ?>'>
                              <input type="hidden" class="checkSize" value='<?= $check_Items['custom_size'] ?>'>
                              <input type="hidden" class="checkImage" value='<?= $check_Items['custom_front'] ?>'>
                              <img class='ms-3 mt-3' style='height: 100px; width: 150px; float: left;' src='custom/<?= $check_Items['custom_front'] ?>' alt=''>
                              <h6 class='fw-bold text-dark pt-3 ps-5' style='margin-left: 80px;'><?= $check_Items['custom_id'] ?></h6>
                              <h6 class='fw-bold ps-5' style='margin-left: 80px; color: orangered;'>₱<?= $check_Items['custom_price'] ?>.00</h6>
                              <input type="hidden" class="checkPrice" value='<?= $check_Items['custom_price'] ?>'>
                              <h6 class='fw-light text-dark ps-5' style='margin-left: 80px; color: orangered;'>Size: <?= $check_Items['custom_size'] ?></h6>
                            </div>
                            <div class='wrapper' style='height: 30px; width: 120px; margin-top: 50px; margin-left: 20px;
                                      text-align: center; justify-content: center; display: flex;'>
                              <input type="checkbox" name="code_checkboxes" class="checkCode" checked="checked" value='<?= $check_Items['custom_id'] ?>' style="opacity: 0;">
                              <!-- <input type="checkbox" name="" class="checkQuantity" value='' style="opacity: 0;"> -->
                              <?php
                              $totalItems += 1;
                              // echo "
                              //                       <p>Quantity: </p>
                              //                       <p>{$check_Items['check_quantity']}<p>";
                              ?>
                            </div>
                            <div class='remove'>
                              <button class="btn btn-danger deleteItem_btn" value='<?= $check_Items['check_code'] ?>' style="margin-top: 44px; height: 40px; width: 40px; margin-left: 60px;">
                                <img src='icons8-delete-trash-32.png' style='margin-left: -8px; height: 30px; width: 30px; margin-top: -2px;' alt=''>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php
                  } else {
                  ?>
                    <div class="row">
                      <div class="col-md-12">
                        <div class='card check_item_data shadow-lg mb-1 bg-white rounded' style='height: 130px; background-color: #F0F0F0;'>
                          <div class='btn-group mb-2'>
                            <div class='form-check' style='width: 400px;'>
                              <input type="hidden" class="checkEmail" value='<?= $check_Items['email_add'] ?>'>
                              <input type="hidden" class="checkName" value='<?= $check_Items['item_name'] ?>'>
                              <input type="hidden" class="checkSize" value='<?= $check_Items['item_size'] ?>'>
                              <input type="hidden" class="checkImage" value='<?= $check_Items['item_image'] ?>'>
                              <img class='ms-3 mt-3' style='height: 100px; width: 100px; float: left;' src='admin-interface/item_images/<?= $check_Items['item_image'] ?>' alt=''>
                              <h6 class='fw-bold text-dark pt-3 ps-5' style='margin-left: 80px;'><?= $check_Items['item_name'] ?></h6>
                              <h6 class='fw-bold ps-5' style='margin-left: 80px; color: orangered;'>₱<?= $check_Items['item_price'] ?>.00</h6>
                              <input type="hidden" class="checkPrice" value='<?= $check_Items['item_price'] ?>'>
                              <h6 class='fw-light text-dark ps-5' style='margin-left: 80px; color: orangered;'>Size: <?= $check_Items['size'] ?></h6>
                            </div>
                            <div class='wrapper' style='height: 30px; width: 120px; margin-top: 50px; margin-left: 20px;
                                        text-align: center; justify-content: center; display: flex;'>
                              <input type="checkbox" name="code_checkboxes" class="checkCode" checked="checked" value='<?= $check_Items['item_id'] ?>' style="opacity: 0;">
                              <input type="checkbox" name="" class="checkQuantity" value='<?= $check_Items['quantity'] ?>' style="opacity: 0;">
                              <?php
                              $totalItems += $check_Items['quantity'];
                              echo "
                                                      <p>Quantity: </p>
                                                      <p>{$check_Items['quantity']}<p>";
                              ?>
                            </div>
                            <div class='remove'>
                              <button class="btn btn-danger deleteItem_btn" value='<?= $check_Items['check_code'] ?>' style="margin-top: 44px; height: 40px; width: 40px; margin-left: 60px;">
                                <img src='icons8-delete-trash-32.png' style='margin-left: -8px; height: 30px; width: 30px; margin-top: -2px;' alt=''>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php
                  }
                }
                ?>
                <hr>
              </div>
                  </div>
                </div>
                <br>
                <!-- form -->
                <!----Column RIGHT----->
                <?php
                $items = get_checkout_Items();
                //  $sql = "SELECT  SUM(cost) from food";
                if (isset($_SESSION["userEmailAdd"])) {
                  $selectData = "SELECT * FROM users WHERE email_add ='{$_SESSION["userEmailAdd"]}'";
                  $query = mysqli_query($conn, $selectData);
                  if (mysqli_num_rows($query)) {
                    while ($users = mysqli_fetch_array($query)) {
                      $email_add = $users["email_add"];
                    }
                  }
                  $check_code = $_GET["item_code"];
                  $new = explode(",", $check_code);
                  //$code[] = $_SESSION['check_code'];
                  $totalPriceWithSF = "SELECT SUM(item_price * quantity) FROM `cart_table` WHERE item_id IN (" . implode(',', $new) . ")";
                  $resultTotalPricewithSF = $conn->query($totalPriceWithSF);
                  if (isset($_GET['checkout']))
                    $subtotal = "SELECT SUM(check_price * check_quantity) FROM checkout_items WHERE check_code IN (" . implode(',', $new) . ")";
                  else if (isset($_GET['custom']))
                    $subtotal = "SELECT SUM(custom_price) FROM custom_shirt WHERE custom_id IN (" . implode(',', $new) . ")";
                  else
                    $subtotal = "SELECT SUM(item_price * quantity) FROM cart_table WHERE item_id IN (" . implode(',', $new) . ")";
                  $resultSubtotal = mysqli_query($conn, $subtotal);
                ?>
                  <div class="column right" style="background-color: rgb(255, 255, 255); height: 500px;
              width: 30%;">
                    <!-- <form action="includes/checkout.inc.php" method="POST"> -->
                    <div class="orderSummaryBox shadow-lg mb-3 bg-white rounded" style="height: 400px;">
                      <h2 class="fw-light pt-2 fs-2 pb-2 bg-primary text-center">Order Summary
                      </h2>
                      <h6 class="text-dark fw-bold pt-2 text-center">Payment Method</h6>
                      <div class="paymentOpt-button-group text-center">
                        <input type="checkbox" name="payment_chk" id="GCashBtn" value="GCash" class="payment_chk btn btn-primary">GCash
                        <input type="checkbox" name="payment_chk" id="CoDBtn" value="CoD" class="payment_chk btn btn-primary ms-3">CoD
                        <!-- <button type="button" class="btn btn-primary">Cash on Delivery</button>          -->
                      </div>
                      <div class="mt-3 ml-2 mr-2">
                        <input id="inputGcashRef" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Gcash Reference Number">
                      </div>
                      <hr>
                      <div class="row pt-2 ps-4">
                        <table style="width: 100%;">
                          <tr>
                            <td style="padding-left: 15px;">
                              <h6 class="text-dark">Subtotal (<?= $totalItems ?> item(s)):</h6>
                            </td>
                            <td class="text-end" style="padding-right: 40px;">₱<?php
                                                                                if (isset($_GET['checkout'])) {
                                                                                  while ($row = mysqli_fetch_array($resultSubtotal)) {
                                                                                    $totalPrice = $row['SUM(check_price * check_quantity)'];
                                                                                    echo $totalPrice;
                                                                                  }
                                                                                } else if (isset($_GET['custom'])) {
                                                                                  while ($row = mysqli_fetch_array($resultSubtotal)) {
                                                                                    $totalPrice = $row['SUM(custom_price)'];
                                                                                    echo $totalPrice;
                                                                                  }
                                                                                } else {
                                                                                  while ($row = mysqli_fetch_array($resultSubtotal)) {
                                                                                    $totalPrice = $row['SUM(item_price * quantity)'];
                                                                                    echo $totalPrice;
                                                                                  }
                                                                                }
                                                                                ?>.00</td>
                          </tr>
                          <tr>
                            <td style="padding-left: 15px;">
                              <h6 class="text-dark">Shipping Fee:</h6>
                            </td>
                            <td class="text-end" style="padding-right: 15px; padding-right: 40px;">₱45.00</td>
                          </tr>
                          <tr>
                            <td style="padding-left: 15px;">
                              <h6 class="text-dark pt-4 fs-5">Total Amount:</h6>
                            </td>
                            <td class="text-end fs-5 pt-2" style="padding-right: 15px; padding-right: 40px;">₱<?php
                                                                                                              if (!isset($_GET['checkout'])) {
                                                                                                                echo $totalPrice + 45;
                                                                                                                while ($row = mysqli_fetch_array($resultSubtotal)) {
                                                                                                                  echo $row['SUM(item_price * quantity)'];
                                                                                                                }
                                                                                                              } else if (isset($_GET['custom'])) {
                                                                                                                echo $totalPrice + 45;
                                                                                                                while ($row = mysqli_fetch_array($resultSubtotal)) {
                                                                                                                  $totalPrice = $row['SUM(custom_price)'];
                                                                                                                  echo $totalPrice;
                                                                                                                }
                                                                                                              } else {
                                                                                                                echo $totalPrice + 45;
                                                                                                                while ($row = mysqli_fetch_array($resultSubtotal)) {
                                                                                                                  echo $row['SUM(check_price * check_quantity)'];
                                                                                                                }
                                                                                                              }
                                                                                                              ?>.00</td>
                          </tr>
                        </table>
                      </div>
                      <div class="d-grid col-11 gap-4 ps-4 pt-4">
                        <!-- id="placeOrder" -->
                        <button name="placeOrderBtn" id="placeOrderBtn" class="btn btn-primary">Place Order Now</button>
                      <?php
                    }
                      ?>
                      </div>
                    </div>
                    <?php
                    ?>
                  </div> <!---for right column--->
                  <!-- FOR MODAL GCASH -->
                  <div id="myModal" class="modal">
                    <div class="modal-content">
                      <span class="close">&times;</span>
                      <p class="text-center">Please refer to the QR Code below to pay amount of order.</p>
                      <img src="GCash_QR_Code.jpg" style="height: 240px; margin-left: 220px; border: 1px solid gray;" alt="">
                      <p class="text-center fw-bold" style="margin-top: 5px;">Raymond P. - 09508120671</p>
                      <p class="text-center" style="margin-top: -10px;">Note: Must pay exact amount within 24 hours from the time of order.</p>
                    </div>
                  </div>
        </div>
      </div>
      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      <!---for row--->
      <!-- </form> -->
      <!----Footer Section----->
    
    </div>
    <?php
    include("footer.php");
    ?>
  </div>


  <!---JAVASCRIPT----->
  <script src="jquery-3.6.3.js"></script>
  <script src="assets/checkout_function.js"></script>

  <script>
    $('input.payment_chk').on('change', function() {
      $('input.payment_chk').not(this).prop('checked', false);
    });
  </script>

  <script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var gcashbtn = document.getElementById("GCashBtn");
    var codbtn = document.getElementById("CoDBtn");
    var gcashinpt = document.getElementById("inputGcashRef");
    gcashinpt.style.display = "none";

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    gcashbtn.onclick = function() {
      gcashinpt.style.display = "block";
      modal.style.display = "block";
    }

    codbtn.onclick = function() {
      gcashinpt.style.display = "none";
    }

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

  <!-- <script>
    // When the user scrolls the page, execute myFunction
    window.onscroll = function() {
      myFunction()
    };

    // Get the header
    var header = document.getElementById("myHeader");

    // Get the offset position of the navbar
    var sticky = header.offsetTop;

    // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
      if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
      } else {
        header.classList.remove("sticky");
      }
    }
  </script> -->
</body>

</html>
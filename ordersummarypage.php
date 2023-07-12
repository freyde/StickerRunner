<?php
include("header.php");
include_once("includes/functions.inc.php");
?>

<style>
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
    <div class="content">
        
      <!----2 Columns----->
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
                        <div class="display shadow-lg" style="height: 500px;">
                          <h3 class="fw-light pt-2 ps-3 fs-2 pb-2 bg-warning text-start">Billing Information</h3>
                            <div class="account_info" style="margin-left: 30px; id">
                                <h6 style='margin-top: 20px; color: black;'>Name: <?php echo $first_name. " " .$last_name ?></h6>
                                <h6 style="color: black">Address: <?php echo $account_address?></h6>
                                <h6 style="color: black">Contact Number: <?php echo $mobile_number?></h6>
                                <h6 style="color: black">Email-Address: <?php echo $email_address?></h6>
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

        
         
         <h3 class="fw-light pt-2 ps-3 fs-2 pb-2 bg-warning text-start">Items</h3>
              <?php 
              $c_items = get_checkout_Items();

                foreach ($c_items as $check_Items){
                ?>
                    <div class='card check_item_data shadow-lg mb-1 bg-white rounded' style='height: 130px; background-color: #F0F0F0;'>
                      
                        <div class='btn-group mb-2'>
                          <div class='form-check' style='width: 400px;'>
                              <input type="hidden" class="checkEmail" value='<?= $check_Items['email_add'] ?>'>
                              <input type="hidden" class="checkName" value='<?= $check_Items['item_name'] ?>'>
                              <input type="hidden" class="checkSize" value='<?= $check_Items['item_size'] ?>'>
                              <input type="hidden" class="checkImage" value='<?= $check_Items['item_image'] ?>'>
                              <img class='ms-3 mt-3' style='height: 100px; width: 100px; float: left;' src='./admin-interface/item_images/<?= $check_Items['item_image'] ?>' alt=''>
                              <h6 class='fw-bold text-dark pt-3 ps-5' style='margin-left: 80px;'><?= $check_Items['item_name'] ?></h6>
                              <h6 class='fw-bold ps-5' style='margin-left: 80px; color: orangered;'>₱<?= $check_Items['item_price'] ?>.00</h6>
                              <input type="hidden" class="checkPrice" value='<?= $check_Items['item_price'] ?>'>
                              <h6 class='fw-light text-dark ps-5' style='margin-left: 80px; color: orangered;'>Size: <?= $check_Items['size'] ?></h6>
                          </div>
                            
                          <div class='wrapper' style='height: 30px; width: 120px; margin-top: 50px; margin-left: 20px;
                          text-align: center; justify-content: center; display: flex;'>
                                <input type="checkbox" name="code_checkboxes" class="checkCode" checked="checked" value='<?= $check_Items['item_code'] ?>' style="opacity: 0;">
                                <input type="checkbox" name="" class="checkQuantity" value='<?= $check_Items['quantity'] ?>' style="opacity: 0;">
                               <?php 
                                  echo "
                                        <p>Quantity: </p>
                                        <p>{$check_Items['quantity']}<p>";
                               ?>
                          </div>

                          <div class='remove'>
                                <button class="btn btn-warning deleteItem_btn" value='<?= $check_Items['check_code'] ?>' style="margin-top: 44px; height: 40px; width: 40px; margin-left: 60px;">
                                <img src='icons8-delete-trash-32.png' style='margin-left: -8px; height: 30px; width: 30px; margin-top: -2px;' alt=''>
                                </button>
                          </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                  
                                              
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
          $subtotal = "SELECT SUM(item_price * quantity) FROM cart_table WHERE item_id IN (" . implode(',', $new) . ")"; 
          //$ = $conn->query($subtotal);
          $resultSubtotal = mysqli_query($conn, $subtotal);

          ?>

          <div class="column right" style="background-color: rgb(255, 255, 255); height: 500px;
          width: 30%;">
          <!-- <form action="includes/checkout.inc.php" method="POST"> -->
          <div class="orderSummaryBox shadow-lg mb-3 bg-white rounded" style="height: 400px;">
            <h2 class="fw-light pt-2 fs-2 pb-2 bg-warning text-center">Order Summary
            </h2>
            <h6 class="text-dark fw-bold pt-2 text-center">Payment Method</h6>
                <div class="paymentOpt-button-group text-center">
                  <input type="checkbox" name="payment_chk" id="GCashBtn" value="GCash" class="payment_chk btn btn-primary">GCash
                  <input type="checkbox" name="payment_chk" id="CoDBtn" value="CoD" class="payment_chk btn btn-primary ms-3">CoD

                  <!-- <button type="button" id="GCashBtn" value="GCash" class="btn btn-primary">GCash</button>
                  <button type="button" class="btn btn-primary">Cash on Delivery</button>          -->
                </div>
            <hr>
            <div class="row pt-2 ps-4">
            <table style="width: 100%;">
              <tr>
                <td style="padding-left: 15px;"><h6 class="text-dark">Subtotal (2 items):</h6></td>
                <td class="text-end" style="padding-right: 40px;">₱<?php

                        //display data on web page
                  while($row = mysqli_fetch_array($resultSubtotal)){
                    echo $row['SUM(item_price * quantity)' ];
                }
                
                
                ?>.00</td>
              </tr> 
              <tr>
                <td style="padding-left: 15px;"><h6 class="text-dark">Shipping Fee:</h6></td>
                <td class="text-end" style="padding-right: 15px; padding-right: 40px;">₱45.00</td>
              </tr>
              <tr>
                <td style="padding-left: 15px;"><h6 class="text-dark pt-4 fs-5">Total Amount:</h6> </td>
                <td class="text-end fs-5 pt-2" style="padding-right: 15px; padding-right: 40px;">₱<?php

                        //display data on web page
                  while($row = mysqli_fetch_array($resultTotalPricewithSF)){
                    echo $row['SUM(item_price * quantity)'] + 45;
                }
                
                ?>.00</td>
              </tr>
            </table>
            </div>
            

            <div class="d-grid col-11 gap-4 ps-4 pt-4">
            <!-- id="placeOrder" -->
                            <button name="placeOrderBtn" id="placeOrderBtn" class="btn btn-warning">Place Order Now</button>
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



        </div> <!---for row--->
      <!-- </form> -->
        

      <!----Footer Section----->
      <div class="footer">
        <div class="footer_row">
            <div class="footer_column">
                <h4 style="color: white;">About Sticker Runner</h1>
                    <h6>About Us</h6>
                    <h6>Privacy Policy</h6>
                    <h6>Terms of Use</h6>
                    <h6>Contact Us</h6>
            </div>
            <div class="footer_column">
                <h4 style="color: white;">Info</h1>
                    <h6>My Account</h6>
                    <h6>My Cart</h6>
                    <h6>Order Status</h6>
            </div>
            <div class="footer_column">
                <h4 style="color: white;">Help and FAQs</h1>
                    <h6>Online Ordering</h6>
                    <h6>Shipping</h6>
                    <h6>Billing</h6>
                    <h6>Return Item</h6>
            </div>
            <div class="footer_column">
                <h4 style="color: white;">Sticker Runner</h1>
            </div>
          </div>

          <hr style="color: white; background-color: white; height: 2px; width: 85%; margin-left: 100px;">

          <h6 style="margin-top: 130px; text-align: center;">(C) 2022 Sticker Runner. All Rights Reserved</h6>
      </div>
</div>
    

    <!---JAVASCRIPT----->
    <script src="jquery-3.6.3.js"></script>
    <script src="./assets/checkout_function.js"></script>

    <script>
        $('input.payment_chk').on('change', function() {
            $('input.payment_chk').not(this).prop('checked', false);  
        });
    </script>

    <script>
            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the button that opens the modal
            var btn = document.getElementById("GCashBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal 
            btn.onclick = function() {
              modal.style.display = "block";
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
        document.addEventListener("DOMContentLoaded", function(){
        document.querySelectorAll('.sidebar .nav-link').forEach(function(element){
    
        element.addEventListener('click', function (e) {

        let nextEl = element.nextElementSibling;
        let parentEl  = element.parentElement;	

        if(nextEl) {
            e.preventDefault();	
            let mycollapse = new bootstrap.Collapse(nextEl);
            
            if(nextEl.classList.contains('show')){
              mycollapse.hide();
            } else {
                mycollapse.show();
                // find other submenus with class=show
                var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                // if it exists, then close all of them
                if(opened_submenu){
                  new bootstrap.Collapse(opened_submenu);
                        }
                    }
                }
            }); // addEventListener
          }) // forEach
        }); 
        // DOMContentLoaded  end
    </script>

    <script>
        // When the user scrolls the page, execute myFunction
    window.onscroll = function() {myFunction()};

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
    </script>
</body>
</html>
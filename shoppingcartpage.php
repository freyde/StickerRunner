<?php
include("header.php");
include_once("includes/functions.inc.php");
?>

<body>
  <div id="page-container">
    <div id="content-wrap">
      <div class="p-5 bg-white rounded shadow mb-5">
        <ul id="myTab2" role="tablist" class="nav nav-tabs nav-pills with-arrow lined flex-column flex-sm-row text-center">
          <li class="nav-item flex-sm-fill">
            <a id="custom-tab" data-bs-toggle="tab" href="#custom" role="tab" aria-controls="custom" aria-selected="true" class="nav-link text-uppercase font-weight-bold mr-sm-3 rounded-0 active">
              <h5>Ready-Made Item Cart</h5>
            </a>
          </li>
          <li class="nav-item flex-sm-fill">
            <a id="order-tab" data-bs-toggle="tab" href="#order" role="tab" aria-controls="order" aria-selected="false" class="nav-link text-uppercase font-weight-bold mr-sm-3 rounded-0">
              <h5>Custom Shirt Cart</h5>
            </a>
          </li>
        </ul>
        <div id="myTabContent" class="tab-content">
          <div id="custom" role="tabpanel" aria-labelledby="custom-tab" class="tab-pane fade px-4 py-5 show active">
            <div class="row">
              <?php
              $items = get_Cart_from_DB();
              if (mysqli_num_rows($items) > 0) {
              ?>
                <div class="column left" style="width: 58%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                  <div class='itemBought shadow-lg mb-1 bg-white rounded' style='height: 40px; background-color: #F0F0F0;'>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" value="" id="checkAll" style="margin-top: 11px;">
                      <label class="form-check-label" for="flexCheckDefault" style="margin-top: 8px;">
                        Select All
                      </label>
                    </div>
                  </div>
                  <div id="shopping_cart">
                    <?php
                    $items = get_Cart_from_DB();
                    foreach ($items as $cart_Items) {
                    ?>
                      <div class='card item_data shadow-lg mb-1 bg-white rounded' style='height: 130px; background-color: #F0F0F0;'>
                        <div class='btn-group mb-2'>
                          <div class='form-check' style='width: 400px;'>
                            <input type="hidden" class="email" value='<?= $cart_Items['email_add'] ?>'>
                            <input class="form-check-input item_checkbox" type="checkbox" value="<?= $cart_Items['item_id'] ?>" name="item_checkbox" style="margin-top: 50px;">
                            <input type="hidden" class="itemImage" value='<?= $cart_Items['item_image'] ?>'>
                            <img class='ms-3 mt-3 thumbnail2' style='height: 100px; width: 100px; float: left;' src='admin-interface/item_images/<?= $cart_Items['item_image'] ?>' alt=''>
                            <input type="hidden" class="itemName" value='<?= $cart_Items['item_name'] ?>'>
                            <h6 class='fw-bold text-dark pt-3 ps-5' style='margin-left: 80px;'><?= $cart_Items['item_name'] ?></h6>
                            <input type="hidden" class="itemPrice" value='<?= $cart_Items['item_price'] ?>'>
                            <h6 class='fw-bold ps-5' style='margin-left: 80px; color: orangered;'>₱<?= $cart_Items['item_price'] ?>.00</h6>
                            <input type="hidden" class="itemSize" value='<?= $cart_Items['size'] ?>'>
                            <h6 class='fw-light text-dark ps-5' style='margin-left: 80px; color: orangered;'>Size: <?= $cart_Items['size'] ?></h6>
                          </div>
                          <div class='wrapper' style='border: 1px solid #C0C0C0; height: 30px; width: 120px; margin-top: 50px; margin-left: 120px;text-align: center; justify-content: center; display: flex;'>
                            <input type="hidden" class="itemCode" value='<?= $cart_Items['item_code'] ?>'>
                            <button class='input-group-text decrement-btn updateQty_btn'>-</button>
                            <input type='text' class='form-control text-center bg-white input-qty' value='<?= $cart_Items['quantity'] ?>' disabled>
                            <button class='input-group-text increment-btn updateQty_btn'>+</button>
                          </div>
                          <div class='remove'>
                            <button class="btn btn-danger deleteItem_btn" value='<?= $cart_Items['item_code'] ?>' style="margin-top: 44px; height: 40px; width: 40px; margin-left: 50px;">
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
                <div class="column right" style="background-color: white; width: 25%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); height: 350px;">
                  <h2 class="fw-light pt-2 fs-2 pb-2 bg-primary text-center text-white">Order Summary</h2>
                  <table style="width: 100%; margin-top: 30px;">
                    <tr>
                      <td style="padding-left: 15px;">
                        <h6 class="text-dark">Subtotal (<span class="text-dark" id="num_items">0</span> items):</h6>
                      </td>
                      <td class="text-end" style="padding-right: 35px;" id="display_subtotal">₱0.00</td>
                    </tr>
                    <tr>
                      <td style="padding-left: 15px;">
                        <h6 class="text-dark">Shipping Fee: </h6>
                      </td>
                      <td class="text-end" style="padding-right: 35px;" id="display_shipping_fee">₱45.00</td>
                    </tr>
                    <tr>
                      <td style="padding-left: 15px;">
                        <h6 class="text-dark pt-4 fs-5">Total Amount:</h6>
                      </td>
                      <td class="text-end" style="padding-right: 35px;" id="display_total_amount">₱0.00</td>
                    </tr>
                  </table>
                  <div class="d-grid col-11 gap-4 ps-4 pt-5">
                    <?php
                    if (isset($_SESSION["userEmailAdd"])) {
                      $selectData = "SELECT * FROM users WHERE email_add ='{$_SESSION["userEmailAdd"]}'";
                      $query = mysqli_query($conn, $selectData);
                      if (mysqli_num_rows($query)) {
                        while ($users = mysqli_fetch_array($query)) {
                          $email_add = $users["email_add"];
                    ?>
                          <button type="button" id="checkout_btn" class="btn btn-primary" style="width: 100%;">Place Order</button>
                    <?php
                        }
                      }
                    }
                    ?>
                  </div>
                </div>
              <?php
              } else {
              ?>
                <h3>Your cart is empty.</h3>
              <?php
              }
              ?>
            </div> <!---for row--->
          </div>
          <!-- -----------------------------------------------Custom Cart ----------------------------------------------------------------- -->
          <div id="order" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade px-4 py-5">
            <div class="row">
              <?php
              $customItems = getCustomCart();
              if (mysqli_num_rows($customItems) > 0) {
              ?>
                <div class="column left" style="width: 58%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                  <div class='itemBought shadow-lg mb-1 bg-white rounded' style='height: 40px; background-color: #F0F0F0;'>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" value="" id="customAll" style="margin-top: 11px;">
                      <label class="form-check-label" for="flexCheckDefault" style="margin-top: 8px;">
                        Select All
                      </label>
                    </div>
                  </div>
                  <div id="shopping_cart">
                    <?php
                    foreach ($customItems as $item) {
                      if ($item['custom_price'] == "") {
                    ?>
                        <div class='card item_data shadow-lg mb-1 bg-secondary rounded' style='height: 130px; background-color: #F0F0F0;'>
                        <?php
                      } else {
                        ?>
                          <div class='card item_data shadow-lg mb-1 bg-white rounded' style='height: 130px; background-color: #F0F0F0;'>
                          <?php
                        }
                          ?>
                          <div class='btn-group mb-2'>
                            <div class='form-check' style='width: 400px;'>
                              <?php
                              if ($item['custom_price'] == "") {
                              ?>
                                <input disabled class="form-check-input custom_checkbox" type="checkbox" value="<?= $item['custom_id'] ?>" name="custom_checkbox" style="margin-top: 50px;">
                              <?php
                              } else {
                              ?>
                                <input class="form-check-input custom_checkbox" type="checkbox" value="<?= $item['custom_id'] ?>" name="custom_checkbox" style="margin-top: 50px;">
                              <?php
                              }
                              ?>
                              <input type="hidden" class="email" value='<?= $item['custom_email'] ?>'>
                              <input type="hidden" class="itemImage" value='<?= $item['custom_front'] ?>'>
                              <img class='ms-3 mt-3 thumbnail2' style='height: 100px; width: 130px; float: left;' src='custom/<?= $item['custom_front'] ?>' alt=''>
                              <input type="hidden" class="itemName" value='<?= $item['custom_id'] ?>'>
                              <h6 class='fw-bold text-dark pt-3 ps-5' style='margin-left: 80px;'>Custom <?= $item['custom_id'] ?></h6>
                              <input type="hidden" class="itemPrice" value='<?= $item['custom_price'] ?>'>
                              <?php
                              if ($item['custom_price'] != NULL) {
                              ?>
                                <h6 class='fw-bold ps-5' style='margin-left: 80px; color: orangered;'>₱<?= $item['custom_price'] ?>.00</h6>
                              <?php
                              } else {
                              ?>
                                <h6 class='fw-bold ps-5' style='margin-left: 80px; color: orangered;'>No price yet</h6>
                              <?php
                              }
                              ?>
                              <input type="hidden" class="itemSize" value='<?= $item['custom_size'] ?>'>
                              <h6 class='fw-light text-dark ps-5' style='margin-left: 80px; color: orangered;'>Size: <?= $item['custom_size'] ?></h6>
                            </div>
                            <div class='wrapper' style='height: 30px; width: 120px; margin-top: 50px; margin-left: 120px;text-align: center; justify-content: center; display: flex;'>
                              <input type="hidden" class="itemCode" value='<?= $item['custom_id'] ?>'>
                              <button class='input-group-text decrement-btn updateCustQty_btn'>-</button>
                              <input type='text' class='form-control text-center bg-white input-qty' value='<?= $item['custom_quantity'] ?>' disabled>
                              <button class='input-group-text increment-btn updateCustQty_btn'>+</button>
                            </div>
                            <div class='remove float-end'>
                              <button class="btn btn-danger deleteCust_btn" value='<?= $item['custom_id'] ?>' style="margin-top: 44px; height: 40px; width: 40px; margin-left: 50px;">
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
                  <div class="column right" style="background-color: white; width: 25%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); height: 350px;">
                    <h2 class="fw-light pt-2 fs-2 pb-2 bg-primary text-center text-white">Order Summary</h2>
                    <table style="width: 100%; margin-top: 30px;">
                      <tr>
                        <td style="padding-left: 15px;">
                          <h6 class="text-dark">Subtotal (<span class="text-dark" id="custom_num_items">0</span> items):</h6>
                        </td>
                        <td class="text-end" style="padding-right: 35px;" id="custom_subtotal">₱0.00</td>
                      </tr>
                      <tr>
                        <td style="padding-left: 15px;">
                          <h6 class="text-dark">Shipping Fee: </h6>
                        </td>
                        <td class="text-end" style="padding-right: 35px;" id="display_shipping_fee">₱45.00</td>
                      </tr>
                      <tr>
                        <td style="padding-left: 15px;">
                          <h6 class="text-dark pt-4 fs-5">Total Amount:</h6>
                        </td>
                        <td class="text-end" style="padding-right: 35px;" id="custom_total_amount">₱0.00</td>
                      </tr>
                    </table>
                    <div class="d-grid col-11 gap-4 ps-4 pt-5">
                      <?php
                      if (isset($_SESSION["userEmailAdd"])) {
                        $selectData = "SELECT * FROM users WHERE email_add ='{$_SESSION["userEmailAdd"]}'";
                        $query = mysqli_query($conn, $selectData);
                        if (mysqli_num_rows($query)) {
                          while ($users = mysqli_fetch_array($query)) {
                            $email_add = $users["email_add"];
                      ?>
                            <button type="button" id="custom_checkout_btn" class="btn btn-primary" style="width: 100%;">Place Order</button>
                      <?php
                          }
                        }
                      }
                      ?>
                    </div>
                  </div>
                <?php
              } else {
                ?>
                  <h3>Your cart is empty.</h3>
                <?php
              }
                ?>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    include("footer.php");
    ?>
  </div>
  <script src="jquery-3.6.3.js"></script>
  <script src="assets/quantityFunction.js"></script>



</body>
<?php
include("header.php");
include_once("includes/functions.inc.php");
?>

<body>
  <div class="content">
    <div class="row pt-4">
      <div class="column left" style="width: 58%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

        <div class='itemBought shadow-lg mb-1 bg-white rounded' style='height: 40px; background-color: #F0F0F0;'>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" value="" id="checkAll" style="margin-top: 11px;">
            <label class="form-check-label" for="flexCheckDefault" style="margin-top: 8px;">
              Select All
            </label>
          </div>
          <div class="form-check form-check-inline">
            <button class="btn btn-danger deleteAll_btn" style="width: 130px; margin-left: 455px; height: 35px;">
              <img src="icons8-delete-trash-32.png" style="margin-top: -3px; height: 25px; width: 25px;" id="deleteAll">
              Delete
            </button>
          </div>
        </div>

        <div id="shopping_cart">
          <?php $items = get_Cart_from_DB();

          foreach ($items as $cart_Items) {
          ?>
            <div class='card item_data shadow-lg mb-1 bg-white rounded' style='height: 130px; background-color: #F0F0F0;'>

              <div class='btn-group mb-2'>
                <div class='form-check' style='width: 400px;'>
                  <input type="hidden" class="email" value='<?= $cart_Items['email_add'] ?>'>
                  <input class="form-check-input" type="checkbox" value="<?= $cart_Items['item_id'] ?>" name="item_checkbox" style="margin-top: 50px;">
                  <input type="hidden" class="itemImage" value='<?= $cart_Items['item_image'] ?>'>
                  <img class='ms-3 mt-3' style='height: 100px; width: 100px; float: left;' src='admin-interface/item_images/<?= $cart_Items['item_image'] ?>' alt=''>
                  <input type="hidden" class="itemName" value='<?= $cart_Items['item_name'] ?>'>
                  <h6 class='fw-bold text-dark pt-3 ps-5' style='margin-left: 80px;'><?= $cart_Items['item_name'] ?></h6>
                  <input type="hidden" class="itemPrice" value='<?= $cart_Items['item_price'] ?>'>
                  <h6 class='fw-bold ps-5' style='margin-left: 80px; color: orangered;'>₱<?= $cart_Items['item_price'] ?>.00</h6>
                  <input type="hidden" class="itemSize" value='<?= $cart_Items['size'] ?>'>
                  <h6 class='fw-light text-dark ps-5' style='margin-left: 80px; color: orangered;'>Size: <?= $cart_Items['size'] ?></h6>
                </div>

                <div class='wrapper' style='border: 1px solid #C0C0C0; height: 30px; width: 120px; margin-top: 50px; margin-left: 120px;
                      text-align: center; justify-content: center; display: flex;'>
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

      </div><!---for left column--->
      <div class="column right" style="background-color: white; width: 25%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),
       0 6px 20px 0 rgba(0, 0, 0, 0.19); height: 350px;">
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


      </div> <!---for right column--->
    </div> <!---for row--->
  </div>
  <script src="jquery-3.6.3.js"></script>
  <script src="assets/quantityFunction.js"></script>

  <script>
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
  </script>

  <script>
    /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
    function clickAccDropdown() {
      document.getElementById("myAccDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.accdropbtn')) {
        var dropdowns = document.getElementsByClassName("accdropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
  </script>


</body>

</html>
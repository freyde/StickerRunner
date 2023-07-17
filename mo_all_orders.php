<?php

    if(isset($_SESSION['auth'])){
        include_once("header.php");
        include_once("includes/functions.inc.php");
        ?>

<body>
    <div class="content">
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
                          $email_address = $users["email_add"];
                          $account_address = $users["street_number"] . ", Barangay " . $users["barangay"] . ", " . $users["citymunicipality"] . ", " . $users["province"]; 
                          $mobile_number = $users["mobile_number"];
                          $birthday = $users["birthday"];
                      }

                      $select_from_orders = "SELECT * FROM `orders` WHERE order_email_add = '$email_address'";
                      $select_query = mysqli_query($conn, $select_from_orders);

                      while($row = mysqli_fetch_assoc($select_query)){
                         $package_unique_num = $row["package_num"];
                      }

                      ?>
                                    <table class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Package#</th>
                                                <th>Item</th>
                                                <th>Price</th>
                                                <th>Size</th>
                                                <th>Quantity</th>
                                                <th>Total Price</th>
                                                <th>Date Ordered</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $myorders = getMyOrders();

                                            if(mysqli_num_rows($myorders) > 0){
                                                foreach($myorders as $item){
                                                ?>
                                                    <tr>
                                                        <td> <?= $item["package_num"] ?></td>
                                                        <td> <?= $item["order_item_name"] ?></td>
                                                        <td class="text-center"> <?= $item["order_item_price"] ?></td>
                                                        <td class="text-center"> <?= $item["order_item_size"] ?></td>
                                                        <td class="text-center"> <?= $item["order_item_quantity"] ?></td>
                                                        <td class="text-center"> <?= $item["order_total_price"] ?></td>
                                                        <td class="text-center"> <?= $item["order_date"] ?></td>
                                                        <td class="text-center"> <?= $item["order_status"] ?></td>
                                                        <?php 
                                                            if($item["order_status"] == "To Ship" || $item["order_status"] == "Placed"){
                                                                ?>
                                                                <td class="text-center">
                                                                    <input type="hidden" class="package_num" value='<?= $item['package_num'] ?>'>
                                                                    <button type="button" value='<?= $item['package_num'] ?>' name="cancel_orderBtn" id="cancel_orderBtn" class="btn btn-danger">Cancel Order</button>
                                                                </td>
                                                                <?php
                                                            } else if($item["order_status"] == "In-Transit"){
                                                                ?>
                                                                    <td class="text-center">
                                                                        <input type="hidden" class="package_num" value='<?= $item['package_num'] ?>'>
                                                                        <button type="button" value='<?= $item['package_num'] ?>' name="receiveBtn" id="receiveBtn" class="btn btn-success">Received</button>
                                                                    </td>
                                                                <?php
                                                            } 
                                                        ?>
                                                        
                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                    <tr>
                                                        <td colspan="5">No Orders Yet</td>
                                                    </tr>
                                                <?php
                                            }
                                        ?>
                                        </tbody>   
                                    </table>
                                    
                          
                      <?php
                      
                    }
              }

          ?>                            
            </div>                      
          </div>
          <br>
        </div> <!---for row--->

      <!----Footer Section----->
    

    <!---JAVASCRIPT----->
    <script src="jquery-3.6.3.js"></script>
    <script src="assets/cancel_order_function.js"></script>
    <script src="assets/received_function.js"></script>
    <!-- <script src="assets/checkout_function.js"></script> -->

     
    <!-- <script language="JavaScript">
      window.onbeforeunload = confirmExit;
      function confirmExit()
      {
        var choice;
        return "You have attempted to leave this page.  If you have made any changes to the fields without clicking the Save button, your changes will be lost.  Are you sure you want to exit this page?";
        if(choice == "Reload"){
          alert("HAHA");
        }
      }
    </script> -->

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

        <?php
    } else {
        header("Location: ../loginpage.php?login_required");
    }
?>


</body>
</html>

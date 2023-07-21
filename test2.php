<?php
include("header.php");
?>
<body>
    <div class="content">
      <!----2 Columns----->
      <div class="row pt-4">
          <!----Column LEFT----->
          <div class="column left" style="background-color: rgb(255, 255, 255); height: 500px; width: 50%;">
            <?php
                display_UserInformation()
            ?>
          </div>
          <br>
  
          <!----Column RIGHT----->
          <div class="column right" style="background-color: rgb(255, 255, 255); height: 500px;
          width: 30%;">
          <div class="orderSummaryBox shadow-lg mb-3 bg-white rounded" style="height: 400px;">
            <h2 class="fw-light pt-2 fs-2 pb-2 bg-warning text-center">Order Summary</h2>
            <h6 class="text-dark fw-bold pt-2 text-center">Payment Method</h6>
                <div class="paymentOpt-button-group" style="padding-left: 78px;">
                  <button type="button" class="btn btn-primary">GCash</button>
                  <button type="button" class="btn btn-primary">Cash on Delivery</button>         
                </div>
            <hr>
            <div class="row pt-2 ps-4">
              <div class="col-sm-5 pt-2" style="height: 100px;">
                  <h6 class="text-dark">Subtotal (2 items):</h6>  
                  <h6 class="text-dark">Quantity:</h6> 
                  <h6 class="text-dark">Shipping Fee:</h6>
                  <h6 class="text-dark pt-4 fs-5">Total Amount:</h6>                   
              </div> 
              <?php
                get_TotalAmount();
              ?>
            </div>

            <div class="d-grid col-11 gap-4 ps-4 pt-4">
              <button type="button" class="btn btn-warning">Place Order</button>
            </div>
           
            
          </div>

          </div> <!---for right column--->
        </div> <!---for row--->
        


</div>
    

    <!---JAVASCRIPT----->
    
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
       integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
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
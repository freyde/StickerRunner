<?php
include_once("header.php");
?>
<body>

    </div>
    <div class="content">
      
          <!----Column LEFT----->
          
          <!----Column RIGHT----->
            
           <!---for right column--->
           <!----2 Columns----->
                    <?php
                    viewNameandPrice();
                    ?>    
                        <form action='?' method='post'>
                        <h4 class='fw-light ps-4 pt-3 fs-5'>Size</h4>
                            <div class='btn-group ps-4' id='sizeButtons' role='group' aria-label='Basic example'>
                                <input type='radio' class='btn-check' name='radio' value='Small' id='smallBtn' autocomplete='off'>
                                <label class='btn btn-outline-dark' for='smallBtn'>Small</label>
                                <input type='radio' class='btn-check' name='radio' value='Medium' id='mediumBtn' autocomplete='off'>
                                <label class='btn btn-outline-dark' for='mediumBtn'>Medium</label>
                                <input type='radio' class='btn-check' name='radio' value='Large' id='largeBtn' autocomplete='off'>
                                <label class='btn btn-outline-dark' for='largeBtn'>Large</label>
                                <input type='radio' class='btn-check' name='radio' value='Extra Large' id='extralargeBtn' autocomplete='off'>
                                <label class='btn btn-outline-dark' for='extralargeBtn'>Extra Large</label>
                            </div>
                          <h4 class='fw-light ps-4 pt-3 fs-5'>Quantity</h4>
                            <select class='form-select ms-4' style='width: 100px;' name='quantitySelect' id='quantitySelect'>
                              <option value='1' >1</option>
                              <option value='2'>2</option>
                              <option value='3'>3</option>
                              <option value='4'>4</option>
                              <option value='5'>5</option>
                              <option value='6'>6</option>
                              <option value='7'>7</option>
                              <option value='8'>8</option>
                              <option value='9'>9</option>
                              <option value='10'>10</option>
                              <option value='11'>11</option>
                              <option value='12'>12</option>
                              <option value='13'>13</option>
                              <option value='14'>14</option>
                              <option value='15'>15</option>
                              <option value='16'>16</option>
                              <option value='17'>17</option>
                              <option value='18'>18</option>
                              <option value='19'>19</option>
                              <option value='20'>20</option>
                            </select>
                          <br><br>
                          <div class='btn-group ps-4 btn-group-lg' role='group' aria-label='Basic example'>
                              <input type='submit' name='addToCartBtn' value="Add To Cart" class='btn btn-warning me-1'></input>
                              <input type='submit' name='buyNowBtn' value="Buy Now" class='btn btn-warning me-1'></input>
                          </div>    
                      </form> 

                      <?php
                        if(isset($_POST["Add To Cart"])){
                          echo "ATC";
                        } else if(isset($_POST["buyNowBtn"]))
                      ?>
        </div> <!---for row--->
        
        <div class="suggestions" style="margin-left: 100px;" >
          <h4>Suggestions</h4>
          <?php
          get_Suggestion();
          ?>
        </div>
    </div>
    
      <!----Footer Section----->
      <div class="footer">
        <div class="footer_row">
            <div class="footer_column">
                <h4 style="color: white;">About TopBuds</h1>
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
                <h4 style="color: white;">TopBuds Clothing</h1>
            </div>
          </div>

          <hr style="color: white; background-color: white; height: 2px; width: 85%; margin-left: 100px;">

          <h6 style="margin-top: 130px; text-align: center;">(C) 2022 Topbuds Clothing. All Rights Reserved</h6>
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
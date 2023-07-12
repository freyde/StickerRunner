<?php
include("header.php");
?>

<body>
    <div class="content">
        
    <!----2 Columns----->
    <div class="row" style="height: 2000px;">
        <div class="column left">

        </div>
        <!----Column right----->
        <div class="column right" style="background-color: white;">
        
            <table>
                <tr>
                    <th>
                        <br><br>
                        <h1 class="h3">All Products</h1>
                    </th>
                    <!----Page Number Buttons----->
                    <th style="padding-left: 400px;">
                        <div class="nav_buttons">
                            <br><br>
                            <button type="btn">1</button>
                            <button type="btn">2</button>
                            <button type="btn">3</button>
                            <button type="btn">4</button>
                        </div>
                    </th>
                </tr>   
            </table>
        <br><br><br>
        <!----Sort By Dropdown Menu----->
        <h3 class="h6" style="text-align: left;"></h3>
      

          <!----ITEMS LIST----->
          <!----fetching products from items table in the database ---->
        <?php 
            displayAllItems();
            get_items_from_Category($conn);
            checkSearch();
        ?>

        </div> <!---for right column--->
      </div> <!---for row--->
    </div>

    <!-- <div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
    Harvey
  </button>
  <ul class="dropdown-menu dropdown-menu-lg-end">
    <li><button class="dropdown-item" type="button">Action</button></li>
    <li><button class="dropdown-item" type="button">Another action</button></li>
    <li><button class="dropdown-item" type="button">Something else here</button></li>
  </ul>
</div> -->


      <!----Footer Section----->
      <div class="footer">
        <div class="footer_row">
            <div class="footer_column">
                <h4 style="color: white;">About Sticker Runners</h1>
                    <h6><a href="aboutus.php">About Us</a></h6>
                    <h6><a href="">Privacy Policy</a></h6>
                    <h6><a href="">Terms of Use</a></h6>
                    <h6><a href="">Contact Us</a></h6>
            </div>
            <div class="footer_column">
                <h4 style="color: white;">Info</h1>
                    <h6><a href="">My Account</a></h6>
                    <h6><a href="">My Cart</a></h6>
                    <h6><a href="">Order Status</a></h6>
            </div>
            <div class="footer_column">
                <h4 style="color: white;">Help and FAQs</h1>
                    <h6><a href="">Online Ordering</a></h6>
                    <h6><a href="">Shipping</a></h6>
                    <h6><a href="">Billing</a></h6>
                    <h6><a href="">Return Item</a></h6>
            </div>
            <div class="footer_column">
                <h4 style="color: white;">Sticker Runners</h1>
            </div>
          </div>

          <hr style="color: white; background-color: white; height: 2px; width: 85%; margin-left: 100px;">
          <h6 style="margin-top: 130px; text-align: center;">(C) 2022 Sticker Runners. All Rights Reserved</h6>
      </div>
    

    <!---JAVASCRIPT----->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="jquery-3.6.3.js"></script>

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

        <script>
        /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
        function clickDropdown() {
          document.getElementById("myDropdown").classList.toggle("show");
        }
        
        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
          if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
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
<?php
include("header.php");
?>

<body>
    <div class="content">
        <!----Banner----->
    <div class="banner">
        <div id="carousel-slider">
            <div>
                <img style="width:100%; height: 400px;" class="d-block w-100" src="bannertopbds.jpg" alt="First slide">
            </div>
            <div>
                <img style="width:100%; height: 400px;" class="d-block w-100" src="bannertopbds.jpg" alt="Second slide">
            </div>
            <div>
                <img style="width:100%; height: 400px;" class="d-block w-100" src="bannertopbds.jpg" alt="Third slide">
            </div>
        </div>
    </div>
    <!----2 Columns----->
    <div class="row" style="height: 200px;">
        <div class="best-selling" style="margin-left: 100px;">
            <h1 style="margin-top: 40px;">Best-Selling Items</h1>
                <div class="margin-left:100px;">
                <?php 
                    displayBestSellingItems();
                ?>
                </div>
                
        </div>
    
        <hr>

        <div class="column left">

            
        </div>
        <br>
        <!----Column right----->
        <div class="column right" style="background-color: white;">
 
            <table>
                <tr>
                    <th>
                        <br><br>
                        <h1 class="h3">Items</h1>
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
        <!----Sort By Dropdown Menu----->
        <h3 class="h6" style="text-align: left;"></h3>
        <!-- <div class="dropdown">
            <button onclick="clickDropdown()" class="dropbtn dropdown-toggle" style="text-align: left;" 
            data-toggle="dropdown">Sort By</button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="#">Date Added</a>
                    <a href="#">Best Selling</a>
                    <a href="#">Brands</a>
                </div>
        </div> -->

          <!----ITEMS LIST----->
          <!----fetching products from items table in the database ---->
        <?php 
            displayAllItems();
            get_items_from_Category($conn);
            
        ?>
        </div> <!---for right column--->
      </div> <!---for row--->
    </div>

    <br><br><br><br><br>
    <br><br><br><br><br>
    <br><br><br><br><br>
    <br><br><br><br><br>
    <br><br><br><br><br>
    <br><br><br><br><br>
    <br><br><br><br><br>
    <br><br><br><br><br>
    

      <!----Footer Section----->
      <div class="footer">
        <div class="footer_row">
            <div class="footer_column">
                <h4 style="color: white;">About TopBuds</h1>
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
    <script src="jquery-3.6.3.js"></script>
    <!-- Calling jQuery -->
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<!-- Calling Slick Library -->
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
      //Initialize your slider in your script file
        $("#carousel-slider").slick({
            arrows: false,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1500,
            mobileFirst: true
        });
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
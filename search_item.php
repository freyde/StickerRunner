<?php
include("header.php");
?>

<body>
    <div class="content">
        
    <!----2 Columns----->
    <div class="row" style="height: 2000px;">
        <div class="column left">

            <!----Sidebar Menu----->
          
            <nav class="sidebar card py-2 mb-4">
            <ul class="nav flex-column" id="nav_accordion">
                <li class="nav-item has-submenu">
                    <a class="nav-link" href="#">Men's Clothing</a>
                    <ul class="submenu collapse">
                        <?php
                            $select_categories = "SELECT * FROM `mens_categories`";
                            $result_categories = mysqli_query($conn, $select_categories);
                            
                            while($row_data = mysqli_fetch_assoc($result_categories)){
                            $category_name = $row_data["mens_category_name"];
                            $category_id = $row_data["mens_category_id"];

                            echo "<li style='border: none;'><a class='nav -link' href='homepage.php?mens_category=$category_name'>$category_name</a></li>";
                            }
                            
                        ?>
                    </ul>   
                </li>
                <li class="nav-item has-submenu">
                    <a class="nav-link" href="#">Women's Clothing</a>
                    <ul class="submenu collapse">
                        <?php
                            $select_categories = "SELECT * FROM `womens_categories`";
                            $result_categories = mysqli_query($conn, $select_categories);
                            
                            while($row_data = mysqli_fetch_assoc($result_categories)){
                            $category_name = $row_data["womens_category_name"];
                            $category_id = $row_data["womens_category_id"];

                            echo "<li style='border: none;'><a class='nav -link' href='homepage.php?womens_category=$category_name'>$category_name</a></li>";
                            }
                        ?>
                    </ul>
                </li>
            </ul>
            </nav>

        </div>
        <br>
        <!----Column right----->
        <div class="column right" style="background-color: white;">
<!-- 
        <div class="search-result" style="margin-left: 100px;">
            <h1 style="margin-top: 40px;">Search Results</h1>
                <div class="margin-left:100px;">
                    <?php 
                        checkSearch();
                    ?>
                </div>  
        </div> -->
        
            <table>
                <tr>
                    <th>
                        <br><br>
                        <!-- <h1 class="h3">Search Results</h1> -->
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
        <br>
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
            checkSearch();
        ?>

        </div> <!---for right column--->
      </div> <!---for row--->
    </div>


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


        

    
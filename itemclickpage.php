<?php
include("header.php");
?>

<body>

  <div class="content container">

    <!----Column LEFT----->

    <!----Column RIGHT----->

    <!---for right column--->
    <?php
    viewItemInformation();
    ?>

  </div> <!---for row--->
  <div class="suggestions" style="margin-left: 100px;">
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
      
     
    </div>

    <hr style="color: white; background-color: white; height: 2px; width: 85%; margin-left: 100px;">

    <h6 style="margin-top: 130px; text-align: center;">(C) 2022 Sticker Runner. All Rights Reserved</h6>
  </div>


  <!---JAVASCRIPT----->
  <script src="jquery-3.6.3.js"></script>
  <script src="./assets/quantityFunction.js"></script>
  <script>
    
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
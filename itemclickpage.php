<?php
include("header.php");
?>

<body>

  <div id="page-container">
    <div id="content-wrap">
        <!----Column LEFT----->
        <!----Column RIGHT----->
        <!---for right column--->
        <?php
        viewItemInformation();
        ?>

      <div class="suggestions" style="margin-left: 100px;">
        <h4>Suggestions</h4>
        <?php
        get_Suggestion();
        ?>
      </div>
    </div>
    <?php
    include("footer.php");
    ?>
  </div>





  <!---JAVASCRIPT----->
  <script src="jquery-3.6.3.js"></script>
  <script src="assets/quantityFunction.js"></script>
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
<?php
include("header.php");
?>

<body>

  <div id="page-container">
    <div id="content-wrap">
      <div class="row">
        <div class="col-12">
          <?php
          viewItemInformation();
          ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="suggestions" style="margin-left: 100px;">
        <h4>Suggestions</h4>
        <?php
        get_Suggestion();
        ?>
      </div>
    </div>
  </div>
  <?php
  include("footer.php");
  ?>
  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Size Chart</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img class="mx-auto d-block img-fluid preview" id="previewImg" src="images/size-chart.png" alt="preview">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
      </div>
    </div>
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
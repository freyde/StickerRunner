<?php
    include("header.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="page.css">


    <style>
        .bg-image {
        /* The image used */
        background-image: url("photographer.jpg");
        
        /* Add the blur effect */
        filter: blur(3px);
        -webkit-filter: blur(3px);
        
        /* Full height */
        height: 100%; 
        
        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        }

        /* Position text in the middle of the page/image */
        /*  */
    </style>

</head>
<body>
     <!----Promo Banner----->
    
    <!----Header----->
    
    <div class="content">
        <div class="bg-image">
            <img src="admin-interface/item_images/aboutus_banner.jpg" style="width: 100%; height: 300px;" alt="">
        </div>

        <div class="about">
            <h1 class="text-center pt-5">About Us</h1>
            <p class="text-center w-75 pt-5" style="padding-left: 350px; background-color: rgb(255, 255, 255);">
            Given that the Covid-19 brought negative impact to people, society, economy and particularly in most businesses, this led to the different business-specific problems surfacing and affecting the client and their business. The most recognizably problem is the lack of customers. An imminent outcome brought by the negative impact of Covid-19 to the people and the society.  
            </p>
        </div>
<br><br><br>
      <!----2 Columns----->
      <div class="row pt-4 text-center">
          <!----Column LEFT----->
          <div class="column left border-2 border-end" style="height: 300px; 
          width: 28%;">
          <h1 style="background-color: orange;">We Care</h1>
          <br>
          <p>At TopBuds, we deeply value our customers and strive to provide them with the best experience possible.
             Their satisfaction is our top priority, and we are committed to building long-lasting relationships based
              on trust and mutual respect.</p> 
          </div>
          
          <div class="column center border-2 border-end" style=" height: 300px; 
          width: 28%;">
          <h1 style="background-color: orange;">We Value</h1>
          <br>
          <p>We appreciate the trust our customers place in us and constantly work towards exceeding their expectations.
             Their feedback and input are invaluable to us as we continue to improve our products and services.
              We are grateful for their continued support, and we remain dedicated to serving them with integrity, excellence, and care.</p>
        </p>
          </div>
  
          <!----Column RIGHT----->
          <div class="column right" style=" height: 500px;
          width: 28%;">
          <h1 style="background-color: orange;">We Offer</h1>
          <br>
          <p>Our team of skilled professionals is dedicated to delivering high-quality solutions that are tailored to our
             customers' specific requirements. We strive to provide prompt and reliable service, maintaining clear
              communication every step of the way.</p>
          </div> <!---for right column--->
        </div> <!---for row--->

        
        <div class="row pt-4 pb-5 text-center" style="background-color: orange;">
            <div class="column left" style="width: 40%; height: 400px;">
                <img src="admin-interface/item_images/location.jpg" style="width:450px; height: 400px;" alt="">
            </div>
            <div class="column left" style="width: 40%; height: 400px;">
                <h3 style="margin-top: 100px; margin-left: -100px;">We offer our services to all of the areas within CAVITE.</h3>
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
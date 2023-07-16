<?php
include_once("header.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="page.css">

</head>

<body>
    <div class="content">
        <div class="about">
            <h1 class="text-center pt-5" style="margin: 0 5% 0 5%">Sticker Runners Privacy Policy</h1>
            <p class="font-italic text-sm-center pt-5" style="margin: 0 5% 0 5%; background-color: rgb(255, 255, 255);">
                At Sticker Runners, we value your privacy and are committed to protecting your personal information.
                This Privacy Policy outlines how we collect, use, disclose, and safeguard your personal data when you visit
                our website or interact with our services. Please read this policy carefully to understand our practices and
                how your personal information will be treated.
            </p>
        </div>
        <!----2 Columns----->

        <div class="row pt-4">
            <h3 class="text-left pt-5" style="margin-left: 5%;">Information We Collect: </h3>
            <!----Column LEFT----->
            <div class="text-center column left border-2 border-end" style="height: 190px; 
          width: 30%;">
                <br>
                <p>A. Personal Information: We may collect various types of personal information from you, such as your name,
                    email address, phone number, shipping address, billing information, and other relevant details necessary
                    providing our products and services.</p>
            </div>


            <div class="text-center column center border-2 border-end" style=" height: 190px; 
          width: 30%;">

                <br>
                <p>B. Usage Information: When you visit our website, we may automatically collect certain information about
                    device, browsing actions, and patterns. This information may include your IP address, browser type,
                    eferring/exit pages, operating system, date/time stamps, and clickstream data.</p>
                </p>
            </div>

            <!----Column RIGHT----->
            <div class="text-center column right" style=" height: 190px;
          width: 30%;">

                <br>
                <p>C. Cookies and Similar Technologies: We use cookies and similar tracking technologies to enhance your
                    experience on our website and improve our services. These technologies allow us to remember your
                    preferences, understand how you use our website, and tailor content and advertisements to suit your
                    interests.</p>
            </div> <!---for right column--->
        </div> <!---for row--->
        <br><br><br>

        <!-- INFORMATION -->
        <div class="row pt-4">
            <h3 class="text-left pt-5" style="margin-left: 5%;">How We Use Your Information: </h3>
            <!----Column LEFT----->
            <div class="text-center column left border-2 border-end" style="height: 190px; 
          width: 45%;">
                <br>
                <p>A. Personal Information: We may collect various types of personal information from you, such as your name,
                    email address, phone number, shipping address, billing information, and other relevant details necessary
                    providing our products and services.</p>
            </div>

            <!----Column RIGHT----->
            <div class="text-center column right" style=" height: 190px;
          width: 45%;">

                <br>
                <p>B. Cookies and Similar Technologies: We use cookies and similar tracking technologies to enhance your
                    experience on our website and improve our services. These technologies allow us to remember your
                    preferences, understand how you use our website, and tailor content and advertisements to suit your
                    interests.</p>
            </div> <!---for right column--->
        </div> <!---for row--->
        <div class="row pt-4">
            <!----Column LEFT----->
            <div class="text-center column left border-2 border-end" style="height: 190px; 
          width: 45%;">
                <br>
                <p>C. Personal Information: We may collect various types of personal information from you, such as your name,
                    email address, phone number, shipping address, billing information, and other relevant details necessary
                    providing our products and services.</p>
            </div>

            <!----Column RIGHT----->
            <div class="text-center column right" style=" height: 190px;
          width: 45%;">

                <br>
                <p>D. Cookies and Similar Technologies: We use cookies and similar tracking technologies to enhance your
                    experience on our website and improve our services. These technologies allow us to remember your
                    preferences, understand how you use our website, and tailor content and advertisements to suit your
                    interests.</p>
            </div> <!---for right column--->
        </div> <!---for row--->
            





        <!----Footer Section----->
        <div class="footer">
            <div class="footer_row">
                <div class="footer_column">
                    <h4 style="color: white;">About Sticker Runners</h1>
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

            <h6 style="margin-top: 130px; text-align: center;">(C) 2022 Sticker Runners. All Rights Reserved</h6>
        </div>


        <!-- JAVASCRIPT -->

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
</body>

</html>
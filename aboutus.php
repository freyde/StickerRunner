<?php
include("headerAbout.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="page.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>



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

    <div id="page-container">
        <div id="content-wrap">
            <div class="bg-image">
                <img src="images/bannersticker.jpg" style="width: 100%; height: 300px;" alt="">
            </div>
            <div class="about">
                <h1 class="text-center pt-5">About Us</h1>
                <p class="text-center w-75 pt-5" style="padding-left: 350px; background-color: rgb(255, 255, 255);">
                    At Sticker Runners, we believe that fashion is a powerful means of self-expression. Our passion for style
                    and our commitment to quality has driven us to curate a stunning collection of clothing that caters to diverse
                    tastes and occasions. Whether you're looking for casual everyday wear, elegant formal attire, or trendy statement
                    pieces, we've got you covered.
                </p>
            </div>
            <br><br><br>
            <!----2 Columns----->
            <div class="row pt-4 text-center ">
                <!----Column LEFT----->
                <div class="column left border-2 border-end" style="height: 300px;
              width: 28%;">
                    <h1 style="background-color: blue; color:white">We Care</h1>
                    <br>
                    <p>We care about the environment and strive to make sustainable choices.
                        We actively seek out brands that prioritize eco-friendly materials, ethical production processes,
                        and fair trade practices. By supporting us, you're joining us in our commitment to creating a more
                        sustainable future for fashion.</p>
                </div>
                <div class="column center border-2 border-end" style=" height: 300px;
              width: 28%;">
                    <h1 style="background-color:blue; color:white">We Value</h1>
                    <br>
                    <p>We value your shopping experience and want to make it as enjoyable and convenient as possible. Our user-friendly website and
                        intuitive navigation make browsing and finding your perfect pieces a breeze. And if you ever need assistance, our friendly and
                        knowledgeable customer service team is just a message or call away. We're here to answer your questions, offer styling advice,
                        and ensure your shopping journey with us is nothing short of delightful.</p>
                    </p>
                </div>
                <!----Column RIGHT----->
                <div class="column right" style=" height: 500px;
              width: 28%;">
                    <h1 style="background-color: blue; color: white ">We Offer</h1>
                    <br>
                    <p>Our team of fashion
                        experts keeps a keen eye on the latest trends, attending fashion shows, and conducting extensive research to ensure that our
                        collection reflects the latest styles. You can trust us to provide you with the freshest and most up-to-date fashion choices.</p>
                </div> <!---for right column--->
            </div> <!---for row--->
            <hr>
            <div class="row pt-4 pb-5 text-center">
                <div class="column left" style="width: 40%; height: 400px;">
                    <img src="admin-interface/item_images/location.jpg" style="width:450px; height: 400px;" alt="">
                </div>
                <div class="column left" style="width: 40%; height: 400px;">
                    <h3 style="margin-top: 100px; margin-left: -100px;">We offer our services to all of the areas within CAVITE.</h3>
                </div>
            </div>
            <div class="row pt-4 text-center">
                <h2>Here's the location of our shop</h2>
            </div>
            <div class="row pt-1 pb-5 text-center">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3865.5938382161485!2d120.85709956981219!3d14.335009404368403!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33962b41258a8063%3A0xae86bc500b51ca5b!2sStickerRunners!5e0!3m2!1sen!2sph!4v1689521788784!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            
        </div>
        <?php
        include("footer.php");
        ?>
    </div>


    <!---JAVASCRIPT----->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
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




</body>

</html>
<?php
include_once("header.php");
?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <style>
        body {
            background-color: #F0F0F0;
        }

        .column {
            float: left;
            height: 200px;
            /* Should be removed. Only for demonstration */
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .left {
            width: 35%;
            background-color: white;
        }

        .middle {
            width: 30%;
            margin-left: 10px;
            background-color: white;
        }

        .right {
            width: 15%;
            margin-top: 0px;
            background-color: white;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <div id="page-container">
        <div id="content-wrap">
            <div class="row">
                <div class="col-2">
                    <div class="flex-shrink-0 p-3 bg-white" style="width: 230px; margin-left: 70px;">
                        <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
                            <svg class="bi me-2" width="30" height="24">
                                <use xlink:href="#bootstrap" />
                            </svg>
                            <!-- <span class="fs-5 fw-semibold">Collapsible</span> -->
                        </a>
                        <ul class="list-unstyled ps-0">
                            <li class="mb-1">
                                <button class="btn btn-toggle align-items-center rounded collapsed fw-bold" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                                    Manage Account
                                </button>
                                <div class="collapse show" id="home-collapse">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-4">
                                        <li><a href="manage_account.php" class="link-dark rounded">My Profile</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="mb-1">
                                <button class="btn btn-toggle align-items-center rounded collapsed fw-bold" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                                    My Orders
                                </button>
                                <div class="collapse show" id="dashboard-collapse">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-4">
                                        <li><a href="manage_account.php?my_orders" class="link-dark rounded">All Orders</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php
                if (isset($_GET["edit-account"])) {
                    include("edit_account.php");
                } else if (isset($_GET["my_orders"])) {
                    include("my_orders.php");
                } else {
                    if (isset($_SESSION["user_Id"])) {
                        $selectData = "SELECT * FROM users WHERE user_id ='{$_SESSION["user_Id"]}'";
                        $query = mysqli_query($conn, $selectData);
                        if (mysqli_num_rows($query)) {
                            while ($users = mysqli_fetch_array($query)) {
                                $first_name = $users["first_name"];
                                $last_name = $users["last_name"];
                                $email_address = $users["email_add"];
                                $account_address = $users["street_number"] . ", " . $users["barangay"] . ", " . $users["citymunicipality"] . ", " . $users["province"];
                                $mobile_number = $users["mobile_number"];
                                $birthday = $users["birthday"];
                                echo "
                                        <div class='col-10'>
        
                                            <h1 style='margin-left: 170px; margin-top: 50px; margin-bottom: 20px;'>My Account</h1>
                                                <div class='account_info' style='width: 87%; margin-left: auto; margin-right: auto;'>
                                                    <div class='account'>
                                                        <div class='row'>
                                                            <div class='column left'>
                                        ";
                                if (isset($_GET["edit-account"])) {
                                    include("edit_account.php");
                                } else {
                                    echo "
                                                                <a href='manage_account.php?edit-account'>
                                                                    <h6 style='float: right;'>Edit</h6>
                                                                </a>
                                                                <h5>Personal Profile</h5>
                                                                <h6 class='text-dark' style='margin-top: 20px; font-size: 15px;'><span style='color: gray;'>Name:</span> $first_name $last_name</h6>
                                                                <h6 class='text-dark' style='font-size: 15px;'><span style='color: gray;'>Contact Number:</span> $mobile_number</h6>
                                                                <h6 class='text-dark' style='font-size: 15px;'><span style='color: gray;'>Email-Address:</span> $email_address</h6>
                                                                <h6 class='text-dark'style='font-size: 15px;'><span style='color: gray;'>Birthday:</span> $birthday</h6>
        
                                                            </div>
                                                            <div class='column right' style='width: 400px;'>
        
                                                            <a href='manage_account.php?edit-account'>
                                                                <h6 style='float: right;'>Edit</h6>
                                                            </a>
                                                            <h5>Shipping Address</h5>
                                                            <h6 class='text-dark fw-bold' style='margin-top: 20px; font-size: 20px;'><span style='color: gray;'>Name:</span> $first_name $last_name</h6>
                                                            <h6 class='text-dark' style='font-size: 15px;'><span style='color: gray;'>Address:</span> $account_address Philippines, 4108</h6>
                                                            <h6 class='text-dark' style='font-size: 15px;'><span style='color: gray;'>Mobile Number:</span> $mobile_number</h6>
        
        
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                        ";
                                }
                            }
                        }
                    }
                }
                ?>
        
            </div>
        </div>
        <?php
        include("footer.php");
        ?>
    </div>


    <!---JAVASCRIPT----->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
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
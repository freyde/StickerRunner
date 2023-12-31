<?php
include("header.php");
?>

<body>
    <div id="page-container">
        <div id="content-wrap">
            <!----Banner----->
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="2000">
                        <img style="width:100%; height: 400px;" class="d-block w-100" src="images/bannersticker.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <img style="width:100%; height: 400px;" class="d-block w-100" src="images/bannersticker2.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <img style="width:100%; height: 400px;" class="d-block w-100" src="images/bannersticker3.jpg" alt="First slide">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <!----2 Columns----->
            <div class="section">
                <div class="row d-block">
                    <div class="best-selling">
                        <h1 style="padding-top: 1rem" class="text-center">Best-Selling Items</h1>
                        <div class="h-100 d-flex align-items-center justify-content-center">
                            <div class="margin-left:100px;">
                                <?php
                                displayBestSellingItems();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div style="padding-left:4rem" class="row">
                    <div class="card col-md-2 shadow p-3 mb-5 bg-white rounded ">
                        <h3>Categories</h3>
                        <ul class="list-group">
                            <?php
                            $select_query = "SELECT * FROM mens_categories";
                            $resultOfSelectQuery = mysqli_query($conn, $select_query);
                            if (isset($_GET["category"])) {
                                echo "<a href='index.php'>
                                        <li class='list-group-item'>
                                            All
                                        </li>
                                    </a>";
                                while ($row = mysqli_fetch_assoc($resultOfSelectQuery)) {
                                    $category_name = $row["mens_category_name"];
                                    $category_id = $row["mens_category_id"];
                                    if (trim($_GET["category"], "\"") == $category_name) {
                                        echo "<a href='index.php?category=\"$category_name\"'>
                                            <li class='list-group-item active'>
                                                $category_name
                                            </li>
                                        </a>";
                                    } else {
                                        echo "<a href='index.php?category=\"$category_name\"'>
                                            <li class='list-group-item'>
                                                $category_name
                                            </li>
                                        </a>";
                                    }
                                }
                            } else {
                                echo "<a href='index.php'>
                                        <li class='list-group-item active'>
                                            All
                                        </li>
                                    </a>";
                                while ($row = mysqli_fetch_assoc($resultOfSelectQuery)) {
                                    $category_name = $row["mens_category_name"];
                                    $category_id = $row["mens_category_id"];
                                    echo "<a href='index.php?category=\"$category_name\"'>
                                        <li class='list-group-item'>
                                            $category_name
                                          </li>
                                    </a>";
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <!----Column right----->
                    <div class="card col-md-10 shadow p-3 mb-5 bg-white rounded container" style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; grid-auto-rows: 340px;">
                        <!-- <table> -->
                        <!-- <tr>
                                <th>
                                    <h1 class="h3">Items</h1>
                                </th>
            
                                <th style="padding-left: 400px;">
                                    <div class="nav_buttons">
                                        <br><br>
                                        <button type="btn">1</button>
                                        <button type="btn">2</button>
                                        <button type="btn">3</button>
                                        <button type="btn">4</button>
                                    </div>
                                </th>
                            </tr> -->
                        <!-- </table> -->
                        <!----Sort By Dropdown Menu----->
                        <!-- <h3 class="h6" style="text-align: left;"></h3> -->
                        <!-- <div class="dropdown">
                    <button onclick="clickDropdown()" class="dropbtn dropdown-toggle" style="text-align: left;"
                    data-toggle="dropdown">Sort By</button>
                        <div id="myDropdown" class="dropdown-content">
                            <a href="#">Date Added</a>
                            <a href="#">Best Selling</a>
                            <a href="#">Brands</a>
                        </div> -->
                        <!----ITEMS LIST----->
                        <!----fetching products from items table in the database ---->
                        <?php
                        if (isset($_GET["category"])) {
                            displayCategoryItems($_GET["category"]);
                        } else {
                            displayAllItems();
                            get_items_from_Category($conn);
                        }
                        ?>
                    </div><!---for right column--->
                </div>
                <!----Footer Section----->
            </div>
            
        </div>
        <?php
            include("footer.php");
        ?>
    </div>






    <!---JAVASCRIPT----->

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


    <!-- <script>
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
    </script> -->

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
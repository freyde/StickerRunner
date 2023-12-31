<?php
session_start();

if (isset($_SESSION['auth'])) {
    include_once("header.php");
    include_once("includes/functions.inc.php");
?>


    <div id="page-container">
        <div id="content-wrap">
            <div class="content">
                <div class="pt-4">
                    <?php
                    if (isset($_SESSION["user_Id"])) {
                        $selectData = "SELECT * FROM users WHERE user_id ='{$_SESSION["user_Id"]}'";
                        $query = mysqli_query($conn, $selectData);
                        if (mysqli_num_rows($query)) {
                            while ($users = mysqli_fetch_array($query)) {
                                $first_name = $users["first_name"];
                                $last_name = $users["last_name"];
                                $email_address = $users["email_add"];
                                $account_address = $users["street_number"] . ", Barangay " . $users["barangay"] . ", " . $users["citymunicipality"] . ", " . $users["province"];
                                $mobile_number = $users["mobile_number"];
                                $birthday = $users["birthday"];
                            }
                            $select_from_orders = "SELECT * FROM `orders` WHERE order_email_add = '$email_address'";
                            $select_query = mysqli_query($conn, $select_from_orders);
                            while ($row = mysqli_fetch_assoc($select_query)) {
                                $package_unique_num = $row["package_num"];
                            }
                    ?>
                            <div class="row mb-4">
                                <div class="col-md-11 mx-auto">
                                        <div class="account_info">
                                            <h1>My Orders</h1>
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="my_orders.php?All_Orders">All</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="my_orders.php?To_Ship_Orders">To Ship</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="my_orders.php?To_Receive_Orders">In-Transit</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="my_orders.php?Received_Orders">Received</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="my_orders.php?Cancelled_Orders">Cancelled</a>
                                                </li>
                                            </ul>

                                            <?php
                                            if (isset($_GET["All_Orders"])) {
                                                include("mo_all_orders.php");
                                            } else if (isset($_GET["To_Ship_Orders"])) {
                                                include("mo_to_ship.php");
                                            } else if (isset($_GET["To_Receive_Orders"])) {
                                                include("mo_to_receive.php");
                                            } else if (isset($_GET["Received_Orders"])) {
                                                include("mo_received.php");
                                            } else if (isset($_GET["Cancelled_Orders"])) {
                                                include("mo_cancelled.php");
                                            } else {
                                                include("mo_all_orders.php");
                                            }
                                            ?>
                                        </div>
                                    </div>
                            <?php
                        }
                    }
                            ?>
                                </div>
                            </div>
                </div>
            </div>
        </div>
        <?php
        include("footer.php");
        ?>
    </div>

    <!----Footer Section----->




    <!---JAVASCRIPT----->
    <script src="jquery-3.6.3.js"></script>
    <!-- <script src="./assets/checkout_function.js"></script> -->

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

<?php
} else {
    header("Location: ../loginpage.php?login_required");
    exit();
}
?>
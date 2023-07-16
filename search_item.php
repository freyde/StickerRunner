<?php
include("header.php");
include("includes/search.php");
?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper" style="min-height: 100vh; position: relative;">
        <div class="content" style="padding-bottom:200px">
            <div class="card col-md-11 shadow pt-2 mt-4 mb-3 bg-white rounded container" style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 10px; grid-auto-rows: 50px;">
                <?php
                if (isset($_GET['searchString']))
                    echo "<h3>Search result for: <i>" . $_GET['searchString'] . "</i></h3>";
                ?>
            </div>
            <div class="card col-md-11 shadow p-1 mb-1 bg-white rounded container" style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; grid-auto-rows: 340px;">
                <?php
                if (isset($_GET['searchString'])) 
                    getSearchItems();
                ?>
            </div>
        </div>
        <footer>
            <div class="footer" style="position: absolute; padding: 10px 10px 0px 10px; bottom: 0; height: 200px;">
                <div class="footer_row">
                    <div class="footer_column">
                        <h4 style="color: white;">About Sticker Runner</h1>
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
                </div>
                <hr style="color: white; background-color: white; height: 2px; width: 85%; margin-left: 100px;">
                <h6 style="margin-top: 30px; text-align: center;">(C) 2022 Sticker Runner. All Rights Reserved</h6>
            </div>
        </footer>
    </div>
</body>

</html>
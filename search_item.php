<?php
include("header.php");
include("includes/search.php");
?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
    <div id="page-container">
        <div id="content-wrap">
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
            
            </div>
        </div>
        <?php
        include("footer.php");
        ?>
    </div>
</body>

</html>
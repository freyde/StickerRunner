<?php
include 'db.php';

if (isset($_GET['delete_all']) && $_GET['delete_all'] == true) {
    $deleteQuery = "DELETE FROM cart";
    mysqli_query($con, $deleteQuery);

    echo '<script>alert("Cart items have been removed.");</script>';
}

header("Location: cart.php");
exit();
?>

<?php
include 'db.php';

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO cart (product_id, quantity) VALUES ('$product_id', '$quantity')";

    if (mysqli_query($con, $sql)) {
        echo "<script>
                alert('Item added to cart successfully.');
                window.location.href = 'cart.php';
            </script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<?php
include 'db.php';

// Move items from cart to checkout table
$moveItemsQuery = "INSERT INTO checkout (product_id, quantity) SELECT product_id, quantity FROM cart";
mysqli_query($con, $moveItemsQuery);

// Clear cart
$clearCartQuery = "DELETE FROM cart";
mysqli_query($con, $clearCartQuery);
?>

<script>
    alert("Checkout successful. Your items have been moved to the checkout table.");
    window.location.href = "delete.php?delete_all=true";
</script>

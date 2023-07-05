<?php
include "header.php";
?>

<style>
    .checkout-container {
        background-color: #ffffff;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .checkout-container h2 {
        margin-bottom: 20px;
    }

    .checkout-container p {
        margin: 0;
    }

    .checkout-container .product-item {
        margin-bottom: 10px;
    }

    .checkout-container .product-item h3 {
        margin: 0;
    }

    .checkout-container .product-item p {
        margin: 0;
    }

    .checkout-container .total-price {
        margin-top: 10px;
        font-weight: bold;
    }

    .payment-form {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 999;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .payment-form h3 {
        margin-bottom: 10px;
    }
</style>

<script>
    function confirmCheckout() {
        var confirmation = confirm("Are you sure you want to proceed with the checkout?");

        if (confirmation) {
            // Redirect to checkout process page
            window.location.href = "checkout_process.php";
        }
    }
</script>

<?php
include 'db.php';

$sql = "SELECT * FROM cart";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $totalPrice = 0;

    echo '<div class="checkout-container">';
    echo '<h2>Checkout</h2>';

    while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];

        // Fetch product details from the products table using the $product_id
        $product_sql = "SELECT * FROM products WHERE product_id='$product_id'";
        $product_result = mysqli_query($con, $product_sql);
        $product_row = mysqli_fetch_assoc($product_result);

        $product_title = $product_row['product_title'];
        $product_price = $product_row['product_price'];
        $itemPrice = $product_price * $quantity;
        $totalPrice += $itemPrice;

        // Display product item details
        echo '<div class="product-item">';
        echo '<h3>' . $product_title . '</h3>';
        echo '<p>Quantity: ' . $quantity . '</p>';
        echo '<p>Price: P' . $itemPrice . '</p>';
        echo '</div>';
    }

    // Display total price
    echo '<p class="total-price">Total: P' . $totalPrice . '</p>';

    // Confirm button
    echo '<button class="confirm-btn" onclick="confirmCheckout()">Confirm</button>';

    echo '</div>';

    // Payment form
    echo '<div class="payment-form">';
    echo '<h3>Payment Details</h3>';
    echo '<p>Name: John Doe</p>';
    echo '<p>Phone: 123-456-7890</p>';
    echo '</div>';
} else {
    echo '<div class="checkout-container">No items in the cart.</div>';
}
?>

<?php
include "newslettter.php";
include "footer.php";
?>

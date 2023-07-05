<?php
include "header.php";
?>

<style>
    .cart-container {
        background-color: #ffffff;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .cart-item {
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid #dddddd;
        position: relative;
    }

    .cart-item h3 {
        margin: 0;
    }

    .cart-item p {
        margin: 0;
    }

    .checkout-btn,
    .delete-btn {
        display: inline-block;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        text-align: center;
        cursor: pointer;
    }

    .checkout-btn {
        background-color: #4CAF50;
        color: #ffffff;
        margin-right: 10px;
    }

    .delete-btn {
        background-color: #f44336;
        color: #ffffff;
        margin-left: 10px;
    }

    .floating-checkout {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 999;
    }
</style>

<?php
include 'db.php';

$sql = "SELECT * FROM cart";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<div class="cart-container">';
    while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];

        // Fetch product details from the products table using the $product_id
        $product_sql = "SELECT * FROM products WHERE product_id='$product_id'";
        $product_result = mysqli_query($con, $product_sql);
        $product_row = mysqli_fetch_assoc($product_result);

        // Display cart item details with checkboxes
        echo '
            <div class="cart-item">
                <input type="checkbox" name="selected_products[]" value="' . $product_id . '">
                <h3>' . $product_row['product_title'] . '</h3>
                <p>Quantity: ' . $quantity . '</p>
                <a href="delete.php?product_id=' . $product_id . '" class="delete-btn">Delete</a>
                <a href="checkout.php?product_id=' . $product_id . '" class="checkout-btn">Checkout</a>
            </div>
        ';
    }
    echo '</div>';

    // Floating Checkout button
    echo '<a href="checkout.php" class="checkout-btn floating-checkout">Checkout</a>';
} else {
    echo '<div class="cart-container">No items in the cart.</div>';
}
?>


	
<?php
include "footer.php";
?>

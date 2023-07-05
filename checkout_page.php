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

    .checkout-item {
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid #dddddd;
    }

    .checkout-item h3 {
        margin: 0;
    }

    .checkout-item p {
        margin: 0;
    }
</style>

<div class="checkout-container">
    <h2>Checkout</h2>

    <?php
    include 'db.php';

    $sql = "SELECT * FROM checkout";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];
            $quantity = $row['quantity'];

            // Fetch product details from the products table using the $product_id
            $product_sql = "SELECT * FROM products WHERE product_id='$product_id'";
            $product_result = mysqli_query($con, $product_sql);
            $product_row = mysqli_fetch_assoc($product_result);

            // Display checked out item details
            echo '
                <div class="checkout-item">
                    <h3>' . $product_row['product_title'] . '</h3>
                    <p>Quantity: ' . $quantity . '</p>
                </div>
            ';
        }
    } else {
        echo "No items in the checkout.";
    }
    ?>

</div>

<?php
include "footer.php";
?>

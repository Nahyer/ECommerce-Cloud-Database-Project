<?php
session_start();

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $productId => $product) {
        echo '<p>' . $product['name'] . ' - $' . number_format($product['price'], 2) . '</p>';
        // You can display other product details as needed
    }
} else {
    echo 'Your cart is empty.';
}
?>

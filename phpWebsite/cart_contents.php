<?php
session_start();

if (isset($_SESSION["user_email"]) && isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ecommerce";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

//Query to fetch cart_id
$sql = "SELECT cart_id FROM carts WHERE customer_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
        // Fetch the cart_id
        $row = $result->fetch_assoc();
        $cart_id = $row['cart_id'];
    } else {
        // No cart found for the user
        echo 'Cart not found';
    }

// Query to fetch cart items
$sql = "SELECT ci.cart_item_id, ci.cart_id, ci.product_id, ci.quantity, ci.price, p.name
        FROM cart_items ci
        INNER JOIN products p ON ci.product_id = p.product_id
        WHERE ci.cart_id = ?"; // Replace ? with the actual cart_id you want to retrieve items for

// Prepare and execute the query
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cart_id); // Bind the cart_id parameter, assuming it's an integer
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Check if there are cart items
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display cart item details
        echo '<div>';
        echo '<p>' . $row['name'] . ' - $' . number_format($row['price'], 2) . ' (Quantity: ' . $row['quantity'] . ')</p>';
        // You can display other cart item details as needed
        echo '</div>';
    }
} else {
    echo 'No items in the cart.';
}

// Close the prepared statement
$stmt->close();


    $conn->close();
} else {
    echo 'Your cart is empty.';
}
?>

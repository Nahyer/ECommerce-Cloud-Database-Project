<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION["user_email"]) && isset($_SESSION["user_id"])) {
    $loggedIn = true;
    $user_id = $_SESSION["user_id"];
    $usernameID = $_SESSION["user_email"];
} else {
    // If the user is not logged in, redirect to the login page
    header("Location: loginpage.php");
    exit();
}

// Handle logout
if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: loginpage.php");
    exit();
}

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Include your database connection code here
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ecommerce";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch product details based on product_id
    $sql = "SELECT * FROM products WHERE product_id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch product details
        $product = $result->fetch_assoc();

        // Check if a cart exists for the user, or create one if it doesn't
        $cart_id = 0; // Initialize cart_id to 0
        $sql = "SELECT cart_id FROM carts WHERE customer_id = $user_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // A cart already exists for the user
            $row = $result->fetch_assoc();
            $cart_id = $row['cart_id'];
        } else {
            // Create a new cart for the user
            $sql = "INSERT INTO carts (customer_id) VALUES ($user_id)";
            if ($conn->query($sql) === TRUE) {
                $cart_id = $conn->insert_id; // Get the newly created cart's ID
            } else {
                echo "Error creating cart: " . $conn->error;
                exit();
            }
        }

        // Check if the product already exists in the user's cart items
        $sql = "SELECT cart_item_id, quantity FROM cart_items WHERE cart_id = $cart_id AND product_id = $product_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Product exists in the cart; update quantity
            $row = $result->fetch_assoc();
            $cart_item_id = $row['cart_item_id'];
            $new_quantity = $row['quantity'] + 1;

            $sql = "UPDATE cart_items SET quantity = $new_quantity WHERE cart_item_id = $cart_item_id";
            if ($conn->query($sql) === TRUE) {
                echo 'Product added to cart';
            } else {
                echo "Error updating cart item: " . $conn->error;
            }
        } else {
            // Product doesn't exist in the cart; add a new item
            $quantity = 1; // Initial quantity
            $price = $product['price']; // Get the product's price

            $sql = "INSERT INTO cart_items (cart_id, product_id, quantity, price) VALUES ($cart_id, $product_id, $quantity, $price)";
            if ($conn->query($sql) === TRUE) {
                echo 'Product added to cart';
            } else {
                echo "Error adding product to cart: " . $conn->error;
            }
        }
    } else {
        echo 'Product not found';
    }

    $conn->close();
} else {
    echo 'Invalid request';
}
?>

<?php
session_start();

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

        // Initialize the cart session variable if it doesn't exist
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Add the selected product to the cart session variable
        $_SESSION['cart'][$product_id] = $product;
        echo 'Product added to cart';
    } else {
        echo 'Product not found';
    }

    $conn->close();
} else {
    echo 'Invalid request';
}
?>

<!-- Include your database connection code here (e.g., mysqli or PDO) -->
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


$servername = "localhost";
$username = "root";
$password = "";
$database = "ecommerce";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$products = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$sql = "SELECT category_id, name FROM categories";
$result = $conn->query($sql);

$categories = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add your custom CSS styles here */
        /* Example styles for the products page */
        .product-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 10px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">E-Braxthon Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="productspage.php">All Products</a>
            </li>
            <li class="nav-item dropdown">
                <!-- Add the "Categories" dropdown menu -->
                <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categories
                </a>
                <div class="dropdown-menu" aria-labelledby="categoriesDropdown">
                    <!-- Populate the dropdown menu with categories from the database -->
                    <?php foreach ($categories as $category): ?>
                        <a class="dropdown-item" href="#" data-category-id="<?php echo $category["category_id"]; ?>"><?php echo $category["name"];?></a>
                    <?php endforeach; ?>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="checkout.php">Cart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contactUs.php">Contact Us</a>
            </li>
             <h2 style="color: #7d5fff;">Welcome,<?php echo $usernameID; ?>!</h2>
            <li>
                <form method="post" action="">
                    <button type="submit" name="logout" class="logout-btn">Log Out</button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<div class="toast" id="cartNotification" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
    <div class="toast-header">
        <strong class="mr-auto">Added to Cart</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        Product has been added to your cart.
    </div>
</div>

    <!-- Products Page Content -->
    <div id="all-products" class="container mt-5">
        <h2>Our Products</h2>
        <div class="row">
            <!-- Loop through products and create product cards -->
            <?php foreach ($products as $product): ?>
                <div class="col-md-4">
                    <div class="product-card">
                        <!-- You can use PHP to display product information -->
                        <img src="product1.jpg" alt="<?php echo $product['name']; ?>" class="img-fluid">
                        <h3><?php echo $product['name']; ?></h3>
                        <p><?php echo $product['description']; ?></p>
                        <p>Price: $<?php echo number_format($product['price'], 2); ?></p>
                        <button class="btn btn-primary add-to-cart" data-product-id="<?php echo $product['product_id']; ?>">Add to Cart</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="product-container" class="container mt-5">
      <!-- Products will be displayed here -->
    </div>

    <!-- Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Your Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Cart contents will be displayed here -->
                <div id="cart-content">
                    <!-- You can use JavaScript to dynamically populate this section -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button " class="btn btn-primary" id="checkoutButton">Proceed to Checkout</button>
            </div>
        </div>
    </div>
</div>


    <!-- Link to Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="assets/js/category-filter.js"></script>
    <script src="assets/js/cart.js"></script>

</body>
</html>

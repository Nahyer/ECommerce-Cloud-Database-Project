<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our E-Commerce Store</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ecommerce";


$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch categories from the database
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
<body>
  
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">E-Braxthon Store</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Products</a>
            </li>
            <li class="nav-item dropdown">
                <!-- Add the "Categories" dropdown menu -->
                <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categories
                </a>
                <div class="dropdown-menu" aria-labelledby="categoriesDropdown">
                    <!-- Populate the dropdown menu with categories from the database -->
                    <?php foreach ($categories as $category): ?>
                        <a class="dropdown-item" href="#"><?php echo $category["name"]; ?></a>
                    <?php endforeach; ?>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Cart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
            </li>
        </ul>
    </div>
</nav>

    <!-- Welcome Content -->
    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to Our E-Commerce Store</h1>
            <p class="lead">Discover a wide range of products at great prices.</p>
            <hr class="my-4">
            <p><a class="btn btn-primary btn-lg" href="productspage.php" role="button">Browse Products</a></p>
        </div>
    </div>

    <!-- Link to Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

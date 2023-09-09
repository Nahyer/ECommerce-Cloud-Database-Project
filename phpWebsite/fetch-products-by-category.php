<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ecommerce";


$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["categoryId"])) {
    $categoryId = $_POST["categoryId"];

    // Query to fetch products by category
    $sql = "SELECT * FROM products WHERE category_id = $categoryId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="row">';
        while ($row = $result->fetch_assoc()) {
            // Generate HTML for each product

            echo '<div class="col-md-4">';
            echo '<div class="product-card">';
            echo '<img src="product.jpg" alt= '. $row['name'] . 'class="img-fluid">';
            echo '<h3>' . $row["name"] . '</h3>';
            echo '<p>' . $row["description"] . '</p>';
            echo '<p>Price: $' .number_format($row["price"], 2) . '</p>';
            echo '<button class="btn btn-primary">Add to Cart</button>';
            echo '</div>';
            echo '</div>';
            
        }
        echo '</div>';
    } else {
        echo "No products found in this category.";
    }
}
$conn->close();
?>

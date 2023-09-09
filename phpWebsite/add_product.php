<?php

// Connect to the database
$conn = mysqli_connect("localhost", "admin", "", "braxthon_db");

// Check connection
if(!$conn){
  die("Connection failed: " . mysqli_connect_error());
}

// Get the product data 
$name = $_POST['name'];
$description = $_POST['description']; 
$category_id = $_POST['category_id'];
$price = $_POST['price'];

// Insert product into the database
$sql = "INSERT INTO products (name, description, category_id, price) VALUES ('$name', '$description', $category_id, $price)";

if(mysqli_query($conn, $sql)){
  echo "Product inserted successfully.";
} else{
  echo "Error: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
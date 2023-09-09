<?php
// Connect to the database 
$conn = mysqli_connect("localhost", "root","", "braxthon_db");

// Check connection
if(!$conn){
  die("Connection failed: " . mysqli_connect_error());
}

// Get the customer data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];


// Insert customer into database
$sql = "INSERT INTO customers (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";

if(mysqli_query($conn, $sql)){
  echo "Customer inserted successfully.";
} else{
  echo "Error: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);  
?>
<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Database connection settings (replace with your actual settings)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "ecommerce";

        // Create a database connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert user data into the 'customers' table
        $sql = "INSERT INTO customers (first_name, last_name, email, password, password_hash)
                VALUES ('$first_name', '$last_name', '$email', '$password', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            // Registration successful
            header("Location: loginpage.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }
?>

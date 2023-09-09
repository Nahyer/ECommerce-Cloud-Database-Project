<?php
session_start();

if (isset($_SESSION["email"])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $passw = $_POST["password"];

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

    // Query the database to check user credentials
    $sql = "SELECT * FROM customers WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password_hash"];

        // Verify the submitted password against the hashed password
        if (password_verify($passw, $hashed_password)) {
            // Password is correct; start a session and store user information
            $_SESSION["user_id"] = $row["customer_id"];
            $_SESSION["user_email"] = $row["email"];
            header("Location: productspage.php");
            exit();
        }else {
            // Password is incorrect; display the error message on the login form
            echo '<script>
                    window.onload = function() {
                        var errorMessage = document.getElementById("error-message");
                        errorMessage.innerHTML = "Incorrect password. Please try again.";
                    };
                </script>';
        }
    } else {
        // User not found; display the error message on the login form
        echo '<script>
                window.onload = function() {
                    var errorMessage = document.getElementById("error-message");
                    errorMessage.innerHTML = "User not found. Please check your email.";
                };
            </script>';
    }

    // Close the database connection
    $conn->close();
}
?>
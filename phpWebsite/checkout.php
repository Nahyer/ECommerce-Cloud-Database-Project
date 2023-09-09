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

// database connection code 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ecommerce";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT cart_id FROM carts WHERE customer_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
            // Fetch the cart_id
            $row = $result->fetch_assoc();
            $cart_id = $row['cart_id'];
        } else {
            // No cart found for the user
            echo 'YOUR CART IS EMPTY';
            
        }

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
    $totalCost = 0;


    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["confirm_payment"])) {
        // User has confirmed the payment
     $enteredAmount = floatval($_POST["entered_amount"]);

        if ($enteredAmount >= $totalCost && $enteredAmount != 0) {
            // Payment is successful
            
            // Begin a transaction
            $conn->begin_transaction();

            try {
                // Insert a new order record into the 'orders' table
                $insertOrderSQL = "INSERT INTO orders (customer_id, total_amount) VALUES (?, ?)";
                $stmt = $conn->prepare($insertOrderSQL);
                $stmt->bind_param("id", $user_id, $enteredAmount);
                $stmt->execute();

                // Retrieve the generated order_id
                $order_id = $stmt->insert_id;

                // Insert order items into the 'order_items' table
                $insertOrderItemSQL = "INSERT INTO order_items (order_id, product_id, quantity, subtotal) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($insertOrderItemSQL);
                
                while ($row = $result->fetch_assoc()) {
                    $product_id = $row['product_id'];
                    $quantity = $row['quantity'];
                    $subtotal = $row['price'] * $quantity;
                    $stmt->bind_param("iiid", $order_id, $product_id, $quantity, $subtotal);
                    $stmt->execute();
                }

                // Commit the transaction
                $conn->commit();

                // Empty the user's cart
                $deleteCartItemsSQL = "DELETE FROM cart_items WHERE cart_id = ?";
                $stmt = $conn->prepare($deleteCartItemsSQL);
                $stmt->bind_param("i", $cart_id);
                $stmt->execute();

                   // Send a confirmation email
               try{

                $to = "$usernameID";
                $subject = "Order Confirmation - Order ID: $order_id";
                $message = "Dear " . $usernameID . ",\r\n\r\n";
                $message .= "Thank you for your order!\r\n\r\n";
                $message .= "Your order (Order ID: $order_id) has been successfully placed with a total amount of $" . number_format($totalCost, 2) . ".\r\n\r\n";
                $message .= "If you have any questions or concerns, please contact our support team.\r\n\r\n";
                $message .= "Sincerely,\r\nE-Braxthon Store\r\n";

                $headers = "From: your-email@example.com"; // Replace with your email address or a no-reply email address
                $headers .= "\r\nReply-To: your-email@example.com"; // Replace with your email address or a no-reply email address

                // Send the email
                mail($to, $subject, $message, $headers);
               } catch (Exception $e) {
                echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
               }

                // Provide a success message or redirect to a confirmation page
                $confirmationMessage = "Order successfully placed. Thanks for shopping! Order ID: $order_id";

            } catch (Exception $e) {
                // Roll back the transaction in case of an error
                $conn->rollback();

                // Handle the error and provide an error message
                $errorMessage = "An error occurred while processing your order. Please try again.";
            }
        } else {
            $errorMessage = "Cannot process payment. Please enter a valid amount due.";
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Your custom styles here */
        .checkout-container {
            margin-top: 50px;
        }
        .total-cost {
            font-size: 24px;
            font-weight: bold;
        }
        .error-message {
            color: red;
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
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="productspage.php">All Products</a>
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

   <div class="container checkout-container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <?php if (isset($confirmationMessage)): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $confirmationMessage; ?>
                </div>
            <?php else: ?>
                <h2>Checkout</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td>' . $row['name'] . '</td>';
                                    echo '<td>$' . number_format($row['price'], 2) . '</td>';
                                    echo '<td>' . $row['quantity'] . '</td>';
                                    echo '<td>$' . number_format($row['price'] * $row['quantity'], 2) . '</td>';
                                    echo '</tr>';
                                    $totalCost += $row["price"] * $row["quantity"];
                                }
                            } else {
                                echo '<tr><td colspan="4">No items in the cart.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="total-cost">Total Cost: $<?php echo number_format($totalCost, 2); ?></div>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="entered_amount">Enter Amount Due:</label>
                        <input type="number" step="0.01" class="form-control" name="entered_amount" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="confirm_payment">Confirm Payment</button>
                </form>
                <?php if (isset($errorMessage)): ?>
                    <p class="error-message"><?php echo $errorMessage; ?></p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>


    <!-- Link to Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

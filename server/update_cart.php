<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the total price and product quantity from the AJAX request
    $totalPrice = $_POST['total_price'];
    $productQuantity = $_POST['product_quantity'];

    // Update the session variables with the received data
    $_SESSION['total'] = $totalPrice;
    $_SESSION['quantity'] = $productQuantity;

    // Send a response back to the JavaScript indicating success
    http_response_code(200);
    echo "Cart updated successfully.";
} else {
    // Send an error response if the request method is not POST
    http_response_code(400);
    echo "Invalid request.";
}
?>

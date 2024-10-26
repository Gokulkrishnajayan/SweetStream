<?php
// Start the session to manage user data if needed
session_start();

// Database connection (update with your credentials)
include $_SERVER['DOCUMENT_ROOT'] .'/SweetStream/php/db_connection.php';

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $payment_method = $_POST['payment_method'];
    $total_amount = filter_input(INPUT_POST, 'total_amount', FILTER_VALIDATE_FLOAT);
    $address = $conn->real_escape_string($_POST['address']);
    $phone_no = $conn->real_escape_string($_POST['phone_no']);

    // Assume these values for demonstration purposes
    $product_id = 1;  // Replace with the actual product ID
    $product_quantity = 2;  // Replace with the actual quantity

    if ($total_amount <= 0) {
        die("Invalid total amount. Please try again.");
    }

    // Prepare payment details message based on method
    switch ($payment_method) {
        case 'credit_card':
            $payment_details = "Paid with Credit/Debit Card.";
            break;
        case 'net_banking':
            $payment_details = "Paid using Net Banking.";
            break;
        case 'upi':
            $payment_details = "Paid using UPI.";
            break;
        case 'cash_on_delivery':
            $payment_details = "Cash on Delivery selected.";
            break;
        default:
            die("Invalid payment method.");
    }

    // Insert order details into the delivery_table
    $stmt = $conn->prepare("
        INSERT INTO delivery_table (product_id, product_quantity, price, address, phone_no, status)
        VALUES (?, ?, ?, ?, ?, 'pending')
    ");

    $stmt->bind_param("iisss", $product_id, $product_quantity, $total_amount, $address, $phone_no);

    if ($stmt->execute()) {
        // On success, redirect to a success page
        header("Location: payment_success.php");
    } else {
        // Handle errors
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect to the order page if accessed directly
    header("Location: order.php");
    exit();
}
?>

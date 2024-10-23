<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id']; // Get the logged-in user's ID
$product_id = $_POST['product_id']; // Get the product ID from the form

// Database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Enable error reporting for SQL errors
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Check if the product already exists in the cart for this user
$sql = "SELECT quantity FROM cart_table WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Product already exists, no change in quantity
    $row = $result->fetch_assoc();
    $new_quantity = $row['quantity']; // Keep the existing quantity

    $update_sql = "UPDATE cart_table SET quantity = ? WHERE user_id = ? AND product_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param('iii', $new_quantity, $user_id, $product_id);
    $update_stmt->execute();
    $update_stmt->close();
} else {
    // Product not in cart, insert a new record with default quantity of 1
    $default_quantity = 1;
    $insert_sql = "INSERT INTO cart_table (user_id, product_id, quantity) VALUES (?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param('iii', $user_id, $product_id, $default_quantity);
    $insert_stmt->execute();
    $insert_stmt->close();
}

$stmt->close();
$conn->close();

// Redirect back to the cart page or display a success message
header('Location: cart.php');
exit();
?>

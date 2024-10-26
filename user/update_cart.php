<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id']; // Get the logged-in user ID

// Include the database connection file
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';

// Create a new database connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]));
}

// Enable strict error reporting for MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Retrieve product IDs and quantities from the POST request
$product_ids = $_POST['product_id'] ?? [];
$quantities = $_POST['quantity'] ?? [];

// Ensure product IDs and quantities match in count
if (count($product_ids) !== count($quantities)) {
    echo json_encode(['success' => false, 'message' => 'Mismatched product IDs and quantities.']);
    exit();
}

// Prepare the SQL query to update the cart
$sql = "UPDATE cart_table SET quantity = ? WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($sql);

// Check if query preparation succeeded
if (!$stmt) {
    die(json_encode(['success' => false, 'message' => 'Query preparation failed: ' . $conn->error]));
}

// Iterate over the product IDs and update their quantities
for ($i = 0; $i < count($product_ids); $i++) {
    $product_id = intval($product_ids[$i]);
    $quantity = max(1, intval($quantities[$i])); // Ensure quantity is at least 1

    // Bind parameters and execute the query
    $stmt->bind_param('iii', $quantity, $user_id, $product_id);
    $stmt->execute();
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Send a success response in JSON format
echo json_encode(['success' => true, 'message' => 'Cart updated successfully!']);
?>

<?php
// Include the database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Get the order ID from the query string
if (isset($_GET['did'])) {
    $did = $_GET['did'];

    // Prepare the SQL query to fetch the order details
    $query = "SELECT * FROM delivery_table WHERE did = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $did);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the order exists
    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
        echo json_encode(['success' => true, 'order' => $order]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Order not found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Order ID not provided']);
}
?>

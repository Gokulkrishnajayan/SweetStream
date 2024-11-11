<?php
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';
session_start();

// Create the database connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $data = json_decode(file_get_contents("php://input"), true);

    // Extract order_id and status from the POST data
    $orderId = $data['order_id'] ?? null;
    $newStatus = $data['status'] ?? null;

    // Check if both order_id and status are provided
    if ($orderId && $newStatus) {
        // Determine if we need to update the delivery_delivered_time
        $updateTime = ($newStatus === 'Delivered') ? ", delivery_delivered_time = NOW()" : "";

        // SQL query to update the order status
        $sql = "UPDATE delivery_table SET status = ?, delivery_dispatched_time = NOW() $updateTime WHERE did = ?";
        $stmt = $conn->prepare($sql);

        // Check if the query was prepared successfully
        if ($stmt === false) {
            echo json_encode(['success' => false, 'error' => 'Failed to prepare the SQL query']);
            exit();
        }

        // Bind the parameters (status and orderId) to the query
        $stmt->bind_param("si", $newStatus, $orderId);

        // Execute the query and check for success
        if ($stmt->execute()) {
            // Respond with a success message
            echo json_encode(['success' => true, 'message' => 'Order status updated successfully']);
        } else {
            // Respond with an error message if the query fails
            echo json_encode(['success' => false, 'error' => 'Database update failed']);
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Respond with an error if the required parameters are missing
        echo json_encode(['success' => false, 'error' => 'Invalid input']);
    }
} else {
    // Respond with an error if the request method is not POST
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

// Close the database connection
$conn->close();
?>

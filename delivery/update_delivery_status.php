<?php
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';
session_start();
$conn = new mysqli($host, $user, $password, $dbname);

// Check if the request method is POST and the required data is available
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode the incoming JSON data
    $data = json_decode(file_get_contents('php://input'), true);
    $orderId = $data['order_id'] ?? null;
    $newStatus = $data['status'] ?? null;

    // Check if both orderId and status are provided
    if ($orderId && $newStatus) {
        // Set up the SQL query based on the status
        $updateTime = "";
        if ($newStatus === 'Delivered') {
            // If the status is 'Delivered', set delivery_delivered_time
            $updateTime = ", delivery_delivered_time = NOW()";
        }

        // Common SQL to update the status and delivery dispatched time
        $sql = "UPDATE delivery_table SET status = ?, delivery_dispacted_time = NOW() $updateTime WHERE did = ?";
        $stmt = $conn->prepare($sql);
        
        // Bind the parameters
        $stmt->bind_param("si", $newStatus, $orderId);

        // Execute and check if the status was successfully updated
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Order status updated successfully']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Database update failed']);
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // If invalid input, send an error response
        echo json_encode(['success' => false, 'error' => 'Invalid input']);
    }
} else {
    // If the request method is not POST, return an error
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

// Close the database connection
$conn->close();
?>

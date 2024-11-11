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
        // Step 1: Get the user_id and delivery_date_time from the database based on order_id
        $sql = "SELECT user_id, delivery_date_time FROM delivery_table WHERE did = ?";
        $stmt = $conn->prepare($sql);
        
        // Check if the query was prepared successfully
        if ($stmt === false) {
            echo json_encode(['success' => false, 'error' => 'Failed to prepare the SQL query to fetch user_id and delivery_date_time']);
            exit();
        }

        // Bind the orderId to the query
        $stmt->bind_param("i", $orderId);
        
        // Execute the query
        $stmt->execute();
        
        // Bind the result to variables
        $stmt->bind_result($userId, $deliveryDateTime);
        
        // Fetch the result
        if ($stmt->fetch()) {
            // Step 2: Update the status and delivery_delivered_time
            // Only update the delivery_delivered_time if the status is "Delivered"
            $updateTime = ($newStatus === 'Delivered') ? ", delivery_delivered_time = NOW()" : "";
            $updateDispatchedTime = ($newStatus !== 'Order Dispatched') ? ", delivery_dispatched_time = NOW()" : "";

            // SQL query to update the order status and delivery times
            $updateSql = "UPDATE delivery_table SET status = ? $updateDispatchedTime $updateTime WHERE did = ?";
            
            // Prepare the update query
            $updateStmt = $conn->prepare($updateSql);
            
            // Check if the update query was prepared successfully
            if ($updateStmt === false) {
                echo json_encode(['success' => false, 'error' => 'Failed to prepare the SQL query to update the status']);
                exit();
            }

            // Bind the parameters (status and did) to the query
            $updateStmt->bind_param("si", $newStatus, $orderId);

            // Execute the update query
            if ($updateStmt->execute()) {
                // Respond with a success message
                echo json_encode(['success' => true, 'message' => 'Order status updated successfully']);
            } else {
                // Respond with an error message if the update query fails
                echo json_encode(['success' => false, 'error' => 'Database update failed']);
            }

            // Close the prepared statement for the update
            $updateStmt->close();
        } else {
            // Respond with an error if the orderId does not exist
            echo json_encode(['success' => false, 'error' => 'Order not found']);
        }

        // Close the prepared statement for the select query
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

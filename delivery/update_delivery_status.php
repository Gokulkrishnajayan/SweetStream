<?php
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php'; // Include the database connection
session_start(); // Start the session

// Create a connection using mysqli
$conn = new mysqli($host, $user, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST and the required data is available
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $orderId = $data['order_id'] ?? null;  // Order ID from the request
    $newStatus = $data['status'] ?? null;  // New status ('Delivered' or other)

    if ($orderId && $newStatus) {
        // Step 1: Get the user_id and delivery_date_time from the provided order_id
        $sql = "SELECT user_id, delivery_date_time FROM delivery_table WHERE did = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $order = $result->fetch_assoc();
            $userId = $order['user_id'];
            $deliveryDateTime = $order['delivery_date_time'];

            // Step 2: Construct the SQL to update the status of all orders with the same user_id and delivery_date_time
            $updateTime = ($newStatus === 'Delivered') ? ", delivery_delivered_time = NOW()" : "";  // Only update delivery_delivered_time if status is 'Delivered'
            $sqlUpdate = "UPDATE delivery_table SET status = ?, delivery_dispacted_time = NOW() $updateTime WHERE user_id = ? AND delivery_date_time = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("sis", $newStatus, $userId, $deliveryDateTime); // Use the same user_id and delivery_date_time

            // Step 3: Execute the update
            if ($stmtUpdate->execute()) {
                echo json_encode(['success' => true, 'message' => 'Order statuses updated successfully']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Database update failed']);
            }

            $stmtUpdate->close();
        } else {
            echo json_encode(['success' => false, 'error' => 'Order not found']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid input']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

// Close the database connection
$conn->close();
?>

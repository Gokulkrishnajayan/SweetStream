<?php
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';
session_start();
$conn = new mysqli($host, $user, $password, $dbname);


// Check if the request method is POST and the required data is available
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $orderId = $data['order_id'] ?? null;
    $newStatus = $data['status'] ?? null;

    if ($orderId && $newStatus) {
        // Update the delivery_table with the new status and update delivery_delivered_time if "Delivered"
        $updateTime = ($newStatus === 'Delivered') ? ", delivery_delivered_time = NOW()" : "";
        $sql = "UPDATE delivery_table SET status = ?, delivery_dispacted_time = NOW() $updateTime WHERE did = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $newStatus, $orderId);

        // Execute and check for success
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Order status updated successfully']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Database update failed']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid input']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

$conn->close();
?>

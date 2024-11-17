<?php
// Include database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db.php';

// Get the order ID from the request body
$data = json_decode(file_get_contents("php://input"));
$orderId = $data->order_id;

// Update the order status to "pending" and remove the delivery person assignment
$query = "UPDATE delivery_table SET deliveryperson_id = NULL, status = 'pending' WHERE did = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $orderId);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to cancel the order']);
}
?>

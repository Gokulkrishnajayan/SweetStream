<?php
// Include the database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Get the incoming data (order ID)
$data = json_decode(file_get_contents("php://input"));

if (isset($data->did)) {
    $did = $data->did;

    // Prepare the SQL query to delete the order
    $query = "DELETE FROM delivery_table WHERE did = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $did);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to remove order']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Order ID not provided']);
}
?>

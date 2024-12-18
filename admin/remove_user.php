<?php
header('Content-Type: application/json');


// Database configuration
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';


// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

// Get the user ID from the request
$data = json_decode(file_get_contents("php://input"), true);
$userId = $data['id'];

// Delete the user from the database
$sql = "DELETE FROM user_table WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userId);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to delete user']);
}

$stmt->close();
$conn->close();
?>

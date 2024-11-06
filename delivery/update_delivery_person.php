<?php
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';
session_start();
$conn = new mysqli($host, $user, $password, $dbname);


// Set PHP timezone
date_default_timezone_set('Asia/Kolkata'); // Adjust as needed
// Set MySQL timezone
$conn->query("SET time_zone = '+05:30'"); // Adjust as needed

$response = ['success' => false];

if ($conn->connect_error) {
    $response['error'] = "Connection failed: " . $conn->connect_error;
    echo json_encode($response);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'];
$delivery_person_id = $data['delivery_person_id'];
$order_date = $data['order_date'];
$current_time = date("Y-m-d H:i:s:A");
$status = "Order Dispatched";

if ($user_id && $delivery_person_id && $order_date) {
    $sql = "
        UPDATE delivery_table 
        SET deliveryperson_id = ?, 
            delivery_dispacted_time = ?, 
            status = ? 
        WHERE user_id = ? AND delivery_date_time = ?
    ";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters with correct types
        $stmt->bind_param("sssds", $delivery_person_id, $current_time, $status, $user_id, $order_date);
        
        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['error'] = "Failed to update delivery status: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $response['error'] = "Failed to prepare the query: " . $conn->error;
    }
} else {
    $response['error'] = "Invalid input data.";
}

$conn->close();
echo json_encode($response);
?>

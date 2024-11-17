<?php
// Include the database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Get the incoming data (order details)
$data = json_decode(file_get_contents("php://input"));

if (isset($data->did, $data->delivery_date_time, $data->price, $data->product_quantity, $data->address)) {
    $did = $data->did;
    $deliveryDateTime = $data->delivery_date_time;
    $price = $data->price;
    $quantity = $data->product_quantity;
    $address = $data->address;

    // Prepare the SQL query to update the order
    $query = "UPDATE delivery_table SET delivery_date_time = ?, price = ?, product_quantity = ?, address = ? WHERE did = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sdssi", $deliveryDateTime, $price, $quantity, $address, $did);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update order']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
}
?>

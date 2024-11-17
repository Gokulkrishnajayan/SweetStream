<?php
// Include the database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Get the incoming data (order ID and delivery person ID)
$data = json_decode(file_get_contents("php://input"));

if (isset($data->did, $data->delivery_person_id)) {
    $did = $data->did;
    $deliveryPersonId = $data->delivery_person_id;

    // Prepare the SQL query to assign the delivery person to the order and update the status
    $query = "UPDATE delivery_table SET deliveryperson_id = ?, status = 'assigned' WHERE did = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $deliveryPersonId, $did);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to assign delivery person']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
}
?>

<?php
// Include the database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Prepare the SQL query to get all delivery persons
$query = "SELECT id, name FROM user_table WHERE privilege = 'delivery_person'";
$result = $conn->query($query);

// Check if delivery persons are found
if ($result->num_rows > 0) {
    $deliveryPersons = [];
    while ($row = $result->fetch_assoc()) {
        $deliveryPersons[] = $row;
    }
    echo json_encode(['success' => true, 'deliveryPersons' => $deliveryPersons]);
} else {
    echo json_encode(['success' => false, 'message' => 'No delivery persons found']);
}
?>

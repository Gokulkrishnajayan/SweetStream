<?php
// Include the database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';
$conn = new mysqli($host, $user, $password, $dbname);

// Check for a successful connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the raw POST data from the request body
$data = json_decode(file_get_contents('php://input'), true);

// Check if data is provided
if (isset($data['order_id']) && isset($data['status'])) {
    $order_id = (int)$data['order_id'];  // Ensure order_id is an integer
    $status = $conn->real_escape_string($data['status']);  // Escape the status string

    // Prepare the SQL statement to update the delivery status
    $sql = "UPDATE delivery_table SET status = ? WHERE did = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters
        $stmt->bind_param("si", $status, $order_id);

        // Execute the statement
        if ($stmt->execute()) {
            // If the query is successful, return a success response
            echo json_encode(['success' => true]);
        } else {
            // If there is an error with the query
            echo json_encode(['success' => false, 'error' => 'Failed to update the order status']);
        }

        // Close the statement
        $stmt->close();
    } else {
        // If the prepared statement failed
        echo json_encode(['success' => false, 'error' => 'Failed to prepare the query']);
    }
} else {
    // If required data is missing in the request
    echo json_encode(['success' => false, 'error' => 'Missing required parameters']);
}

// Close the database connection
$conn->close();
?>

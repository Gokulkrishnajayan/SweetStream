<?php
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';
start_session();
$conn = new mysqli($host, $user, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON payload
    $input = json_decode(file_get_contents('php://input'), true);

    // Extract order_id and status from the input
    $order_id = isset($input['order_id']) ? $input['order_id'] : null;
    $status = isset($input['status']) ? $input['status'] : null;

    // Ensure both order_id and status are provided
    if ($order_id && $status) {
        // Prepare the SQL query to update the delivery status
        $sql = "UPDATE delivery_table SET status = ? WHERE did = ? AND deliveryperson_id = ?";

        // Prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii", $status, $order_id, $_SESSION['user_id']);

        // Execute the query
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update status']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid parameters']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

$conn->close();
?>

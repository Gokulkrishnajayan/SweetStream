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

    // Step 1: Get the user_id and delivery_date_time for the provided order_id
    $sql = "SELECT user_id, delivery_date_time FROM delivery_table WHERE did = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind the order_id
        $stmt->bind_param("i", $order_id);
        
        // Execute the statement
        $stmt->execute();
        
        // Bind the results to variables
        $stmt->bind_result($user_id, $delivery_date_time);
        
        // Fetch the result
        if ($stmt->fetch()) {
            // Step 2: Update all orders with the same user_id and delivery_date_time
            $update_sql = "UPDATE delivery_table SET status = ? WHERE user_id = ? AND delivery_date_time = ?";
            
            if ($update_stmt = $conn->prepare($update_sql)) {
                // Bind the parameters for the update query
                $update_stmt->bind_param("sis", $status, $user_id, $delivery_date_time);
                
                // Execute the update statement
                if ($update_stmt->execute()) {
                    // If the query is successful, return a success response
                    echo json_encode(['success' => true]);
                } else {
                    // If there is an error with the update query
                    echo json_encode(['success' => false, 'error' => 'Failed to update order statuses']);
                }
                // Close the update statement
                $update_stmt->close();
            } else {
                // If the prepared update statement failed
                echo json_encode(['success' => false, 'error' => 'Failed to prepare the update query']);
            }
        } else {
            // If the order_id is not found
            echo json_encode(['success' => false, 'error' => 'Order ID not found']);
        }
        
        // Close the select statement
        $stmt->close();
    } else {
        // If the prepared statement for fetching user_id and delivery_date_time failed
        echo json_encode(['success' => false, 'error' => 'Failed to prepare the query']);
    }
} else {
    // If required data is missing in the request
    echo json_encode(['success' => false, 'error' => 'Missing required parameters']);
}

// Close the database connection
$conn->close();
?>

<?php
// Database configuration
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';


// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $e->getMessage()]);
    exit();
}

// Get the JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

// Validate required fields
if (!isset($data['id'], $data['name'], $data['phone_no'], $data['email'], $data['address'], $data['privilege'])) {
    echo json_encode(["success" => false, "message" => "Invalid input data"]);
    exit();
}

// Prepare SQL update query
try {
    $sql = "UPDATE user_table SET 
                name = :name, 
                phone_no = :phone_no, 
                email = :email, 
                address = :address, 
                privilege = :privilege 
            WHERE id = :id";

    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
    $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
    $stmt->bindParam(':phone_no', $data['phone_no'], PDO::PARAM_STR);
    $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
    $stmt->bindParam(':address', $data['address'], PDO::PARAM_STR);
    $stmt->bindParam(':privilege', $data['privilege'], PDO::PARAM_STR);

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "User updated successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update user"]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "SQL error: " . $e->getMessage()]);
}
?>

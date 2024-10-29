<?php
// Include your database connection and session handling
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';
session_start(); // Start session to access user data 

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(403); // Forbidden
    echo json_encode(["error" => "Unauthorized access."]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Create connection
    $conn = new mysqli($host, $user, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        http_response_code(500); // Internal Server Error
        echo json_encode(["error" => "Database connection failed: " . $conn->connect_error]);
        exit;
    }

    $userId = $_SESSION['user_id']; // Get user ID from session

    // Fetch current user data
    $sql = "SELECT name, email, phone_no, address FROM user_table WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 0) {
        http_response_code(404); // Not Found
        echo json_encode(["error" => "User not found."]);
        exit;
    }

    $currentUser = $result->fetch_assoc();

    // Get new values and validate/sanitize them
    $firstName = $conn->real_escape_string(trim($_POST['first_name']));
    $lastName = $conn->real_escape_string(trim($_POST['last_name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = $conn->real_escape_string(trim($_POST['phone']));
    $address = $conn->real_escape_string(trim($_POST['address']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Invalid email format."]);
        exit;
    }

    $fullName = $firstName . ' ' . $lastName;

    // Check for changes
    if ($fullName !== $currentUser['name'] || $email !== $currentUser['email'] || $phone !== $currentUser['phone_no'] || $address !== $currentUser['address']) {
        // Update user data in the database
        $sql = "UPDATE user_table SET name = ?, email = ?, phone_no = ?, address = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $fullName, $email, $phone, $address, $userId);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Profile updated successfully."]);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(["error" => "Error updating profile: " . $stmt->error]);
        }
    } else {
        echo json_encode(["info" => "No changes detected."]);
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Invalid request method."]);
}
?>

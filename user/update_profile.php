<?php
session_start(); // Start session

include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php'; // Database connection

$conn = new mysqli($host, $user, $password, $dbname); // Initialize connection

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$user_id = $_SESSION['user_id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user_id) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';

    // Validate inputs
    if (empty($name) || empty($email) || empty($phone) || empty($address)) {
        echo 'All fields are required.';
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email format.';
        exit;
    }

    $query = "UPDATE user_table SET name = ?, email = ?, phone_no = ?, address = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $name, $email, $phone, $address, $user_id);

    if ($stmt->execute()) {
        echo 'Profile updated successfully!';
    } else {
        echo 'Error updating profile: ' . $stmt->error;
    }
} else {
    echo 'Invalid request.';
}
?>

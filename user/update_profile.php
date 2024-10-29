<?php
// Include your database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/session/session_user.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Create connection
    $conn = new mysqli($host, $user, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userId = $_SESSION['user_id']; // Get user ID from session
    $firstName = $conn->real_escape_string(trim($_POST['first_name']));
    $lastName = $conn->real_escape_string(trim($_POST['last_name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $phone = $conn->real_escape_string(trim($_POST['phone']));
    $address = $conn->real_escape_string(trim($_POST['address']));

    $fullName = $firstName . ' ' . $lastName;

    // Update user data in the database
    $sql = "UPDATE user_table SET name = ?, email = ?, phone_no = ?, address = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $fullName, $email, $phone, $address, $userId);

    if ($stmt->execute()) {
        echo "Profile updated successfully.";
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

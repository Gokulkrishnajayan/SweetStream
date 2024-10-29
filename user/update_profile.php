<?php
// Include your database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/session/session_user.php';

// Start session if not already started
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Create connection
    $conn = new mysqli($host, $user, $password, $dbname);

 

    $userId = $_SESSION['user_id']; // Get user ID from session

    // Fetch current user data
    $sql = "SELECT name, email, phone_no, address FROM user_table WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentUser = $result->fetch_assoc();

    // Get new values
    $firstName = $conn->real_escape_string(trim($_POST['first_name']));
    $lastName = $conn->real_escape_string(trim($_POST['last_name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $phone = $conn->real_escape_string(trim($_POST['phone']));
    $address = $conn->real_escape_string(trim($_POST['address']));

    $fullName = $firstName . ' ' . $lastName;

    // Check for changes
    if ($fullName !== $currentUser['name'] || $email !== $currentUser['email'] || $phone !== $currentUser['phone_no'] || $address !== $currentUser['address']) {
        // Update user data in the database
        $sql = "UPDATE user_table SET name = ?, email = ?, phone_no = ?, address = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("ssssi", $fullName, $email, $phone, $address, $userId);

        if ($stmt->execute()) {
            echo "Profile updated successfully.";
        } else {
            echo "Error updating profile: " . htmlspecialchars($stmt->error);
        }
    } else {
        echo "No changes detected.";
    }

    $stmt->close();
    $conn->close();
}
?>

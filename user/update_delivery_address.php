<?php 
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
    exit();
}

// Include the database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db.php';

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $phone_no = trim($_POST['phone_no']);

    // Update user details in the database
    $stmt = $pdo->prepare("UPDATE user_table SET name = ?, email = ?, address = ?, phone_no = ? WHERE id = ?");
    if ($stmt->execute([$name, $email, $address, $phone_no, $user_id])) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database update failed']);
    }
    exit();
}
?>

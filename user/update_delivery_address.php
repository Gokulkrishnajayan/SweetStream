<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: /SweetStream/login.html');
    exit();
}

// Include the database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db.php';

$user_id = $_SESSION['user_id']; // Ensure the correct variable name

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $phone_no = trim($_POST['phone_no']);

    // Update user details in the database
    $stmt = $pdo->prepare("UPDATE user_table SET name = ?, email = ?, address = ?, phone_no = ? WHERE id = ?");
    
    if ($stmt->execute([$name, $email, $address, $phone_no, $user_id])) {
        // Redirect to checkout.php on success
        header('Location: /SweetStream/user/checkout.php');
        exit();
    } else {
        // Redirect to checkout.php with an error parameter
        header('Location: /SweetStream/user/checkout.php?status=error');
        exit();
    }
}
?>

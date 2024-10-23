<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /SweetStream/login.html"); // Redirect to login page if not logged in
    exit();
}

// Optional: Check user privilege for access control (admin/user/delivery).
function checkPrivilege($requiredPrivilege) {
    if ($_SESSION['privilege'] !== $requiredPrivilege) {
        header("Location: /SweetStream/login.html"); // Redirect to login if privilege doesn't match
        exit();
    }
}
?>

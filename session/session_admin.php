<?php
include $_SERVER['DOCUMENT_ROOT'] .'/SweetStream/session/session_check.php'; // Include session validation
checkPrivilege('admin'); // Ensure only admins can access

echo "Welcome, Admin " . $_SESSION['name'] . "!";
?>

<?php
include $_SERVER['DOCUMENT_ROOT'] .'/SweetStream/session/session_check.php'; // Include session validation
checkPrivilege('delivery'); // Ensure only delivery personnel can access

echo "Welcome, Delivery Personnel " . $_SESSION['name'] . "!";
?>

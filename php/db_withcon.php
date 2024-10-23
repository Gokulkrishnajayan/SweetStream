<?php
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';


// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

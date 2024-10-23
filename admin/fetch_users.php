<?php
// Database configuration
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';


$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get user data
$sql = "SELECT * FROM user_table";
$result = $conn->query($sql);

// Convert the data to JSON
$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Output JSON
header('Content-Type: application/json');
echo json_encode($users);

// Close the connection
$conn->close();
?>

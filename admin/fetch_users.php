<?php
// Database connection
$host = "localhost";
$user = "root";  // Your MySQL username
$pass = "";  // Your MySQL password
$dbname = "sweetstream";

$conn = new mysqli($host, $user, $pass, $dbname);

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

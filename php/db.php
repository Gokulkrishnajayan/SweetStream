<?php
// Database configuration
include 'db_connection.php';

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Could not connect to the database: ' . $e->getMessage()]);
    exit;
}





// Optional: If you still need a MySQLi connection, you can create it as follows:
$conn = new mysqli($host, $user, $password, $dbname);

// Check MySQLi connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'MySQLi connection failed: ' . $conn->connect_error]);
    exit;
}

// At this point, both $pdo and $conn are available for use.
// You can use $pdo for PDO queries and $conn for MySQLi queries.

?>

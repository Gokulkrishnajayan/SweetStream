<?php
// Database configuration
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';


// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products with name and stock quantity
$query = "SELECT pid, pname, current_stock FROM product_table";
$result = $conn->query($query);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
echo json_encode($products); // Send JSON response
$conn->close();
?>

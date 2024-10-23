<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$data = json_decode(file_get_contents('php://input'), true);
$product_id = $data['product_id'];

if (isset($product_id)) {
    $stmt = $conn->prepare("DELETE FROM cart_table WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid product ID']);
}

$conn->close();
?>

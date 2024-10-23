<?php
include $_SERVER['DOCUMENT_ROOT'] .'/SweetStream/session/session_user.php';



include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$product_ids = $_POST['product_id'];
$quantities = $_POST['quantity'];

for ($i = 0; $i < count($product_ids); $i++) {
    $product_id = intval($product_ids[$i]);
    $quantity = intval($quantities[$i]);

    $sql = "UPDATE cart_table SET quantity = ? WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }

    $stmt->bind_param('iii', $quantity, $user_id, $product_id);
    $stmt->execute();
}

$stmt->close();
$conn->close();

echo json_encode(['success' => true, 'message' => 'Cart updated successfully!']);
?>

<?php

include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';
$conn = new mysqli($host, $user, $password, $dbname);

// Get the posted JSON data
$data = json_decode(file_get_contents("php://input"), true);
$user_id = $data['user_id'];
$order_date = $data['order_date'];

// Prepare response array
$orderDetails = [
    'user_id' => $user_id,
    'order_date' => $order_date,
    'products' => []
];

// Fetch order details by joining the delivery, product, and user tables
$sql = "
    SELECT d.product_quantity, d.address, d.status,
           u.name AS customer_name, u.phone_no AS customer_phone,
           p.pname AS product_name, p.pphoto AS product_image
    FROM delivery_table d
    JOIN user_table u ON d.user_id = u.id
    JOIN product_table p ON d.product_id = p.pid
    WHERE d.user_id = ? AND d.delivery_date_time = ?
";

// Prepare and execute the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $user_id, $order_date);
$stmt->execute();
$result = $stmt->get_result();

// Loop through results and populate product details
while ($row = $result->fetch_assoc()) {
    $orderDetails['products'][] = [
        'product_name' => $row['product_name'],
        'quantity' => $row['product_quantity'],
        'image_url' => $row['product_image']
    ];
}

// Send the response back as JSON
header('Content-Type: application/json');
echo json_encode($orderDetails);

// Close connections
$stmt->close();
$conn->close();
?>

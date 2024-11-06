<?php
// Database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db.php';
// SQL query to join and group delivery, product, and user data
$sql = "
    SELECT d.did, d.address, d.status, d.user_id, d.delivery_date_time,
        u.name AS customer_name, u.phone_no AS customer_phone
    FROM delivery_table d
    JOIN user_table u ON d.user_id = u.id
    WHERE (d.status = 'pending' OR d.deliveryperson_id IS NULL)
    GROUP BY d.user_id, d.delivery_date_time
    ORDER BY d.delivery_date_time DESC
";

$result = $conn->query($sql);
$orders = [];

while ($row = $result->fetch_assoc()) {
    $orders[] = [
        'order_id' => $row['did'],
        'customer_name' => $row['customer_name'],
        'address' => $row['address'],
        'phone_no' => $row['customer_phone'],
        'status' => $row['status'],
        'user_id' => $row['user_id'],
        'order_date' => $row['delivery_date_time']
    ];
}

if (empty($orders)) {
    echo "<p class='text-center'>No pending orders available.</p>";
} else {
    foreach ($orders as $order) {
        echo "
            <div class='tracking-card'>
                <div class='order-item'>
                    <div class='order-info'>
                        <h5>Order ID: #{$order['order_id']}</h5>
                        <p>Customer: {$order['customer_name']}</p>
                        <p>Address: {$order['address']}</p>
                        <p>Phone: {$order['phone_no']}</p>
                    </div>
                    <div class='order-status'>
                        <button class='btn btn-primary' onclick=\"openModal('{$order['order_id']}', '{$order['user_id']}', '{$order['order_date']}')\">Accept Order</button>
                    </div>
                </div>
            </div>";
    }
}
?>

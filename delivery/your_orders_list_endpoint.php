<?php
// Database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db.php';

// Check if a search term is provided
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// SQL query to fetch orders with optional search filters
$sql = "
    SELECT d.did, d.address, d.status, d.user_id, d.delivery_date_time, d.delivery_dispatched_time,
           u.name AS customer_name, u.phone_no AS customer_phone
    FROM delivery_table d
    JOIN user_table u ON d.user_id = u.id
    WHERE (d.status = 'pending' OR d.deliveryperson_id IS NULL)
";

// If there is a search term, we add a LIKE filter to the SQL query
if ($searchTerm) {
    $sql .= " AND (d.did LIKE ? OR u.name LIKE ? OR d.address LIKE ?)";
}

$sql .= " ORDER BY d.delivery_date_time DESC";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// If there is a search term, bind the parameters to the query
if ($searchTerm) {
    $searchTerm = "%" . $searchTerm . "%";  // Add wildcard for partial match
    $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
}

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

$orders = [];

while ($row = $result->fetch_assoc()) {
    // Format delivery_dispatched_time if available
    $dispatched_time = !empty($row['delivery_dispatched_time']) ? date("F j, Y, g:i a", strtotime($row['delivery_dispatched_time'])) : 'Not Dispatched Yet';

    $orders[] = [
        'order_id' => $row['did'],
        'customer_name' => $row['customer_name'],
        'address' => $row['address'],
        'phone_no' => $row['customer_phone'],
        'status' => $row['status'],
        'user_id' => $row['user_id'],
        'order_date' => $row['delivery_date_time'],
        'delivery_dispatched_time' => $dispatched_time
    ];
}

if (empty($orders)) {
    echo "<p class='text-center'>No pending orders found.</p>";
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
                        <p>Order Date: " . date("F j, Y, g:i a", strtotime($order['order_date'])) . "</p>
                        <p>Dispatched: {$order['delivery_dispatched_time']}</p>  <!-- Display dispatched time -->
                    </div>
                    <div class='order-status'>
                        <button class='btn btn-primary' onclick=\"openModal('{$order['order_id']}', '{$order['user_id']}', '{$order['order_date']}')\">Accept Order</button>
                    </div>
                </div>
            </div>";
    }
}
?>

<?php
// Database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db.php';

// Get the current logged-in user's ID from session or authentication
$currentUserId = $_SESSION['user_id']; // Example, replace with your session logic

// SQL query to join and group delivery, product, and user data
$sql = "
    SELECT d.did, d.address, d.status, d.user_id, d.delivery_date_time, d.deliveryperson_id,
        u.name AS customer_name, u.phone_no AS customer_phone
    FROM delivery_table d
    JOIN user_table u ON d.user_id = u.id
    WHERE (d.status = 'pending' OR d.deliveryperson_id IS NULL OR d.status = 'assigned')
    GROUP BY d.user_id, d.delivery_date_time
    ORDER BY 
        CASE
            WHEN d.deliveryperson_id = ? THEN 1  -- Show orders assigned to the current user first
            ELSE 2
        END,
        d.delivery_date_time DESC
";

// Prepare SQL statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $currentUserId); // Bind the current user's ID
$stmt->execute();
$result = $stmt->get_result();
$orders = [];

while ($row = $result->fetch_assoc()) {
    $orders[] = [
        'order_id' => $row['did'],
        'customer_name' => $row['customer_name'],
        'address' => $row['address'],
        'phone_no' => $row['customer_phone'],
        'status' => $row['status'],
        'user_id' => $row['user_id'],
        'order_date' => $row['delivery_date_time'],
        'deliveryperson_id' => $row['deliveryperson_id'] // Add deliveryperson_id to check against current user
    ];
}

if (empty($orders)) {
    echo "<p class='text-center'>No pending orders available.</p>";
} else {
    foreach ($orders as $order) {
        // Check if the order is assigned to the current user
        $assignedToCurrentUser = ($order['deliveryperson_id'] == $currentUserId);

        echo "
            <div class='tracking-card'>
                <div class='order-item'>
                    <div class='order-info'>
                        <h5>Order ID: #{$order['order_id']}</h5>
                        <p>Customer: {$order['customer_name']}</p>
                        <p>Address: {$order['address']}</p>
                        <p>Phone: {$order['phone_no']}</p>
                    </div>
                    <div class='order-status'>";

        // If the order is assigned to the current user, show the "Assigned" status
        if ($assignedToCurrentUser) {
            echo "<span class='badge badge-info'>Assigned to you</span>";  // Display 'Assigned to you' if this order is assigned to the current user
        } else {
            echo "<button class='btn btn-primary' onclick=\"confirmOrder('{$order['order_id']}')\">Accept Order</button>"; // Confirm button to accept the order
        }

        echo "
                    </div>
                </div>
            </div>";
    }
}
?>

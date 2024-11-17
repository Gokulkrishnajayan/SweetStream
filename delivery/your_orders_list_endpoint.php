<?php
// Include database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db.php';

// Get the current logged-in user's ID from session or authentication
$currentUserId = $_SESSION['user_id']; // Example: replace with your session logic

// Get the search term (if it exists)
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Base SQL query to get the orders and join the necessary tables
$sql = "
    SELECT d.did, d.address, d.status, d.user_id, d.delivery_date_time, d.deliveryperson_id,
        u.name AS customer_name, u.phone_no AS customer_phone
    FROM delivery_table d
    JOIN user_table u ON d.user_id = u.id
    WHERE (d.status = 'pending' OR d.deliveryperson_id IS NULL OR d.status = 'assigned')
";

// If there is a search term, filter the query based on multiple fields (Order ID, Customer Name, Address, Phone No.)
if ($searchTerm) {
    $sql .= " AND (d.did LIKE ? OR u.name LIKE ? OR d.address LIKE ? OR u.phone_no LIKE ?)";
}

// Sorting by delivery date and prioritizing orders assigned to the current user
$sql .= " ORDER BY 
              CASE
                  WHEN d.deliveryperson_id = ? THEN 1
                  ELSE 2
              END,
              d.delivery_date_time DESC
";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Bind the search term and current user ID to the SQL query
if ($searchTerm) {
    $searchTerm = "%" . $searchTerm . "%";  // Wildcards for LIKE
    $stmt->bind_param("sssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm, $currentUserId);
} else {
    $stmt->bind_param("i", $currentUserId); // If no search term, just bind the current user ID
}

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
        'deliveryperson_id' => $row['deliveryperson_id'],
        'assigned_to_user' => ($row['deliveryperson_id'] == $currentUserId)
    ];
}

// If no results are found, display a message
if (empty($orders)) {
    echo "<p class='text-center'>No orders found matching your search.</p>";
} else {
    // Loop through and display the search results
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
                    </div>";

        // Display the order status and actions based on assignment
        echo "<div class='order-status'>";
        
        // If the order is assigned to the current user, show "Assigned" and "Cancel" button
        if ($assignedToCurrentUser) {
            echo "
                <div class='assigned-info'>
                    <span class='badge badge-info assigned-badge'>Assigned to you</span>
                    <button class='btn btn-danger cancel-btn' onclick=\"cancelOrder('{$order['order_id']}')\">Cancel</button>
                </div>";
        }

        // Always show the "Accept Order" button
        echo "<button class='btn btn-primary accept-btn' onclick=\"openModal('{$order['order_id']}', '{$order['user_id']}', '{$order['order_date']}')\">Accept Order</button>";

        echo "</div>
                </div>
            </div>";
    }
}
?>

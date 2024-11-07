<?php
// Include database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db.php';

// Get search term from URL (GET)
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// SQL query to retrieve orders, including order ID, customer name, address, and status
$sql = "
    SELECT d.did, d.address, d.status, d.user_id, d.delivery_date_time,
        u.name AS customer_name, u.phone_no AS customer_phone
    FROM delivery_table d
    JOIN user_table u ON d.user_id = u.id
    WHERE (d.status = 'pending' OR d.deliveryperson_id IS NULL)
";

// If search term exists, filter the query based on the search input
if ($searchTerm) {
    $sql .= " AND (d.did LIKE ? OR u.name LIKE ? OR d.address LIKE ?)";
}

// Add sorting by delivery date
$sql .= " ORDER BY d.delivery_date_time DESC";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Bind parameters if there is a search term
if ($searchTerm) {
    $searchTerm = "%" . $searchTerm . "%";  // Wildcards for LIKE search
    $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
}

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Generate the HTML for the order list
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="tracking-card">
            <div class="card-title">
                <h5 class="text-primary">' . htmlspecialchars($row['customer_name']) . ' (Order ID: ' . htmlspecialchars($row['did']) . ')</h5>
            </div>
            <div class="card-details">
                <p><strong>Order Date:</strong> ' . date('d M Y, H:i', strtotime($row['delivery_date_time'])) . '</p>
                <p><strong>Delivery Address:</strong> ' . htmlspecialchars($row['address']) . '</p>
                <p><strong>Status:</strong> ' . ucfirst(htmlspecialchars($row['status'])) . '</p>
                <p><strong>Customer Phone:</strong> ' . htmlspecialchars($row['customer_phone']) . '</p>
            </div>
        </div>';
    }
} else {
    echo '<div class="alert alert-warning">No orders found for the given search criteria.</div>';
}
?>

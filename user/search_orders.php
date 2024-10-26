<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$search_query = isset($_GET['q']) ? $_GET['q'] : '';

// Database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch orders for the logged-in user based on the search query
$sql = "
    SELECT d.did, d.product_id, d.product_quantity, d.price, d.delivery_date_time, d.status, p.pname, p.pphoto, d.address
    FROM delivery_table d
    JOIN product_table p ON d.product_id = p.pid
    WHERE d.user_id = ?
    AND (d.did LIKE ? OR p.pname LIKE ? OR DATE(d.delivery_date_time) LIKE ?)
    ORDER BY d.delivery_date_time DESC
";

$stmt = $conn->prepare($sql);
$search_term = '%' . $search_query . '%';
$stmt->bind_param('iss', $user_id, $search_term, $search_term, $search_term);
$stmt->execute();
$result = $stmt->get_result();

$order_groups = [];

// Group orders by delivery date and time
while ($row = $result->fetch_assoc()) {
    $delivery_time = $row['delivery_date_time'];

    // Initialize the group if it doesn't exist
    if (!isset($order_groups[$delivery_time])) {
        $order_groups[$delivery_time] = [
            'products' => [],
            'total_price' => 0,
            'total_quantity' => 0,
            'status' => $row['status'],
            'date_time' => date('Y-m-d H:i', strtotime($row['delivery_date_time'])),
            'order_id' => $row['did']
        ];
    }

    // Add the product to the order group
    $order_groups[$delivery_time]['products'][] = $row;
    $order_groups[$delivery_time]['total_price'] += $row['price'] * $row['product_quantity'];
    $order_groups[$delivery_time]['total_quantity'] += $row['product_quantity'];
}

// Output the results as HTML
if (!empty($order_groups)) {
    foreach ($order_groups as $delivery_time => $order) {
        echo '<div class="order-card" onclick="toggleDetails(this)">';
        echo '<div class="order-header">';
        echo '<div class="order-id">';
        echo '<h4>Order ID: #' . $order['order_id'] . '</h4>';
        echo '<span>Total Products: ' . $order['total_quantity'] . '</span>';
        echo '<span>Ordered on: ' . $order['date_time'] . '</span>';
        echo '</div>';
        echo '<div class="order-summary">';
        echo '<div class="total-price"><strong>Total Price: </strong>₹' . number_format($order['total_price'], 2) . '</div>';
        echo '<div class="order-status"><span class="badge badge-' . ($order['status'] == 'Delivered' ? 'success' : 'warning') . '">' . ucfirst($order['status']) . '</span></div>';
        echo '</div></div>';
        echo '<div class="order-details" style="display: none;">';
        echo '<div class="order-info"><h5>Order Details</h5><ul>';
        foreach ($order['products'] as $item) {
            echo '<li class="order-item">';
            echo '<img src="' . $item['pphoto'] . '" alt="' . $item['pname'] . '">';
            echo '<div class="product-details">';
            echo '<span>' . $item['pname'] . '</span>';
            echo '<span class="product-quantity">Quantity: ' . $item['product_quantity'] . '</span>';
            echo '<span class="product-price">Price/liter: ₹' . number_format($item['price'], 2) . '</span>';
            echo '</div></li>';
        }
        echo '</ul></div></div></div>';
    }
} else {
    echo '<p class="text-center">No orders found matching your search.</p>';
}

// Close database connection
$stmt->close();
$conn->close();
?>

<?php
// Start the session to manage user data
session_start();

// Database connection (update with your credentials)
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve payment method and user ID
    $payment_method = $_POST['payment_method'];
    $user_id = $_SESSION['user_id'];

    if (!$user_id) {
        die("Please log in to proceed with checkout.");
    }

    // Retrieve address and phone number from user_table
    $user_sql = "SELECT address, phone_no FROM user_table WHERE id = ?";
    $user_stmt = $conn->prepare($user_sql);
    if (!$user_stmt) {
        die("Prepare failed (user query): " . $conn->error);
    }
    $user_stmt->bind_param("i", $user_id);
    $user_stmt->execute();
    $user_result = $user_stmt->get_result();

    if ($user_result->num_rows == 0) {
        die("User information not found.");
    }

    $user_data = $user_result->fetch_assoc();
    $address = $user_data['address'];
    $phone_no = $user_data['phone_no'];

    // Retrieve products from cart for the current user
    $sql = "
        SELECT c.product_id, c.quantity, p.pprice
        FROM cart_table c
        JOIN product_table p ON c.product_id = p.pid
        WHERE c.user_id = ?
    ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed (cart query): " . $conn->error);
    }
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        die("Your cart is empty.");
    }

    $total_amount = 0;
    $order_items = [];
    while ($row = $result->fetch_assoc()) {
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];
        $price = $row['pprice'];
        $total_amount += $quantity * $price;
        $order_items[] = [$product_id, $quantity, $price];
    }

    if ($total_amount <= 0) {
        die("Invalid total amount. Please try again.");
    }

    switch ($payment_method) {
        case 'credit_card':
            $payment_details = "Paid with Credit/Debit Card.";
            break;
        case 'net_banking':
            $payment_details = "Paid using Net Banking.";
            break;
        case 'upi':
            $payment_details = "Paid using UPI.";
            break;
        case 'cash_on_delivery':
            $payment_details = "Cash on Delivery.";
            break;
        default:
            die("Invalid payment method.");
    }

   $current_datetime = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
   $current_datetime=$current_datetime->format('Y-m-d h:i:s A');


    $conn->begin_transaction();
    $order_ids = []; // Store all inserted order IDs

    try {
        $stmt = $conn->prepare("
            INSERT INTO delivery_table 
            (product_id, user_id, product_quantity, price, address, phone_no, delivery_date_time, status, payment_details)
            VALUES (?, ?, ?, ?, ?, ?, ?, 'pending', ?)
        ");

        if (!$stmt) {
            throw new Exception("Prepare failed (delivery query): " . $conn->error);
        }

        foreach ($order_items as $item) {
            [$product_id, $quantity, $price] = $item;
            $stmt->bind_param("iiidssss", $product_id, $user_id, $quantity, $price, $address, $phone_no, $current_datetime, $payment_details);

            if (!$stmt->execute()) {
                throw new Exception("Execution failed: " . $stmt->error);
            }

            // Get the last inserted order ID
            $order_ids[] = $conn->insert_id;
        }

        $delete_cart = $conn->prepare("DELETE FROM cart_table WHERE user_id = ?");
        $delete_cart->bind_param("i", $user_id);
        $delete_cart->execute();

        $conn->commit();

        // Pass total amount and first order ID to payment_success.php
        $order_id = reset($order_ids); // Get the first order ID
        header("Location: payment_success.php?order_id=$order_id&total_amount=$total_amount");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "Checkout failed: " . $e->getMessage();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: order.php");
    exit();
}
?>

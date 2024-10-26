<?php
// Start the session if needed
session_start();

// Check if order_id and total_amount are passed via query parameters
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : 'N/A';
$total_amount = isset($_GET['total_amount']) ? $_GET['total_amount'] : 0.00;

// Redirect to order.php after 5 seconds
header("refresh:5;url=order.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Successful</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .success-container {
            background-color: #fff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 40px;
            text-align: center;
            max-width: 500px;
            width: 90%;
            animation: fadeIn 0.5s ease-in-out;
        }

        .success-container h1 {
            font-size: 32px;
            color: #28a745;
            margin-bottom: 10px;
        }

        .success-container p {
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
        }

        .success-container .order-details {
            background-color: #f8f8f8;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: left;
        }

        .order-details span {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .success-container a {
            display: inline-block;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .success-container a:hover {
            background-color: #218838;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <h1>Order Placed Successfully!</h1>
        <p>Your order has been placed. Thank you for shopping with us!</p>

        <div class="order-details">
            <span>Order ID: #<?php echo htmlspecialchars($order_id); ?></span>
            <span>Total Amount: ₹<?php echo number_format((float)$total_amount, 2); ?></span>
        </div>

        <p>You will be redirected to the Orders page shortly.</p>
        <a href="order.php">Go to Orders Now</a>
    </div>
</body>
</html>

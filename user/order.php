<?php
include $_SERVER['DOCUMENT_ROOT'] .'/SweetStream/session/session_user.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- title -->
    <title>About</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <!-- magnific popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!-- animate css -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- mean menu css -->
    <link rel="stylesheet" href="assets/css/meanmenu.min.css">
    <!-- main style -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- responsive -->
    <link rel="stylesheet" href="assets/css/responsive.css">

</head>

<body>
    <!-- header -->
    <div class="top-header-area" id="sticker">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 text-center">
                    <div class="main-menu-wrap">
                        <!-- logo -->
                        <div class="site-logo">
                            <a href="#">
                                <h3 class="orange-text">SweetStream</h3>
                            </a>
                        </div>
<!-- menu start -->
<nav class="main-menu">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="shop.php">Shop</a></li>
        <li class="current-list-item"><a href="order.php">Order</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
        
        <!-- Small screen Profile and Logout links -->
        <li class="smallscreenlog" ><a href="profile.php">Profile</a></li>
        <li class="smallscreenlog" 
        ><a href="logout.php">Logout</a></li>

        <!-- Profile with Dropdown for larger screens -->
        <li class="profile-menu">
            <a href="profile.php">Profile</a>
            <ul class="dropdown">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </li>

        <li>
            <div class="header-icons">
                <a class="shopping-cart" href="cart.php"><i class="fas fa-shopping-cart"></i></a>
            </div>
        </li>
    </ul>
</nav>
<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
<div class="mobile-menu"></div>
<!-- menu end -->

<style>
/* Main styling for profile menu */
.profile-menu {
    position: relative;
}

/* Hide the dropdown by default */
.profile-menu .dropdown {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 10;
    margin: 0;
    padding: 0;
}

.smallscreenlog {
        display: none; /* Display small screen elements */
    }


/* Show dropdown on hover for larger screens */
.profile-menu:hover .dropdown {
    display: block;
}

/* Styling for dropdown items */
.profile-menu .dropdown li a {
    display: block;
    padding: 10px 15px;
    color: #333;
    text-decoration: none;
    font-size: 14px;
}

/* Change background on hover */
.profile-menu .dropdown li a:hover {
    background-color: #f2f2f2;
}

/* Media queries */

/* For smaller screens (up to 768px) */
@media (max-width: 768px) {
    /* Show small screen links and hide profile menu */
    .smallscreenlog {
        display: block; /* Display small screen elements */
    }
    .profile-menu {
        display: none; /* Hide profile menu on smaller screens */
    }
}

/* For larger screens (above 768px) */
@media (min-width: 769px) {
    /* Hide small screen links and show profile menu */
    .smallscreenlog {
        display: none; /* Hide small screen elements on larger screens */
    }
    .profile-menu {
        display: block; /* Show profile menu on larger screens */
    }
}
</style>





                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end header -->

    <!-- search area -->
    <div class="search-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="close-btn"><i class="fas fa-window-close"></i></span>
                    <div class="search-bar">
                        <div class="search-bar-tablecell">
                            <h3>Search For:</h3>
                            <input type="text" placeholder="Keywords">
                            <button type="submit">Search <i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end search area -->

    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Your Orders</p>
                        <h1>Order Tracking</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->




    <?php

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch orders for the logged-in user
$sql = "
    SELECT d.did, d.product_id, d.product_quantity, d.price, d.delivery_date_time, d.status, p.pname, p.pphoto, d.address
    FROM delivery_table d
    JOIN product_table p ON d.product_id = p.pid
    WHERE d.user_id = ?
    ORDER BY d.delivery_date_time DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
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
            'date_time' => date('Y-m-d H:i A', strtotime($row['delivery_date_time'])),
            'order_id' => $row['did']
        ];
    }

    // Add the product to the order group
    $order_groups[$delivery_time]['products'][] = $row;
    $order_groups[$delivery_time]['total_price'] += $row['price'] * $row['product_quantity'];
    $order_groups[$delivery_time]['total_quantity'] += $row['product_quantity'];
}

// Close database connection
$stmt->close();
$conn->close();
?>

<!-- Order Tracking Section -->
<div class="order-tracking-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="tracking-card">
                    <h3 class="text-center">Your Recent Orders</h3>

                    <!-- Search Area for Order Tracking -->
                    <div class="search-area mb-4">
                        <div class="input-group">
                            <input type="text" class="form-control search-input" placeholder="Search by product name, order ID, or date" onkeyup="searchOrders()">
                            <div class="input-group-append">
                                <button class="btn btn-success search-button" type="button" onclick="searchOrders()">
                                    Search <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items Grouped by Delivery Date and Time -->
                    <div class="order-list">
                        <?php if (!empty($order_groups)): ?>
                            <?php foreach ($order_groups as $delivery_time => $order): ?>
                                <div class="order-card" onclick="toggleDetails(this)">
                                    <div class="order-header">
                                        <div class="order-id">
                                            <h4>Order ID: #<?php echo $order['order_id']; ?></h4>
                                            <span>Total Products: <?php echo $order['total_quantity']; ?></span>
                                            <span>Ordered on: <?php echo $order['date_time']; ?></span>
                                        </div>
                                        <div class="order-summary">
                                            <div class="total-price">
                                                <strong>Total Price: </strong>₹<?php echo number_format($order['total_price'], 2); ?>
                                            </div>
                                            <div class="order-status">
                                                <span class="badge badge-<?php echo ($order['status'] == 'Delivered') ? 'success' : 'warning'; ?>">
                                                    <?php echo ucfirst($order['status']); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="order-details" style="display: none;">
                                        <div class="order-info">
                                            <h5>Order Details</h5>
                                            <ul>
                                                <?php foreach ($order['products'] as $item): ?>
                                                    <li class="order-item">
                                                        <img src="<?php echo $item['pphoto']; ?>" alt="<?php echo $item['pname']; ?>">
                                                        <div class="product-details">
                                                            <span><?php echo $item['pname']; ?></span>
                                                            <span class="product-quantity">Quantity: <?php echo $item['product_quantity']; ?></span>
                                                            <span class="product-price">Price/liter: ₹<?php echo number_format($item['price'], 2); ?></span>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-center">You have no recent orders.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .order-tracking-section {
        background-color: #f9f9f9;
        padding: 20px 0;
        border-radius: 10px;
    }

    .tracking-card {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .search-area {
        margin-bottom: 20px;
    }

    .order-card {
        background: #fff;
        border: none; /* Removed border */
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        transition: transform 0.2s, box-shadow 0.2s;
        cursor: pointer;
    }

    .order-card:hover {
        transform: scale(1.02);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .order-id h4 {
        margin: 0;
    }

    .order-summary {
        text-align: right;
    }

    .total-price {
        font-size: 1.2em;
        color: #333;
    }

    .order-status {
        margin-top: 5px;
    }

    .order-details {
        margin-top: 10px;
    }

    .order-info ul {
        list-style-type: none;
        padding: 0;
    }

    .order-info li {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        padding: 10px 0;
    }

    .order-info img {
        width: 60px; /* Set image size */
        height: auto; /* Maintain aspect ratio */
        margin-right: 15px;
        border-radius: 5px;
        flex-shrink: 0; /* Prevent shrinking */
    }

    .product-details {
        flex-grow: 1; /* Allow text to take up available space */
    }

    .product-quantity,
    .product-price {
        display: block;
        font-size: 0.9em; /* Smaller font size for quantity and price */
        color: #666; /* Lighter color for quantity and price */
    }
</style>


<script>
    function toggleDetails(card) {
        const details = card.querySelector('.order-details');
        details.style.display = (details.style.display === 'none' || details.style.display === '') ? 'block' : 'none';
    }

    function searchOrders() {
        const query = document.querySelector('.search-input').value;

        // Create an AJAX request
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'search_orders.php?q=' + encodeURIComponent(query), true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.querySelector('.order-list').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
</script>




    
    <!-- footer -->
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box about-widget">
                        <h2 class="widget-title">About us</h2>
                        <p>Ut enim ad minim veniam perspiciatis unde omnis iste natus error sit voluptatem accusantium
                            doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box get-in-touch">
                        <h2 class="widget-title">Get in Touch</h2>
                        <ul>
                            <li>34/8, East Hukupara, Gifirtok, Sadan.</li>
                            <li>support@fruitkha.com</li>
                            <li>+00 111 222 3333</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box pages">
                        <h2 class="widget-title">Pages</h2>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About</a></li>
                            <li><a href="services.html">Shop</a></li>
                            <li><a href="news.html">News</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box subscribe">
                        <h2 class="widget-title">Subscribe</h2>
                        <p>Subscribe to our mailing list to get the latest updates.</p>
                        <form action="index.php">
                            <input type="email" placeholder="Email">
                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- footer end -->
        </div>
    </div>
    <!-- copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <p>Copyrights &copy; 2019 - <a href="https://imransdesign.com/">Imran Hossain</a>, All Rights
                        Reserved.</p>
                </div>
                <div class="col-lg-6 text-right col-md-12">
                    <div class="social-icons">
                        <ul>
                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end copyright -->

    <!-- jquery -->
    <script src="assets/js/jquery-1.11.3.min.js"></script>
    <!-- bootstrap -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- count down -->
    <script src="assets/js/jquery.countdown.js"></script>
    <!-- isotope -->
    <script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
    <!-- waypoints -->
    <script src="assets/js/waypoints.js"></script>
    <!-- owl carousel -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- magnific popup -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!-- mean menu -->
    <script src="assets/js/jquery.meanmenu.min.js"></script>
    <!-- sticker js -->
    <script src="assets/js/sticker.js"></script>
    <!-- main js -->
    <script src="assets/js/main.js"></script>

</body>

</html>
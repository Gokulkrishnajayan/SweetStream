<?php
include $_SERVER['DOCUMENT_ROOT'] .'/SweetStream/session/session_delivery.php';
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';
$conn = new mysqli($host, $user, $password, $dbname);

// Check if there is a search term
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

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


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SweetStream</title>
    <link rel="shortcut icon" type="image/png" href="../user/assets/img/favicn.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700|Poppins:400,700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../user/assets/css/all.min.css">
    <link rel="stylesheet" href="../user/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">

	<!-- owl carousel -->
	<link rel="stylesheet" href="../user/assets/css/owl.carousel.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="../user/assets/css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="../user/assets/css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="../user/assets/css/meanmenu.min.css">
	<!-- responsive -->
	<link rel="stylesheet" href="../user/assets/css/responsive.css">

    <style>
      
        .top-header-area {
            position: sticky;  
            top: 0;       
            z-index: 1000;    
            background-color: #051922; 
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            padding: 15px 0;
        }
       
       
        .main-menu a:hover {
            color: #f39c12;
        }
     
        
        .thead-dark th {
            background-color: #343a40; 
            color: #ffffff;
        }
        .table {
            background-color: #ffffff; 
            border-radius: 10px; 
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .table td {
            vertical-align: middle; 
            padding: 15px; 
        }
        .badge {
            padding: 5px 10px; 
            border-radius: 5px; 
        }
        .badge-success {
            background-color: #28a745; 
        }
        .badge-warning {
            background-color: #ffc107; 
        }
        .badge-danger {
            background-color: #dc3545; 
        }
        .card {
            border-radius: 12px; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }
        /* Chart styles */
        canvas {
            max-width: 100%;
            margin: 0 auto;
            border-radius: 12px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        /* Button styles */
        .btn-custom {
            background-color: #f39c12;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #d68a0a;
        } 
    </style>
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
						<!-- logo -->
						
						<!-- menu start -->
						<nav class="main-menu">
                        <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="task.php">Task</a></li>
                                <li class="current-list-item"><a href="order.php">Order</a></li>
                                <li><a href="profile.php">Profile</a></li>
								<li><a href="../session/logout.php">Logout</a></li>
                                <li>
                                    <div class="header-icons">
                                        <a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                                    </div>
                                </li>
                            </ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->

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

  
    <!-- order-tracking-section -->
<div class="order-tracking-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-center">Your Recent Orders</h3>

               
                <div class="search-area2 mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control search-input" placeholder="Search by product name or order ID">
                        <div class="input-group-append">
                            <button class="btn btn-success search-button" type="submit">
                                Search <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Container for displaying orders -->
                <div id="orderList">
                    <?php include 'your_orders_list_endpoint.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Structure -->
<div id="orderModal" class="modal">
    <div class="modal-content">
        <h5 class="modal-title">Order Details</h5>
        <div id="orderDetails" class="modal-body"></div>
        <div class="modal-footer">
            <button class="btn btn-success" id="confirmOrder" onclick="confirmOrder()" disabled>Confirm Order</button>
            <button class="btn btn-secondary" onclick="closeModal()">Cancel</button>
        </div>
    </div>
</div>

<script>
let selectedUserId = null;
let selectedOrderDate = null;

// Open the modal with the order details when an order is clicked
function openModal(orderId, userId, orderDate) {
    selectedUserId = userId;
    selectedOrderDate = orderDate;

    const modal = document.getElementById('orderModal');
    modal.style.display = 'flex';

    fetch('fetch_order_details.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ user_id: userId, order_date: orderDate })
    })
    .then(response => response.json())
    .then(data => {
        let productList = `<p><strong>Order Date:</strong> ${orderDate}</p><hr>`;
        data.products.forEach((product, index) => {
            productList += `
                <div class="product-item">
                    <input type="checkbox" class="product-checkbox" id="productCheckbox${index}" onclick="checkAllCheckboxes()">
                    <img src="${product.image_url}" alt="${product.product_name}">
                    <div class="product-info">
                        <h6>${product.product_name}</h6>
                        <p>Quantity: ${product.quantity}</p>
                    </div>
                </div>
            `;
        });

        document.getElementById('orderDetails').innerHTML = productList;
        document.getElementById('confirmOrder').disabled = true;
    })
    .catch(error => console.error('Error fetching order details:', error));
}

// Check if all checkboxes are selected to enable the confirm button
function checkAllCheckboxes() {
    const checkboxes = document.querySelectorAll('#orderDetails input[type="checkbox"]');
    const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
    document.getElementById('confirmOrder').disabled = !allChecked;
}

// Confirm the order assignment for the current user
function confirmOrder() {
    const currentUserId = <?php echo json_encode($_SESSION['user_id']); ?>;

    fetch('update_delivery_person.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            user_id: selectedUserId,
            order_date: selectedOrderDate,
            delivery_person_id: currentUserId,
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Order confirmed and dispatched successfully!");
            closeModal();
            refreshOrders(); // Refresh the orders list
        } else {
            alert("Failed to confirm order. Please try again.");
        }
    })
    .catch(error => {
        console.error("Error confirming order:", error);
        alert("An error occurred. Please try again later.");
    });
}

// Close the modal
function closeModal() {
    document.getElementById('orderModal').style.display = 'none';
}

// Refresh the orders list based on the search query without reloading the entire page
function refreshOrders(searchTerm = '') {
    fetch('your_orders_list_endpoint.php?search=' + searchTerm)
        .then(response => response.text())
        .then(html => {
            const orderList = document.getElementById('orderList');
            orderList.innerHTML = html;

            // Check if there are no orders and display message if needed
            if (!orderList.innerHTML.trim()) {
                orderList.innerHTML = "<p class='text-center'>No pending orders available.</p>";
            }
        })
        .catch(error => console.error("Error refreshing orders:", error));
}

// Handle search functionality
document.querySelector('.search-button').addEventListener('click', function(e) {
    e.preventDefault();  // Prevent the default form submit

    const searchTerm = document.querySelector('.search-input').value.trim();

    if (searchTerm !== '') {
        refreshOrders(searchTerm);
    } else {
        refreshOrders();  // Refresh without search term (show all orders)
    }
});

// Handle Enter key press for search (optional enhancement)
document.querySelector('.search-input').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        const searchTerm = e.target.value.trim();
        if (searchTerm !== '') {
            refreshOrders(searchTerm);
        } else {
            refreshOrders();
        }
    }
});










function cancelOrder(orderId) {
    // Confirm before canceling the order
    const confirmed = confirm("Are you sure you want to cancel this order?");

    if (confirmed) {
        fetch('cancel_order.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ order_id: orderId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Order canceled successfully!");
                refreshOrders();  // Refresh the orders list after cancellation
            } else {
                alert("Failed to cancel the order. Please try again.");
            }
        })
        .catch(error => {
            console.error("Error canceling the order:", error);
            alert("An error occurred. Please try again later.");
        });
    }
}

</script>





<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        max-width: 500px;
        width: 100%;
        position: relative;
    }

    .modal-title {
        text-align: center;
        font-size: 1.25rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }

    .modal-body {
        max-height: 300px;
        overflow-y: auto;
    }

    .product-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f1f1f1;
    }

    .product-item:last-child {
        border-bottom: none;
    }

    .product-item img {
        width: 50px;
        height: 50px;
        border-radius: 4px;
        margin-right: 15px;
        object-fit: cover;
    }

    .product-info {
        flex-grow: 1;
    }

    .product-info h6 {
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
        color: #333;
    }

    .product-info p {
        margin: 5px 0 0;
        color: #666;
        font-size: 0.875rem;
    }

    .product-checkbox {
        margin-right: 10px;
    }

    .modal-footer {
        text-align: center;
        margin-top: 20px;
    }

    .btn-secondary {
        background-color: #ccc;
        color: #333;
        border: none;
        padding: 8px 16px;
        cursor: pointer;
        border-radius: 4px;
        margin-right: 8px;
    }

    .btn-success {
        padding: 8px 16px;
        border: none;
        cursor: pointer;
        border-radius: 4px;
    }

    .btn-success[disabled] {
        background-color: #b5e7a0;
        cursor: not-allowed;
    }

    .btn-secondary:hover {
        background-color: #b3b3b3;
    }

    .btn-success:hover {
        background-color: #4caf50;
    }
</style>






 


    
	 <!-- Footer -->
	 <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box about-widget">
                        <h2 class="widget-title">About us</h2>
                        <p>Ut enim ad minim veniam perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
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
                            <li><a href="about.html">About</a></li>
                            <li><a href="services.html">Shop</a></li>
                            <li><a href="news.html">News</a></li>
                            <li><a href="contact.html">Contact</a></li>
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
        </div>
    </div>
    <!-- End Footer -->

    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <p>Copyrights &copy; 2023 - <a href="https://imransdesign.com/">Gokul Krishna Jayan</a>,  All Rights Reserved.</p>
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
    <!-- End Copyright -->

	<!-- jquery -->
	<script src="../user/assets/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="../user/assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
	<script src="../user/assets/js/jquery.countdown.js"></script>
	<!-- isotope -->
	<script src="../user/assets/js/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<script src="../user/assets/js/waypoints.js"></script>
	<!-- owl carousel -->
	<script src="../user/assets/js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="../user/assets/js/jquery.magnific-popup.min.js"></script>
	<!-- mean menu -->
	<script src="../user/assets/js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="../user/assets/js/sticker.js"></script>
	<!-- main js -->
	<script src="../user/assets/js/main.js"></script>


</body>
</html>

<?php
include $_SERVER['DOCUMENT_ROOT'] .'/SweetStream/session/session_delivery.php';
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';
$conn = new mysqli($host, $user, $password, $dbname);

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
        /* Sticky header styles */
        .top-header-area {
            position: sticky;  
            top: 0;           
            z-index: 1000;    
            background-color: #051922; 
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
        }
    

        .mean-container .mean-bar {
            margin-top:0px;
        }
        .main-menu a {
            color: #ffffff;
            padding: 10px 15px;
        }
        .main-menu a:hover {
            color: #f39c12;
        }
        .welcome-message {
            text-align: center;
            margin: 30px 0;
            font-size: 2rem; /* Larger font for main title */
            color: #333;
        }
      
        .table {
            background-color: #ffffff; /* White background for the table */
        }
        .thead-dark th {
            background-color: #051922; /* Dark background for the header */
            color: #ffffff; /* White text for the header */
        }
        .table td {
            vertical-align: middle; /* Align text vertically in the middle */
            padding: 15px; /* Increased padding for better spacing */
        }
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .welcome-message {
                font-size: 1.5rem; /* Smaller font size for mobile */
            }
            .table-responsive {
                overflow-x: auto; /* Allow horizontal scrolling */
            }
        }
        .badge {
            padding: 5px 10px; /* Padding for badges */
            border-radius: 5px; /* Rounded corners for badges */
        }
        .action-buttons {
            display: flex;
            gap: 5px; /* Space between buttons */
            justify-content: flex-start; /* Align buttons to the left */
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
                                <li class="current-list-item"><a href="task.php">Task</a></li>
                                <li><a href="order.php">Order</a></li>
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

    <?php
// SQL query to retrieve orders for the current delivery user, with products grouped by user_id and delivery_date_time
$sql = "
SELECT d.did, d.delivery_date_time, d.user_id, d.address, d.status,
       u.name AS customer_name, u.phone_no AS customer_phone,
       SUM(d.product_quantity) AS total_quantity,
       SUM(d.product_quantity * d.price) + 50 AS total_price,
       GROUP_CONCAT(CONCAT('<li>', p.pname, ' - ', d.product_quantity, ' liter','</li>') SEPARATOR '') AS products,
       d.payment_status
FROM delivery_table d
JOIN user_table u ON d.user_id = u.id
JOIN product_table p ON d.product_id = p.pid
WHERE d.deliveryperson_id = ? AND d.status IN ('Order Dispatched', 'Unreachable')
GROUP BY d.user_id, d.delivery_date_time
ORDER BY d.delivery_date_time DESC
";


// Prepare the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']); // Bind the logged-in user's ID
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    echo "Error executing query: " . $conn->error;
} elseif ($result->num_rows > 0) {
    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = [
            'order_id' => $row['did'],
            'customer_name' => $row['customer_name'],
            'address' => $row['address'],
            'products' => $row['products'],  // Grouped products as list items
            'total_quantity' => $row['total_quantity'],
            'total_price' => $row['total_price'],
            'payment_status' => $row['payment_status'],
            'status' => $row['status'],
            'order_date' => $row['delivery_date_time']
        ];
    }
} else {
    echo "<p></p>";
}
?>

<!-- Home Section -->
<div class="container">
    <div class="welcome-message">
        <h1>Deliveries</h1>
    </div>
    
    <div class="active-deliveries">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Address</th>
                        <th>Products</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Payment Status</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
    <?php if ($result->num_rows > 0): ?>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo $order['order_id']; ?></td>
                <td><?php echo $order['customer_name']; ?></td>
                <td><?php echo $order['address']; ?></td>
                <td>
                    <ul><?php echo $order['products']; ?></ul>
                </td>
                <td><?php echo $order['total_quantity']; ?></td>
                <td><?php echo '$' . number_format($order['total_price'], 2); ?></td>
                <td>
                    <strong class="<?php echo $order['payment_status'] == 'Paid' ? 'text-success' : 'text-danger'; ?>">
                        <?php echo ucfirst($order['payment_status']); ?>
                    </strong>
                </td>
                <td>
                    <?php
                        // Set badge class based on the status
                        $statusClass = '';
                        $statusText = '';
                        
                        if ($order['status'] == 'Order Dispatched') {
                            $statusClass = 'badge-warning'; // Orange for Order Dispatched
                            $statusText = 'Order Dispatched';
                        } elseif ($order['status'] == 'Unreachable') {
                            $statusClass = 'badge-danger'; // Red for Unreachable
                            $statusText = 'Unreachable';
                        } elseif ($order['status'] == 'Completed') {
                            $statusClass = 'badge-success'; // Green for Completed
                            $statusText = 'Completed';
                        }
                    ?>
                    <span class="badge <?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                </td>
                <td>
                    <div class="action-buttons">
                        <!-- Show buttons based on the current status -->
                        <?php if ($order['status'] != 'Completed'): ?>
                        <button id="deliveredBtn-<?php echo $order['order_id']; ?>" class="btn btn-outline-success btn-sm" onclick="updateStatus(<?php echo $order['order_id']; ?>, 'Delivered')">Delivered</button>
                        <?php endif; ?>

                        <?php if ($order['status'] != 'Unreachable'): ?>
                        <button id="unreachableBtn-<?php echo $order['order_id']; ?>" class="btn btn-outline-danger btn-sm" onclick="updateStatus(<?php echo $order['order_id']; ?>, 'Unreachable')">Unreachable</button>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="9" class="text-center">No orders with 'Order Dispatched' status found for your deliveries.</td>
        </tr>
    <?php endif; ?>
</tbody>

            </table>
        </div>
    </div>
</div>
<!-- End Home Section -->




<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirm Action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to mark this order as <span id="orderStatus"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmButton">Confirm</button>
            </div>
        </div>
    </div>
</div>


 


    
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
    
<script>
  let currentButton; // Store the button that was clicked
let currentStatus; // Store the status to be confirmed
let currentOrderId; // Store the order ID of the selected row

// Function to handle the click of the "Delivered" or "Unreachable" button
function updateStatus(orderId, status) {
    console.log("Update Status function triggered");
    console.log("Order ID:", orderId);
    console.log("Status:", status);

    // Store the button and status clicked
    currentOrderId = orderId;
    currentStatus = status;

    // Update the modal content with the correct status
    const orderStatusText = document.getElementById('orderStatus');
    orderStatusText.textContent = status === 'Delivered' ? 'Delivered' : 'Unreachable';

    console.log("Setting modal text to:", orderStatusText.textContent);

    // Show the confirmation modal
    $('#confirmationModal').modal('show');

    // Disable or enable buttons in the table row
    const rows = document.querySelectorAll('table tbody tr');
    rows.forEach(row => {
        const orderIdCell = row.querySelector('td:first-child'); // Assuming order_id is in the first column
        const deliveredButton = row.querySelector('button.btn-outline-success');
        const unreachableButton = row.querySelector('button.btn-outline-danger');

        if (orderIdCell && orderIdCell.textContent.trim() === String(currentOrderId)) {
            console.log("Matching row found. Order ID:", currentOrderId);

            // Disable the unreachable button and enable the delivered button
            if (status === 'Unreachable') {
                unreachableButton.disabled = true;  // Disable Unreachable button
                deliveredButton.disabled = false;  // Enable Delivered button
            } else if (status === 'Delivered') {
                deliveredButton.disabled = true;  // Disable Delivered button
                unreachableButton.disabled = false;  // Enable Unreachable button
            }
        }
    });
}

// Event listener for confirm button in modal
document.getElementById('confirmButton').addEventListener('click', function() {
    console.log("Confirm button clicked");

    // Perform AJAX call to update the status in the database
    fetch('update_delivery_status.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ 
            order_id: currentOrderId, 
            status: currentStatus 
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log("Response from server:", data);
        
        if (data.success) {
            console.log("Status update successful");

            // Successfully updated in the database; update the UI
            const rows = document.querySelectorAll('table tbody tr');
            rows.forEach(row => {
                const orderIdCell = row.querySelector('td:first-child'); // Assuming order_id is in the first column
                const statusCell = row.querySelector('td:nth-child(8) .badge');
                const deliveredButton = row.querySelector('button.btn-outline-success');
                const unreachableButton = row.querySelector('button.btn-outline-danger');
                
                if (orderIdCell && orderIdCell.textContent.trim() === String(currentOrderId)) {
                    console.log("Matching row found. Order ID:", currentOrderId);

                    // Update the status in the table row
                    if (currentStatus === 'Delivered') {
                        if (statusCell.textContent === 'Pending' || statusCell.textContent === 'Unreachable') {
                            console.log("Changing status to Completed for order ID:", currentOrderId);

                            // Change the status in the table row to 'Completed'
                            statusCell.classList.remove('badge-warning', 'badge-danger');
                            statusCell.classList.add('badge-success');
                            statusCell.textContent = 'Completed';
                            
                            // Disable the buttons
                            deliveredButton.disabled = true;
                            unreachableButton.disabled = true;
                        }
                    } else if (currentStatus === 'Unreachable') {
                        console.log("Changing status to Unreachable for order ID:", currentOrderId);

                        statusCell.classList.remove('badge-warning');
                        statusCell.classList.add('badge-danger');
                        statusCell.textContent = 'Unreachable';
                        
                        // Enable the Delivered button again for the row
                        deliveredButton.disabled = false;
                    }
                }
            });

            // Hide the modal after successful update
            $('#confirmationModal').modal('hide');
        } else {
            console.error('Failed to update status:', data.error || 'Unknown error');
            alert('Failed to update status: ' + (data.error || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error updating status:', error);
        alert('An error occurred. Please try again later.');
    });
});


</script>



</body>
</html>

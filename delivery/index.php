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
                                <li class="current-list-item"><a href="index.php">Home</a></li>
                                <li><a href="task.php">Task</a></li>
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

    <!-- Dashboard Section -->
    <div class="container mt-4">
        <h2 class="text-center welcome-message">Delivery Dashboard</h2>

        <div class="row mb-4">
            <!-- Total Deliveries Card -->
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card shadow border-0 rounded text-center">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Total Deliveries</h5>
                        <h2 id="totalDeliveries" class="display-4 font-weight-bold text-success">150</h2>
                    </div>
                </div>
            </div>
            <!-- Average Delivery Time Card -->
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card shadow border-0 rounded text-center">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Average Delivery Time</h5>
                        <h2 id="averageDeliveryTime" class="display-4 font-weight-bold text-warning">25 mins</h2>
                    </div>
                </div>
            </div>
            <!-- Total Pending Deliveries Card -->
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card shadow border-0 rounded text-center">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Pending Deliveries</h5>
                        <h2 id="pendingDeliveries" class="display-4 font-weight-bold text-danger">20</h2>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="text-center welcome-message">Delivery Trends</h3>
        <div class="row mb-4">
            <div class="col-lg-6 col-md-12 mb-3">
                <canvas id="deliveryTimeChart" height="300"></canvas>
            </div>
            <div class="col-lg-6 col-md-12 mb-3">
                <canvas id="deliveryStatusChart" height="300"></canvas>
            </div>
        </div>

        <h3 class="text-center welcome-message">Recent Deliveries</h3>
        <div class="table-responsive mb-4">
            <table class="table table-striped table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Delivery Status</th>
                        <th>Delivery Time</th>
                    </tr>
                </thead>
                <tbody id="recentDeliveries">
                    <tr>
                        <td>1</td>
                        <td>#001</td>
                        <td>John Doe</td>
                        <td><span class="badge badge-success">Delivered</span></td>
                        <td>20 mins</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>#002</td>
                        <td>Jane Smith</td>
                        <td><span class="badge badge-warning">Pending</span></td>
                        <td>15 mins</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>#003</td>
                        <td>Sam Wilson</td>
                        <td><span class="badge badge-danger">Unreachable</span></td>
                        <td>30 mins</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Charts Script -->
    <script>
        // Average Delivery Time Chart
        const ctx1 = document.getElementById('deliveryTimeChart').getContext('2d');
        const deliveryTimeChart = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Average Delivery Time (mins)',
                    data: [20, 25, 30, 22],
                    borderColor: '#f39c12',
                    backgroundColor: 'rgba(243, 156, 18, 0.2)',
                    borderWidth: 2,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#f39c12',
                    pointRadius: 5,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Average Delivery Time Over Weeks',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#e0e0e0',
                        },
                        ticks: {
                            color: '#333',
                        }
                    },
                    x: {
                        ticks: {
                            color: '#333',
                        }
                    }
                }
            }
        });

        // Delivery Status Chart
        const ctx2 = document.getElementById('deliveryStatusChart').getContext('2d');
        const deliveryStatusChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Delivered', 'Pending', 'Unreachable'],
                datasets: [{
                    label: 'Delivery Status',
                    data: [120, 20, 10],
                    backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Delivery Status Overview',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#e0e0e0',
                        },
                        ticks: {
                            color: '#333',
                        }
                    },
                    x: {
                        ticks: {
                            color: '#333',
                        }
                    }
                }
            }
        });
    </script>

	<!-- footer -->
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
		</div>
	</div>
	<!-- end footer -->
	
	<!-- copyright -->
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
	<!-- end copyright -->
	



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
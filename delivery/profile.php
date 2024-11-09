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
                                <li><a href="order.php">Order</a></li>
                                <li class="current-list-item"><a href="profile.php">Profile</a></li>
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
	
	<!-- profile section -->

	<?php

include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php'; // Include connection

$conn = new mysqli($host, $user, $password, $dbname); // Initialize connection

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user_id from session
$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    $query = "SELECT name, phone_no, email, address FROM user_table WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc(); // Fetch user data

    if (!$user) {
        echo "<script>alert('User not found');</script>";
    }
} else {
    echo "<script>alert('User not logged in');</script>";
}
?>



	<!-- profile section -->
	<div class="profile-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="profile-card shadow-lg p-4 rounded">
                    <div class="profile-info text-center">
                        <h3>Profile Information</h3>
                    </div>
                    <div class="profile-form">
					<form id="profile-form" method="post">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" 
                   value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" disabled>
        </div>
        <div class="form-group col-md-6">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" 
                   value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="phone">Phone Number:</label>
        <input type="text" class="form-control" id="phone" name="phone" 
               value="<?php echo htmlspecialchars($user['phone_no'] ?? ''); ?>" disabled>
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <textarea class="form-control" id="address" name="address" rows="3" disabled><?php echo htmlspecialchars($user['address'] ?? ''); ?></textarea>
    </div>
    <div class="button-group">
        <button type="button" class="btn btn-primary" id="edit-btn">Edit</button>
        <button type="button" class="btn btn-success" id="save-btn" style="display: none;">Save Changes</button>
        <button type="button" class="btn btn-danger" id="cancel-btn" style="display: none;">Cancel</button>
    </div>
</form>

                    </div>
                </div>
            </div>
			</div>
			</div>
			</div>
			
			<!-- end profile section -->

<!-- end profile section -->






    
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
$(function() {
    // Edit button functionality
    $("#edit-btn").click(function() {
        $("input, textarea").prop("disabled", false); // Enable inputs
        $("#edit-btn").hide();
        $("#save-btn, #cancel-btn").show();
    });

    // Cancel button functionality
    $("#cancel-btn").click(function() {
        $("input, textarea").prop("disabled", true); // Disable inputs
        $("#save-btn, #cancel-btn").hide();
        $("#edit-btn").show();
    });

    // Save button functionality with AJAX
    $("#save-btn").click(function() {
        const name = $("#name").val();
        const email = $("#email").val();
        const phone = $("#phone").val();
        const address = $("#address").val();

        $.ajax({
            type: "POST",
            url: "update_profile.php",
            data: {
                name: name,
                email: email,
                phone: phone,
                address: address
            },
            success: function(response) {
                alert(response); // Alert response message
                if (response.includes("successfully")) {
                    $("input, textarea").prop("disabled", true); // Disable inputs
                    $("#save-btn, #cancel-btn").hide();
                    $("#edit-btn").show();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error updating profile: " + errorThrown);
            }
        });
    });
});
</script>


</body>
</html>
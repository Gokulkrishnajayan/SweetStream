<?php
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/session/session_user.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Profile</title>
	
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
						<!-- logo -->
						
						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li><a href="index.php">Home</a></li>
								<li><a href="shop.php">Shop</a></li>
								<li><a href="order.php">Order</a></li>
								<li><a href="about.php">About</a></li>
								<li class="current-list-item"><a href="contact.php">Contact</a></li>
								<li><a href="profile.php">Profile</a></li>
								<li>
									<div class="header-icons">
										<a class="shopping-cart" href="cart.php"><i class="fas fa-shopping-cart"></i></a>
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
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>See more Details</p>
						<h1>Profile</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<?php
	// Include your database connection and session handling
	include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';

	// Create connection
	$conn = new mysqli($host, $user, $password, $dbname);

	// Fetch user data from the database
	$userId = $_SESSION['user_id']; // Assuming user_id is stored in the session
	$sql = "SELECT name, email, phone_no, address FROM user_table WHERE id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $userId);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows > 0) {
	    $user = $result->fetch_assoc();
	} else {
	    $user = []; // Fallback if no user is found
	}

	$stmt->close();
	$conn->close();
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
	                        <form id="profile-form">
	                            <div class="form-row">
	                                <div class="form-group col-md-6">
	                                    <label for="first-name">First Name:</label>
	                                    <input type="text" class="form-control" id="first-name" value="<?php echo htmlspecialchars(explode(' ', $user['name'])[0] ?? ''); ?>" disabled>
	                                </div>
	                                <div class="form-group col-md-6">
	                                    <label for="last-name">Last Name:</label>
	                                    <input type="text" class="form-control" id="last-name" value="<?php echo htmlspecialchars(explode(' ', $user['name'])[1] ?? ''); ?>" disabled>
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <label for="email">Email:</label>
	                                <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" disabled>
	                            </div>
	                            <div class="form-group">
	                                <label for="phone">Phone Number:</label>
	                                <input type="text" class="form-control" id="phone" value="<?php echo htmlspecialchars($user['phone_no'] ?? ''); ?>" disabled>
	                            </div>
	                            <div class="form-group">
	                                <label for="address">Address:</label>
	                                <textarea class="form-control" id="address" rows="3" disabled><?php echo htmlspecialchars($user['address'] ?? ''); ?></textarea>
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

	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<script>
	$(document).ready(function() {
	    $("#edit-btn").click(function() {
	        $("input, textarea").prop("disabled", false);
	        $("#save-btn, #cancel-btn").show();
	        $(this).hide();
	    });

	    $("#cancel-btn").click(function() {
	        $("input, textarea").prop("disabled", true);
	        $("#save-btn, #cancel-btn").hide();
	        $("#edit-btn").show();
	    });

	    $("#save-btn").click(function() {
	        const firstName = $("#first-name").val();
	        const lastName = $("#last-name").val();
	        const email = $("#email").val();
	        const phone = $("#phone").val();
	        const address = $("#address").val();

	        $.ajax({
	            type: "POST",
	            url: "update_profile.php", // Update this with the correct path to your update script
	            data: {
	                first_name: firstName,
	                last_name: lastName,
	                email: email,
	                phone: phone,
	                address: address
	            },
	            success: function(response) {
	                alert("Profile updated successfully!");
	                $("input, textarea").prop("disabled", true);
	                $("#save-btn, #cancel-btn").hide();
	                $("#edit-btn").show();
	            },
	            error: function() {
	                alert("Error updating profile. Please try again.");
	            }
	        });
	    });
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
					<p>Copyrights &copy; 2019 - <a href="https://imransdesign.com/">Imran Hossain</a>, All Rights Reserved.</p>
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
	<!-- other scripts -->
	<script src="assets/js/main.js"></script>

</body>
</html>

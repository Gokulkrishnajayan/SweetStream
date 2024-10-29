<?php
// Include your database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/session/session_user.php';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data from the database
$userId = $_SESSION['user_id']; // Assuming user_id is stored in the session
$sql = "SELECT name, email, phone_no, address FROM user_table WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    
    <!-- Include styles -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>    
    <!-- Header -->
    <div class="top-header-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 text-center">
                    <div class="main-menu-wrap">
                        <div class="site-logo">
                            <a href="#"><h3 class="orange-text">SweetStream</h3></a>
                        </div>
                        <nav class="main-menu">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="shop.php">Shop</a></li>
                                <li><a href="order.php">Order</a></li>
                                <li><a href="about.php">About</a></li>
                                <li><a href="contact.php">Contact</a></li>
                                <li class="current-list-item"><a href="profile.php">Profile</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Section -->
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
                                        <input type="text" class="form-control" id="first-name" value="<?php echo htmlspecialchars(explode(' ', $user['name'])[0]); ?>" disabled>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="last-name">Last Name:</label>
                                        <input type="text" class="form-control" id="last-name" value="<?php echo htmlspecialchars(explode(' ', $user['name'])[1]); ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number:</label>
                                    <input type="text" class="form-control" id="phone" value="<?php echo htmlspecialchars($user['phone_no']); ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address:</label>
                                    <textarea class="form-control" id="address" rows="3" disabled><?php echo htmlspecialchars($user['address']); ?></textarea>
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
    <!-- End Profile Section -->

    <!-- Footer -->
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <h2>About us</h2>
                    <p>Short description about the website.</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h2>Get in Touch</h2>
                    <ul>
                        <li>34/8, East Hukupara, Gifirtok, Sadan.</li>
                        <li>support@sweetstream.com</li>
                        <li>+00 111 222 3333</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-1.11.3.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
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
                // Add AJAX to save changes here
                alert("Save changes functionality needs to be implemented.");
            });
        });
    </script>
</body>
</html>

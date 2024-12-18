<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SweetStream - Payasam selling website</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top shadow-sm py-3 py-lg-0 px-3 px-lg-0"  >
        <a href="index.html" class="navbar-brand d-block d-lg-none">
            <h1 class="m-0 text-uppercase text-white">
                <i class="fa fa-birthday- fs-1 text-primary me-3"></i>SweetStream
            </h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto mx-lg-auto py-0">
                <a href="#home" class="nav-item nav-link ">Home</a>
                <a href="#menu" class="nav-item nav-link">Menu & Pricing</a>
                <a href="#about" data-target="container" class="nav-item nav-link">About Us</a>
                <a href="#contact" class="nav-item nav-link">Contact Us</a>
                <a href="login.html" class="nav-item nav-link">Login</a>
            </div>
        </div>
    </nav> 
    <!-- Navbar End -->


    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 mb-5 hero-header scroll-to"  id="home">
        <div class="container py-5" >
            <div class="row ">
                <div class="col-lg-8 text-center text-lg-start">
                    <h1 class="font-secondary text-primary mb-4">SweetStream</h1>
                    <h1 class="display-1 text-uppercase text-white mb-4">Payasam Zone</h1>
                    <h1 class="text-uppercase text-white">The Best Payasam you</h1>
                    <h1 class="text-uppercase text-white">would ever taste</h1>
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-start pt-5">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


<?php
// Database connection
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';
$conn = new mysqli($host, $user, $password, $dbname);

// Check if the connection failed
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM product_table";
$result = $conn->query($sql);
?>
<!-- Products Start -->
<div class="container-fluid about py-2 mb-2 scroll-to" id="menu">
    <div class="container">
        <div class="section-title position-relative text-center mx-auto mb-5 pb-3">
            <h1 class="display-4 text-uppercase">Explore Our Payasam</h1>
        </div>
        <div class="tab-class text-center">
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-3">
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                ?>
                                <div class="col-lg-6">
                                    <div class="d-flex h-100">
                                        <div class="flex-shrink-0">
                                            <img class="img-fluid" src="<?php echo $row['pphoto']; ?>" alt=""
                                                style="width: 150px; height: 85px;">
                                            <h4 class="bg-dark text-primary p-2 m-0">$<?php echo $row['pprice']; ?></h4>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center text-start bg-secondary border-inner px-4">
                                            <h5 class="text-uppercase"><?php echo $row['pname']; ?></h5>
                                            <span><?php echo $row['pdescription']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "No products available.";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Products End -->

<?php
$conn->close();
?>


    <!-- About Start -->
    <div class="container-fluid py-0  mt-4 scroll-to" id="about">
        <div class="container">
            <div class="section-title position-relative text-center mx-auto mb-2 pb-3" >
                <h1 class="display-4 text-uppercase">Welcome To Sweet Stream</h1>
            </div>
            <div class="row gx-5">
                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/img1.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 pb-5">
                    <h4 class="mb-4">Tempor erat elitr rebum clita. Diam dolor diam ipsum erat lorem sed stet labore
                        lorem sit clita duo</h4>
                    <p class="mb-5">Tempor erat elitr at rebum at at clita. Diam dolor diam ipsum et tempor sit. Clita
                        erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor
                        eirmod magna dolore erat amet magna</p>
                    <div class="row g-5">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center justify-content-center bg-primary border-inner mb-4"
                                style="width: 90px; height: 90px;">
                                <i class="fa fa-heartbeat fa-2x text-white"></i>
                            </div>
                            <h4 class="text-uppercase">100% Healthy</h4>
                            <p class="mb-0">Labore justo vero ipsum sit clita erat lorem magna clita nonumy dolor magna
                                dolor vero</p>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center justify-content-center bg-primary border-inner mb-4"
                                style="width: 90px; height: 90px;">
                                <i class="fa fa-award fa-2x text-white"></i>
                            </div>
                            <h4 class="text-uppercase">Award Winning</h4>
                            <p class="mb-0">Labore justo vero ipsum sit clita erat lorem magna clita nonumy dolor magna
                                dolor vero</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Facts Start -->
    <div class="container-fluid bg-img py-2 mb-5">
        <div class="container py-5">
            <div class="row gx-5 gy-4">
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex">
                        <div class="bg-primary border-inner d-flex align-items-center justify-content-center mb-3"
                            style="width: 60px; height: 60px;">
                            <i class="fa fa-star text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h6 class="text-primary text-uppercase">Our Experience</h6>
                            <h1 class="display-5 text-white mb-0" data-toggle="counter-up">12345</h1>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="d-flex">
                        <div class="bg-primary border-inner d-flex align-items-center justify-content-center mb-3"
                            style="width: 60px; height: 60px;">
                            <i class="fa fa-check text-white"></i>
                        </div>
                        <div class="ps-3">
                            <h6 class="text-primary text-uppercase">Complete Orders</h6>
                            <h1 class="display-5 text-white mb-0" data-toggle="counter-up">12345</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex">
                        <div class="bg-primary border-inner d-flex align-items-center justify-content-center mb-3"
                            style="width: 60px; height: 60px;">
                            <i class="fa fa-mug-hot text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h6 class="text-primary text-uppercase">Happy Clients</h6>
                            <h1 class="display-5 text-white mb-0" data-toggle="counter-up">12345</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->

    <!-- Contact Start -->
    <div class="container-fluid contact position-relative px-5 scroll-to"  id="contact">
        <div class="container">
            <div class="row g-5 mb-5 justify-content-center">
                <div class="col-lg-4 col-md-6 justify-content-center">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <i class="bi bi-geo-alt fs-1 text-white"></i>
                        <h6 class="text-uppercase my-2">Our Office</h6>
                        <span>Njallikkatile ,Navodaya</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <i class="bi bi-envelope-open fs-1 text-white"></i>
                        <h6 class="text-uppercase my-2">Email Us</h6>
                        <span>info@example.com</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <i class="bi bi-phone-vibrate fs-1 text-white"></i>
                        <h6 class="text-uppercase my-2">Call Us</h6>
                        <span>+012 345 6789</span>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <input type="text" class="form-control bg-light border-0 px-4" placeholder="Your Name"
                                    style="height: 55px;">
                            </div>
                            <div class="col-sm-6">
                                <input type="email" class="form-control bg-light border-0 px-4" placeholder="Your Email"
                                    style="height: 55px;">
                            </div>
                            <div class="col-sm-12">
                                <input type="text" class="form-control bg-light border-0 px-4" placeholder="Subject"
                                    style="height: 55px;">
                            </div>
                            <div class="col-sm-12">
                                <textarea class="form-control bg-light border-0 px-4 py-3" rows="4"
                                    placeholder="Message"></textarea>
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary border-inner w-100 py-3" type="submit">Send
                                    Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->





    <!-- Footer Start -->
    <div class="container-fluid bg-img text-secondary">
        <div class="container">
            <div class="row gx-5">

                <div class="col-lg-8 col-md-6">
                    <div class="row gx-5">
                        <div class="col-lg-4 col-md-12 pt-5 mb-5">
                            <h4 class="text-primary text-uppercase mb-4">Get In Touch</h4>
                            <div class="d-flex mb-2">
                                <i class="bi bi-geo-alt text-primary me-2"></i>
                                <p class="mb-0">Njallikkatile ,Navodaya</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-envelope-open text-primary me-2"></i>
                                <p class="mb-0">info@example.com</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-telephone text-primary me-2"></i>
                                <p class="mb-0">+012 345 67890</p>
                            </div>
                            <div class="d-flex mt-4">
                                <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 me-2" href="#"><i
                                        class="fab fa-twitter fw-normal"></i></a>
                                <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 me-2" href="#"><i
                                        class="fab fa-facebook-f fw-normal"></i></a>
                                <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 me-2" href="#"><i
                                        class="fab fa-linkedin-in fw-normal"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                            <h4 class="text-primary text-uppercase mb-4">Quick Links</h4>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-secondary mb-2" href="#"
                                    class="bi bi-arrow-right text-primary me-2">Home</a>
                                <a class="text-secondary mb-2" href="#menu"
                                    class="bi bi-arrow-right text-primary me-2">Menu & Pricing</a>
                                <a class="text-secondary mb-2" href="#about"
                                    class="bi bi-arrow-right text-primary me-2">About Us</a>
                                <a class="text-secondary mb-2" href="#contact"
                                    class="bi bi-arrow-right text-primary me-2">Contact Us</a>
                                <a class="text-secondary mb-2" href="login.html"
                                    class="bi bi-arrow-right text-primary me-2">Login</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                            <h4 class="text-primary text-uppercase mb-4">Newsletter</h4>
                            <p>Amet justo diam dolor rebum lorem sit stet sea justo kasd</p>
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control border-white p-3" placeholder="Your Email">
                                    <button class="btn btn-primary">Sign Up</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-secondary py-4" style="background: #111111;">
        <div class="container text-center">
            <p class="mb-0">&copy; <a class="text-white border-bottom" href="#">SweetStream</a>. All Rights Reserved.
                Designed by <a class="text-white border-bottom">GKJ Production</a></p>
            <br>Distributed By: <a class="border-bottom" target="_blank">Dragon house</a>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-inner py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/session/session_user.php';
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db.php';

// Get the current user's ID from the session
$userId = $_SESSION['user_id'];

// Fetch user data from the database
$stmt = $pdo->prepare("SELECT name, phone_no, email, address FROM user_table WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// If no user found, handle the error (optional)
if (!$user) {
    echo "User not found.";
    exit();
}
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
    <title>Check Out</title>

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

    <style>
        .styled-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 25px;
            padding: 6px 15px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.1s;
            margin: 10px 5px;
            display: inline-block;
            text-align: center;
        }

        .styled-btn:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        .styled-btn:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 128, 0, 0.5);
        }

        .button-group {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
        }



        .order-item {
            display: flex;
            /* Use flexbox for layout */
            align-items: flex-start;
            /* Align items at the top */
            margin-bottom: 15px;
            /* Space between items */
        }

        .product-image {
            width: 120px;
            /* Set a fixed width for uniformity */
            height: auto;
            /* Height auto to maintain aspect ratio */
            overflow: hidden;
            /* Hide overflow outside the frame */
            display: flex;
            /* Use flexbox to center content */
            align-items: center;
            /* Center image vertically */
            justify-content: center;
            /* Center image horizontally */
            margin-right: 15px;
            /* Space between image and text */
            background-color: #f9f9f9;
            /* Optional: background for smaller images */
            border-radius: 8px;
            /* Optional: rounded corners */
        }

        .product-image img {
            max-width: 100%;
            /* Ensure image does not exceed frame width */
            max-height: 100%;
            /* Ensure image does not exceed frame height */
            width: auto;
            /* Maintain natural width */
            height: auto;
            /* Maintain natural height */
            object-fit: cover;
            /* Fit the image to cover the entire frame */
            object-position: center;
            /* Center the image within the frame */
        }

        .product-details {
            flex-grow: 1;
            /* Allow details to take remaining space */
        }

        .product-details h6 {
            margin: 0;
            /* Remove default margin */
            font-size: 16px;
            /* Font size for product name */
            font-weight: 600;
            /* Bold product name */
        }

        .product-details p {
            margin: 5px 0;
            /* Spacing between paragraphs */
            font-size: 14px;
            /* Font size for details */
            color: #555;
            /* Color for the text */
        }




        .card-body {
            padding: 20px;
        }

        .payment-method {
            margin-bottom: 20px;
        }

        .payment-option {
            margin-bottom: 15px;
        }

        .payment-option label {
            display: flex;
            align-items: center;
        }

        .payment-option input[type="radio"] {
            margin-right: 10px;
            cursor: pointer;
        }

        .card-details {
            border: 1px solid #e0e0e0;
            /* Light border for the card details section */
            padding: 20px;
            border-radius: 8px;
            /* Rounded corners */
            background-color: #f9f9f9;
            /* Light background */
        }

        .card-details .form-group {
            margin-bottom: 15px;
            /* Spacing between inputs */
        }

        .card-details input[type="text"] {
            width: 100%;
            /* Full width */
            padding: 10px;
            /* Padding for input */
            border: 1px solid #ccc;
            /* Light border */
            border-radius: 4px;
            /* Rounded corners */
        }

        .submit-button {
            margin-top: 20px;
            /* Space above the button */
        }

        .boxed-btn {
            background-color: #007bff;
            /* Button color */
            color: white;
            /* Text color */
            padding: 10px 20px;
            /* Button padding */
            border: none;
            /* No border */
            border-radius: 4px;
            /* Rounded corners */
            cursor: pointer;
            /* Pointer on hover */
        }

        .boxed-btn:hover {
            background-color: #0056b3;
            /* Darker shade on hover */
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
                                <li><a href="shop.php">Shop</a></li>
                                <li><a href="order.php">Order</a></li>
                                <li><a href="about.php">About</a></li>
                                <li><a href="contact.php">Contact</a></li>
                                <li><a href="profile.php">Profile</a></li>
                                <li>
                                    <div class="header-icons">
                                        <a class="shopping-cart" href="cart.php"><i
                                                class="fas fa-shopping-cart"></i></a>
                                        <a class="mobile-hide search-bar-icon" href="#"><i
                                                class="fas fa-search"></i></a>
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
    <!-- end search arewa -->

    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Fresh and Organic</p>
                        <h1>Check Out Product</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- Check Out Section -->
    <div class="checkout-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-accordion-wrap">
                        <div class="accordion" id="accordionExample">
                            <div class="card single-accordion">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Billing Address
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="billing-address-form">
                                            <form action="update_delivery_address.php" method="POST">
                                                <p>
                                                    <input type="text" name="name" id="name"
                                                        value="<?php echo htmlspecialchars($user['name']); ?>"
                                                        placeholder="Name" readonly>
                                                </p>
                                                <p>
                                                    <input type="email" name="email" id="email"
                                                        value="<?php echo htmlspecialchars($user['email']); ?>"
                                                        placeholder="Email" readonly>
                                                </p>
                                                <p>
                                                    <input type="text" name="address" id="address"
                                                        value="<?php echo htmlspecialchars($user['address']); ?>"
                                                        placeholder="Delivery Address" readonly>
                                                </p>
                                                <p>
                                                    <input type="tel" name="phone_no" id="phone_no"
                                                        value="<?php echo htmlspecialchars($user['phone_no']); ?>"
                                                        placeholder="Phone Number" readonly>
                                                </p>
                                                <div class="button-group">
                                                    <button type="button" id="edit-btn"
                                                        class="boxed-btn">Change</button>
                                                    <button type="submit" id="save-btn" class="boxed-btn"
                                                        style="display: none;">Save</button>

                                                </div>
                                            </form>
                                        </div>

                                        <script>
                                            // JavaScript to toggle the readonly state
                                            const editBtn = document.getElementById('edit-btn');
                                            const saveBtn = document.getElementById('save-btn');
                                            const fields = ['address', 'phone_no'];

                                            editBtn.addEventListener('click', () => {
                                                fields.forEach(fieldId => {
                                                    document.getElementById(fieldId).readOnly = false;
                                                });
                                                editBtn.style.display = 'none'; // Hide the 'Change' button
                                                saveBtn.style.display = 'inline-block'; // Show the 'Save' button
                                            });
                                        </script>
                                        <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                                        <p style="color: green;">Delivery address updated successfully!</p>
                                        <?php elseif (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
                                        <p style="color: red;">Failed to update the address. Please try again.</p>
                                        <?php endif;?>



                                    </div>
                                </div>
                            </div>

                            <div class="card single-accordion">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            Order Summary
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <?php
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db.php';

// Fetch cart items for the logged-in user
$user_id = $_SESSION['user_id'] ?? 0;
$stmt = $pdo->prepare("
                SELECT c.quantity, p.pid, p.pname, p.pprice, p.pphoto
                FROM cart_table c
                JOIN product_table p ON c.product_id = p.pid
                WHERE c.user_id = ?
            ");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll();

$grand_total = 0; // Initialize total amount
$shipping = 50; // Fixed shipping cost

if (empty($cart_items)) {
    echo "<p>Your cart is empty.</p>";
} else {
    foreach ($cart_items as $item) {
        $quantity = $item['quantity'];
        $total_price = $item['pprice'] * $quantity;
        $grand_total += $total_price; // Accumulate grand total
        ?>
                <div class="order-item">
                    <div class="product-image">
                        <img src="<?php echo htmlspecialchars($item['pphoto']); ?>"
                            alt="<?php echo htmlspecialchars($item['pname']); ?>">
                    </div>
                    <div class="product-details">
                        <h6>
                            <?php echo htmlspecialchars($item['pname']); ?>
                        </h6>
                        <p>Price: ₹
                            <?php echo number_format($item['pprice'], 2); ?>
                        </p>
                        <p>Quantity:
                            <?php echo $quantity; ?>
                        </p>
                        <?php if ($quantity > 1): ?>
                        <p>Combined Price: ₹
                            <?php echo number_format($total_price, 2); ?>
                        </p>
                        <?php endif;?>
                    </div>
                </div>
                <hr>
                <?php
}
}
?>
<?php
 $grand_total+=$shipping;
?>

                                        <!-- Hidden input to pass the total amount to JavaScript -->
                                        <input type="hidden" id="phpGrandTotal" value="<?php echo $grand_total; ?>">

                                    </div>
                                </div>
                            </div>




                           <div class="card single-accordion">
    <div class="card-header" id="headingThree">
        <h5 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Payment Options
            </button>
        </h5>
    </div>

    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
        <div class="card-body">
            <form id="paymentForm" action="process_payment.php" method="POST">
                <!-- Total Amount Display -->
<div class="total-amount">
    <h5>Total Amount: ₹<span id="totalAmount"><?php echo number_format($grand_total); ?></span></h5>
    <input type="hidden" name="total_amount" id="totalAmountInput" value="<?php echo $grand_total; ?>">
</div>


                <div class="payment-method">
                    <h6>Select Payment Method:</h6>

                    <!-- Payment Options -->
                    <div class="payment-option">
                        <label>
                            <input type="radio" name="payment_method" value="credit_card" checked>
                            <span>Credit/Debit Card</span>
                        </label>
                    </div>
                    <div class="payment-option">
                        <label>
                            <input type="radio" name="payment_method" value="net_banking">
                            <span>Net Banking</span>
                        </label>
                    </div>
                    <div class="payment-option">
                        <label>
                            <input type="radio" name="payment_method" value="upi">
                            <span>UPI</span>
                        </label>
                    </div>
                    <div class="payment-option">
                        <label>
                            <input type="radio" name="payment_method" value="cash_on_delivery">
                            <span>Cash on Delivery</span>
                        </label>
                    </div>
                </div>

                <!-- Card Details -->
                <div class="card-details" id="cardDetails">
                    <h6>Enter Card Details:</h6>
                    <input type="text" name="card_number" placeholder="Card Number" required>
                    <input type="text" name="card_holder" placeholder="Card Holder Name" required>
                    <input type="text" name="expiry_date" placeholder="MM/YY" required>
                    <input type="text" name="cvv" placeholder="CVV" required>
                </div>

                <!-- Net Banking Section -->
                <div class="bank-options" id="bankOptions" style="display: none;">
                    <h6>Select Your Bank:</h6>
                    <select name="bank_name" required>
                        <option value="sbi">State Bank of India</option>
                        <option value="hdfc">HDFC Bank</option>
                        <option value="icici">ICICI Bank</option>
                        <option value="axis">Axis Bank</option>
                    </select>
                </div>

                <!-- UPI Section -->
                <div class="upi-details" id="upiDetails" style="display: none;">
                    <h6>Enter UPI ID:</h6>
                    <input type="text" name="upi_id" placeholder="Enter your UPI ID" required>
                </div>

                <!-- Buttons -->
                <div class="submit-buttons">
                    <button type="button" id="payBtn" class="boxed-btn">Pay Now</button>
                    <button type="submit" id="orderBtn" class="boxed-btn" style="display: none;">Place Order</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const paymentForm = document.getElementById('paymentForm');

    // Validation function
    function validateBillingInfo() {
        const name = document.getElementById('name').value.trim();
        const address = document.getElementById('address').value.trim();
        const phone_no = document.getElementById('phone_no').value.trim();

        if (!name || !address || !phone_no) {
            alert("Please fill in all billing address fields.");
            return false;
        }

        // Validate phone number length
        if (phone_no.length !== 10 || isNaN(phone_no)) {
            alert("Phone number must be exactly 10 digits.");
            return false;
        }

        return true;
    }

    // Add event listeners for payment method radio buttons
    document.querySelectorAll('input[name="payment_method"]').forEach((elem) => {
        elem.addEventListener("change", function (event) {
            const cardDetails = document.getElementById("cardDetails");
            const bankOptions = document.getElementById("bankOptions");
            const upiDetails = document.getElementById("upiDetails");
            const payBtn = document.getElementById("payBtn");
            const orderBtn = document.getElementById("orderBtn");

            // Hide all sections initially
            cardDetails.style.display = "none";
            bankOptions.style.display = "none";
            upiDetails.style.display = "none";

            // Show relevant section based on the selected payment method
            switch (event.target.value) {
                case "credit_card":
                    cardDetails.style.display = "block";
                    payBtn.style.display = "block";
                    orderBtn.style.display = "none";
                    break;
                case "net_banking":
                    bankOptions.style.display = "block";
                    payBtn.style.display = "block";
                    orderBtn.style.display = "none";
                    break;
                case "upi":
                    upiDetails.style.display = "block";
                    payBtn.style.display = "block";
                    orderBtn.style.display = "none";
                    break;
                case "cash_on_delivery":
                    payBtn.style.display = "none";
                    orderBtn.style.display = "block";
                    break;
            }
        });
    });

    // Display the total amount on page load
    document.addEventListener("DOMContentLoaded", function () {
        const phpGrandTotalElement = document.getElementById('phpGrandTotal');
        if (phpGrandTotalElement) {
            const phpGrandTotal = parseFloat(phpGrandTotalElement.value) || 0;
            document.getElementById('totalAmount').textContent = phpGrandTotal.toFixed(2);
        } else {
            console.error("PHP Grand Total element not found.");
        }
    });

    // Handle Pay Now button click
    document.getElementById('payBtn').addEventListener('click', function () {
        if (!validateBillingInfo()) return; // Validate before processing payment

        const currentTotalAmount = parseFloat(document.getElementById('totalAmount').textContent) || 0;
        alert(`Processing payment of ₹${currentTotalAmount.toFixed(2)}...`);

        // Simulate payment processing delay
        setTimeout(() => {
            alert('Payment successful! Placing order...');
            paymentForm.submit(); // Automatically submit the form
        }, 2000); // 2-second delay for demo purposes
    });

    // Handle form submission directly when "Cash on Delivery" is selected
    document.getElementById('orderBtn').addEventListener('click', function () {
        if (!validateBillingInfo()) return; // Validate before placing order
        alert('Placing order with Cash on Delivery...');
        paymentForm.submit();
    });
</script>

<style>
    .total-amount {
        margin-bottom: 20px;
        font-weight: bold;
    }

    .card-body {
        padding: 20px;
    }

    .payment-method {
        margin-bottom: 20px;
    }

    .payment-option {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .payment-option input[type="radio"] {
        margin-right: 10px;
        cursor: pointer;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .card-details,
    .bank-options,
    .upi-details {
        border: 1px solid #e0e0e0;
        padding: 20px;
        border-radius: 8px;
        background-color: #f9f9f9;
        margin-bottom: 20px;
    }

    .submit-buttons {
        display: flex;
        gap: 10px;
    }

    /* Button-specific styles */
    button.boxed-btn {
        -webkit-transition: 0.3s;
  -o-transition: 0.3s;
  transition: 0.3s;
  border-radius: 50px;
  font-family: 'Poppins', sans-serif;
  display: inline-block;
  background-color: #F28123;
  color: #fff;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
    }

    button.boxed-btn:hover {  
        background-color: #051922;
        color: #F28123;
    }
</style>





                        </div> <!-- Accordion End -->
                    </div> <!-- Checkout Accordion Wrap End -->
                </div>




                <div class="col-lg-4">
                    <div class="order-details-wrap">
                        <table class="order-details">
                            <thead>
                                <tr>
                                    <th>Your Order Details</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody class="order-details-body">
                                <?php
$grand_total = 0;
$shipping = 50; // Fixed shipping cost

if (empty($cart_items)): ?>
                                    <tr>
                                        <td colspan="2" class="text-center">Your cart is empty.</td>
                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        <td>Product</td>
                                        <td>Total</td>
                                    </tr>

                                    <?php
foreach ($cart_items as $item):
    $quantity = $item['quantity'];
    $total_price = $item['pprice'] * $quantity;
    $grand_total += $total_price;
    ?>
	                                    <tr>
	                                        <td><?php echo htmlspecialchars($item['pname']); ?> (x<?php echo $quantity; ?>)</td>
	                                        <td>₹<?php echo number_format($total_price, 2); ?></td>
	                                    </tr>
	                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>

                            <?php if (!empty($cart_items)): ?>
                            <tbody class="checkout-details">
                                <tr>
                                    <td>Subtotal</td>
                                    <td>₹<?php echo number_format($grand_total, 2); ?></td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td>₹<?php echo number_format($shipping, 2); ?></td>
                                </tr>
                                <tr>
                                    <td>Grand Total</td>
                                    <td>₹<?php echo number_format($grand_total + $shipping, 2); ?></td>
                                </tr>
                            </tbody>
                            <?php endif;?>
                        </table>
                    </div>
                </div>





            </div>
        </div>
    </div>
    <!-- End Check Out Section -->











    <!-- logo carousel -->
    <div class="logo-carousel-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="logo-carousel-inner">
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/1.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/2.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/3.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/4.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/5.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end logo carousel -->

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
        </div>
    </div>
    <!-- end footer -->

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
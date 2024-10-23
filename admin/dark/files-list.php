<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="favicon.ico">
  <title>Tiny Dashboard - A Bootstrap Dashboard Template</title>
  <!-- Simple bar CSS -->
  <link rel="stylesheet" href="css/simplebar.css">
  <!-- Fonts CSS -->
  <link
    href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <!-- Icons CSS -->
  <link rel="stylesheet" href="css/feather.css">
  <!-- Date Range Picker CSS -->
  <link rel="stylesheet" href="css/daterangepicker.css">
  <!-- App CSS -->
  <link rel="stylesheet" href="css/app-light.css" id="lightTheme" disabled>
  <link rel="stylesheet" href="css/app-dark.css" id="darkTheme">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    /* Product Card Styling */
    .product-card {
        border-radius: 10px;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    /* Aspect Ratio Control */
    .ratio-4-3 {
        position: relative;
        width: 100%;
        padding-bottom: 75%; /* 4:3 ratio (3/4 * 100) */
        overflow: hidden;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .ratio-4-3 img {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensures proper aspect ratio */
        object-position: center; /* Aligns the image to the center */
        transform: translate(-50%, -50%);
    }

    /* Stock Badge Styling */
    .stock-badge {
        top: 10px;
        right: 10px;
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 30px;
        background-color: rgba(255, 0, 0, 0.8); /* Optional: Add background color */
        color: white; /* Optional: Change text color */
    }

    /* Truncate Long Text */
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Typography */
    .price {
        font-size: 18px;
        font-weight: 600;
    }
</style>



</head>


<body class="vertical  dark  ">
  <div class="wrapper">
    <!-- nav bar -->
    <nav class="topnav navbar navbar-light">
      <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
      </button>
      <form class="form-inline mr-auto searchform text-muted">
        <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search"
          placeholder="Type something..." aria-label="Search">
      </form>
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="dark">
            <i class="fe fe-sun fe-16"></i>
          </a>
        </li>
        <li class="nav-item nav-notif">
          <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
            <span class="fe fe-bell fe-16"></span>
            <span class="dot dot-md bg-success"></span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="avatar avatar-sm mt-2">
              <img src="./assets/avatars/face-1.jpg" alt="..." class="avatar-img rounded-circle">
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Profile</a>
            <a class="dropdown-item" href="#">Logout</a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- nav bar end -->


    <!-- side nav bar -->
    <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
      <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
      </a>
      <nav class="vertnav navbar navbar-light">

        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
          <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
            <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
              <g>
                <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
              </g>
            </svg>
          </a>
        </div>
        <ul class="navbar-nav flex-fill w-100 mb-2">
          <li class="nav-item dropdown">
            <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fe fe-home fe-16"></i>
              <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
            </a>
            <ul class="collapse list-unstyled pl-4 w-100" id="dashboard">
              <li class="nav-item active">
                <a class="nav-link pl-3" href="./index.html"><span class="ml-1 item-text">Default</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link pl-3" href="./dashboard-analytics.html"><span
                    class="ml-1 item-text">Analytics</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link pl-3" href="./dashboard-sales.html"><span
                    class="ml-1 item-text">E-commerce</span></a>
              </li>

            </ul>
          </li>
        </ul>
        <p class="text-muted nav-heading mt-4 mb-1">
          <span>Components</span>
        </p>

        <ul class="navbar-nav flex-fill w-100 mb-2">
          <li class="nav-item w-100">
            <a class="nav-link" href="page-orders.html">
              <i class="fe fe-shopping-cart fe-16"></i>
              <span class="ml-3 item-text">Order</span>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav flex-fill w-100 mb-2">
          <li class="nav-item w-100">
            <a class="nav-link" href="contacts-list.html">
              <i class="fe fe-user fe-16"></i>
              <span class="ml-3 item-text">User</span>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav flex-fill w-100 mb-2">
          <li class="nav-item w-100">
            <a class="nav-link" href="files-list.html">
              <i class="fe fe-shopping-bag fe-16"></i>
              <span class="ml-3 item-text">Products</span>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav flex-fill w-100 mb-2">
          <li class="nav-item w-100">
            <a class="nav-link" href="files-grid.html">
              <i class="fe fe-database fe-16"></i>
              <span class="ml-3 item-text">Inventory</span>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav flex-fill w-100 mb-2">
          <li class="nav-item w-100">
            <a class="nav-link" href="support-tickets.html">
              <i class="fe fe-truck fe-16"></i>
              <span class="ml-3 item-text">Delivery</span>
            </a>
          </li>
        </ul>

        </ul>
      </nav>
    </aside>
    <!-- side nav bar end -->

    <?php
include '../../php/db_withcon.php'; // Include database connection

// Fetch products from the database
$sql = "SELECT pid, pname, pphoto, pdescription, pprice, current_stock FROM product_table";
$result = $conn->query($sql);
?>

<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10">
        <div class="row align-items-center my-4">
          <div class="col">
            <h2 class="page-title">Products</h2>
          </div>
          <div class="col-auto">
            <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#addProductModal">
              <span class="fe fe-plus fe-16 mr-2"></span>New Product
            </button>
          </div>
        </div>

        <h6 class="mb-4">Explore Our Products</h6>

        <div class="row">
          <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
              <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card product-card h-100 border-0 shadow-sm">
                  <div class="card-img-wrapper ratio-4-3 position-relative">
                    <img src="/SweetStream/<?php echo htmlspecialchars($row['pphoto']); ?>" 
                         alt="<?php echo htmlspecialchars($row['pname']); ?>" 
                         class="card-img-top" loading="lazy">
                    <?php if ($row['current_stock'] <= 5): ?>
                      <span class="badge badge-danger position-absolute stock-badge">Low Stock</span>
                    <?php endif; ?>
                  </div>

                  <div class="card-body d-flex flex-column p-4">
                    <h5 class="card-title text-truncate"><?php echo htmlspecialchars($row['pname']); ?></h5>
                    <p class="card-text text-muted small mb-3 text-truncate-2">
                      <?php echo htmlspecialchars($row['pdescription']); ?>
                    </p>

                    <div class="mt-auto">
                      <p class="price mb-2">
                        <strong>₹<?php echo number_format($row['pprice'], 2); ?></strong>
                      </p>
                      <a href="#" class="btn btn-outline-danger btn-block remove-product" data-id="<?php echo $row['pid']; ?>">Remove</a>

                    </div>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
          <?php else: ?>
            <p class="text-center w-100">No products found.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
$conn->close(); // Close the database connection
?>




    <!-- notification -->
    <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="list-group list-group-flush my-n3">
              <div class="list-group-item bg-transparent">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <span class="fe fe-box fe-24"></span>
                  </div>
                  <div class="col">
                    <small><strong>Package has uploaded successfull</strong></small>
                    <div class="my-0 text-muted small">Package is zipped and uploaded</div>
                    <small class="badge badge-pill badge-light text-muted">1m ago</small>
                  </div>
                </div>
              </div>
              <div class="list-group-item bg-transparent">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <span class="fe fe-download fe-24"></span>
                  </div>
                  <div class="col">
                    <small><strong>Widgets are updated successfull</strong></small>
                    <div class="my-0 text-muted small">Just create new layout Index, form, table</div>
                    <small class="badge badge-pill badge-light text-muted">2m ago</small>
                  </div>
                </div>
              </div>
              <div class="list-group-item bg-transparent">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <span class="fe fe-inbox fe-24"></span>
                  </div>
                  <div class="col">
                    <small><strong>Notifications have been sent</strong></small>
                    <div class="my-0 text-muted small">Fusce dapibus, tellus ac cursus commodo</div>
                    <small class="badge badge-pill badge-light text-muted">30m ago</small>
                  </div>
                </div> <!-- / .row -->
              </div>
              <div class="list-group-item bg-transparent">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <span class="fe fe-link fe-24"></span>
                  </div>
                  <div class="col">
                    <small><strong>Link was attached to menu</strong></small>
                    <div class="my-0 text-muted small">New layout has been attached to the menu</div>
                    <small class="badge badge-pill badge-light text-muted">1h ago</small>
                  </div>
                </div>
              </div> <!-- / .row -->
            </div> <!-- / .list-group -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Clear All</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade modal-shortcut modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="defaultModalLabel">Shortcuts</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body px-5">
            <div class="row align-items-center">
              <div class="col-6 text-center">
                <div class="squircle bg-success justify-content-center">
                  <i class="fe fe-cpu fe-32 align-self-center text-white"></i>
                </div>
                <p>Control area</p>
              </div>
              <div class="col-6 text-center">
                <div class="squircle bg-primary justify-content-center">
                  <i class="fe fe-activity fe-32 align-self-center text-white"></i>
                </div>
                <p>Activity</p>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col-6 text-center">
                <div class="squircle bg-primary justify-content-center">
                  <i class="fe fe-droplet fe-32 align-self-center text-white"></i>
                </div>
                <p>Droplet</p>
              </div>
              <div class="col-6 text-center">
                <div class="squircle bg-primary justify-content-center">
                  <i class="fe fe-upload-cloud fe-32 align-self-center text-white"></i>
                </div>
                <p>Upload</p>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col-6 text-center">
                <div class="squircle bg-primary justify-content-center">
                  <i class="fe fe-users fe-32 align-self-center text-white"></i>
                </div>
                <p>Users</p>
              </div>
              <div class="col-6 text-center">
                <div class="squircle bg-primary justify-content-center">
                  <i class="fe fe-settings fe-32 align-self-center text-white"></i>
                </div>
                <p>Settings</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </main> <!-- main -->
  </div> <!-- .wrapper -->



  <!-- Add Product Modal -->
  <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form id="addProductForm" method="post" enctype="multipart/form-data"> <!-- Added enctype -->
          <div class="modal-body">

            <!-- Product Name -->
            <div class="form-group">
              <label for="productName">Product Name</label>
              <input type="text" class="form-control" id="productName" name="productName"
                placeholder="Enter product name" required>
            </div>

            <!-- Product Price -->
            <div class="form-group">
              <label for="productPrice">Price</label>
              <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Enter price"
                min="0" step="0.01" required>
            </div>

            <!-- Product Description -->
            <div class="form-group">
              <label for="productDescription">Description</label>
              <textarea class="form-control" id="productDescription" name="productDescription" rows="3"
                placeholder="Enter product description" required></textarea>
            </div>

            <!-- Product Image -->
            <div class="form-group">
              <label for="productImage">Product Image</label>
              <input type="file" class="form-control-file" id="productImage" name="productImage" accept="image/*"
                required>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Product</button>
          </div>
        </form>
      </div>
    </div>
  </div>


 
<script>
$(document).on('click', '.remove-product', function(e) {
    e.preventDefault();

    var productId = $(this).data('id');
    var confirmDelete = confirm("Are you sure you want to remove this product?");

    if (confirmDelete) {
        $.ajax({
            type: "POST",
            url: "../delete_product.php", // Adjust path if needed
            data: { pid: productId },
            cache: false, // Avoid cached responses
            success: function(response) {
                try {
                    var result = JSON.parse(response);
                    alert(result.message);
                    if (result.success) {
                        location.reload(); // Reload the page to reflect changes
                    }
                } catch (error) {
                    console.error("Parsing error:", error);
                    alert("Unexpected response from the server.");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown);
                alert("An error occurred. Please try again.");
            }
        });
    }
});
</script>



  <script>
    $(document).ready(function () {
      $('#addProductForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Collect form data
        const formData = new FormData(this);

        $.ajax({
          url: '../add_product.php', // Backend PHP script to handle the data
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            alert(response); // Show success message or handle errors
            $('#addProductModal').modal('hide'); // Close the modal
            $('#addProductForm')[0].reset(); // Reset form fields
            location.reload();
          },
          error: function (err) {
            alert('An error occurred while adding the product.');
          }
        });
      });
    });
  </script>






  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/moment.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/simplebar.min.js"></script>
  <script src='js/daterangepicker.js'></script>
  <script src='js/jquery.stickOnScroll.js'></script>
  <script src="js/tinycolor-min.js"></script>
  <script src="js/config.js"></script>
  <script src="js/apps.js"></script>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-56159088-1');
  </script>
</body>

</html>
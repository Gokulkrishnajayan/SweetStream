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
            <a class="dropdown-item" href="../../session/logout.php">Logout</a>
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
            <a class="nav-link" href="page-orders.php">
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
            <a class="nav-link" href="files-list.php">
              <i class="fe fe-shopping-bag fe-16"></i>
              <span class="ml-3 item-text">Products</span>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav flex-fill w-100 mb-2">
          <li class="nav-item w-100">
            <a class="nav-link" href="files-grid.php">
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

<style>
  /* Standardized card size */
  .product-card {
    display: flex;
    flex-direction: column;
    height: 100%;
    max-height: 400px; /* Set max height for cards */
  }

  .product-card .card-body {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .product-card .card-body h5 {
    font-size: 1.125rem;  /* Smaller font size for titles */
    font-weight: 600;
    margin-bottom: 0.5rem;
  }

  .product-card .card-body p {
    margin-bottom: 0.75rem;
  }

  .product-card .form-inline {
    margin-top: auto; /* Push the add stock form to the bottom */
  }

  .card-img-top {
    height: 180px; /* Set a fixed height for the image */
    object-fit: cover; /* Ensure the image fits inside the card without stretching */
  }

  /* Reduce the size of the card and make it responsive */
  @media (max-width: 768px) {
    .product-card {
      height: auto; /* Remove fixed height on smaller screens */
    }
  }

  .product-card .card-body {
    padding: 1rem; /* Standardize padding inside the card */
  }

  .product-card .form-inline .form-control {
    max-width: 80px; /* Limit width of the input field */
  }

  .product-card .form-inline .btn {
    max-width: 100px; /* Limit width of the Add Stock button */
  }

  /* Card container */
  .file-container {
    padding: 20px;
    margin-top: 20px;
  }


</style>


<main role="main" class="main-content">
  <?php
   include '../../php/db_withcon.php'; // Include database connection
    // Create connection
    $conn = new mysqli($host, $user, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch products with name, current stock, and product id
    $query = "SELECT pid, pname, current_stock, pphoto, pdescription, pprice FROM product_table";
    $result = $conn->query($query);

    $products = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
  ?>

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="row align-items-center my-3">
          <div class="col">
            <h2 class="page-title">Stock Inventory</h2>
          </div>
          <div class="col-auto">
            <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#addStockModal">
              <span class="fe fe-plus fe-16 mr-3"></span>Add Stock
            </button>
          </div>
        </div>

        <div class="file-container border-top">
          <div class="file-panel mt-4">
            <h6 class="mb-3">Inventory Overview</h6>
            <hr class="my-4">
            <div class="row">
              <?php foreach ($products as $product): ?>
                <div class="col-md-6 col-lg-3"> <!-- Reduce width here to make the card smaller -->
                  <div class="card shadow mb-4 product-card">
                    <img src="<?php echo htmlspecialchars($product['pphoto']); ?>" class="card-img-top" alt="Product Image">
                    <div class="card-body d-flex flex-column">
                      <h5 class="card-title"><?php echo htmlspecialchars($product['pname']); ?></h5>
                      <p class="text-muted">Current Stock: <?php echo $product['current_stock']; ?></p>
                      <p class="card-text"><?php echo htmlspecialchars($product['pdescription']); ?></p>
                      <p class="text-success">Price: ₹<?php echo number_format($product['pprice'], 2); ?></p>

                      <!-- Add Stock Form -->
                      <form action="update_stock.php" method="POST" class="form-inline">
                        <div class="input-group mb-3">
                          <input type="number" name="quantity" class="form-control" min="1" placeholder="Quantity" required>
                          <input type="hidden" name="pid" value="<?php echo $product['pid']; ?>">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-success">Add Stock</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Stock Modal -->
  <div class="modal fade" id="addStockModal" tabindex="-1" role="dialog" aria-labelledby="addStockModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addStockModalLabel">Add Stock</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="update_stock.php" method="POST">
            <div class="form-group">
              <label for="productSelect">Select Product</label>
              <select class="form-control" id="productSelect" name="pid" required>
                <option value="">Select a Product</option>
                <?php foreach ($products as $product): ?>
                  <option value="<?php echo $product['pid']; ?>"><?php echo $product['pname']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="quantityInput">Quantity to Add</label>
              <input type="number" class="form-control" id="quantityInput" name="quantity" min="1" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Stock</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</main> <!-- main -->


    </div> <!-- .wrapper -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src='js/daterangepicker.js'></script>
    <script src='js/jquery.stickOnScroll.js'></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/d3.min.js"></script>
    <script src="js/topojson.min.js"></script>
    <script src="js/datamaps.all.min.js"></script>
    <script src="js/datamaps-zoomto.js"></script>
    <script src="js/datamaps.custom.js"></script>
    <script src="js/Chart.min.js"></script>
    <script>
      /* defind global options */
      Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
      Chart.defaults.global.defaultFontColor = colors.mutedColor;
    </script>
    <script src="js/gauge.min.js"></script>
    <script src="js/jquery.sparkline.min.js"></script>
    <script src="js/apexcharts.min.js"></script>
    <script src="js/apexcharts.custom.js"></script>
    <script src="js/apps.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-56159088-1');
    </script>
  </body>
</html>
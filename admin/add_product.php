<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection

    // Database configuration
    include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';

    
    $conn = new mysqli($host, $user, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $name = $_POST['productName'];
    $price = $_POST['productPrice'];
    $description = $_POST['productDescription'];

    // Handle image upload
    if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['productImage']['tmp_name'];
        $imageName = basename($_FILES['productImage']['name']);
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        // Validate image type (only jpg, png, gif)
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageExtension, $allowedExtensions)) {
            die("Invalid file type. Only JPG, PNG, and GIF files are allowed.");
        }

        // Generate a unique image name to avoid conflicts
        $newImageName = uniqid('img_', true) . '.' . $imageExtension;

        // Define the upload directory (relative to SweetStream root)
        $uploadDir = __DIR__ . '/../product/';  // Adjust path to product/ inside SweetStream
        $dbImagePath = 'product/' . $newImageName;  // Path to store in the database

        // Ensure the product directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Full path to move the uploaded file
        $uploadPath = $uploadDir . $newImageName;

        // Debugging: Check paths
        // echo "Upload Path: $uploadPath<br>";
        // echo "DB Path: $dbImagePath<br>";

        // Move the uploaded file
        if (move_uploaded_file($imageTmpPath, $uploadPath)) {
            // Insert product data into the database
            $stmt = $conn->prepare("INSERT INTO product_table (pname, pprice, pdescription, pphoto) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sdss", $name, $price, $description, $dbImagePath);

            if ($stmt->execute()) {
                echo "Product added successfully!";
            } else {
                echo "Database error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Failed to upload the image.";
        }
    } else {
        echo "No valid image uploaded. Error code: " . $_FILES['productImage']['error'];
    }

    $conn->close();
}
?>

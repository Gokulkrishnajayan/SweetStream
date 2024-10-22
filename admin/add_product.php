<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'sweetstream');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $name = $_POST['productName'];
    $price = $_POST['productPrice'];
    $description = $_POST['productDescription'];
    echo "Product added successfully!";


    // Handle image upload
    if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['productImage']['tmp_name'];
        $imageName = basename($_FILES['productImage']['name']);
        $uploadDir = 'product/'; // Directory to store uploaded images
        $uploadPath = $uploadDir . $imageName;

        if (move_uploaded_file($imageTmpPath, $uploadPath)) {
            // Insert product into the database
            $stmt = $conn->prepare("INSERT INTO product_table (pname, pprice, pdescription, pphoto) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sdss", $name, $price, $description, $uploadPath);

            if ($stmt->execute()) {
                echo "Product added successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "Please select an image.";
    }

    $conn->close();
}
?>

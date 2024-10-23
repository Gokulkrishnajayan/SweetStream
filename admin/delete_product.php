<?php
// Database configuration
include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db_connection.php';


// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pid'])) {
    $pid = (int)$_POST['pid'];

    // Fetch the product's image path from the database
    $query = $conn->prepare("SELECT pphoto FROM product_table WHERE pid = ?");
    $query->bind_param("i", $pid);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $photoPath = __DIR__ . "/../" . $product['pphoto']; // Adjust path as per directory structure

        // Debugging: Check if the photo path is correct
        // echo "Photo Path: $photoPath";

        // Delete the product image file if it exists
        if (file_exists($photoPath)) {
            if (unlink($photoPath)) {
                // Image successfully deleted
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete product image.']);
                exit; // Stop further execution if image deletion fails
            }
        }

        // Now delete the product from the database
        $deleteQuery = $conn->prepare("DELETE FROM product_table WHERE pid = ?");
        $deleteQuery->bind_param("i", $pid);

        if ($deleteQuery->execute()) {
            echo json_encode(['success' => true, 'message' => 'Product deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete product from the database.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Product not found.']);
    }

    $query->close();
    $deleteQuery->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}

$conn->close();
?>

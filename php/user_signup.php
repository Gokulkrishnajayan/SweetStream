<?php
// Database configuration
$host = 'localhost'; // Your database host
$dbname = 'sweetstream'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);

    // Basic validation
    if (empty($fullName) || empty($email) || empty($password) || empty($confirmPassword)) {
        echo "All fields are required.";
        exit;
    }

    if ($password !== $confirmPassword) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists
    $stmt = $pdo->prepare("SELECT * FROM user_table WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        echo "Email already exists.";
        exit;
    }

    // Insert new user into the database
    $stmt = $pdo->prepare("INSERT INTO user_table (name, email, password) VALUES (?, ?, ?)");
    
    if ($stmt->execute([$fullName, $email, $hashedPassword])) {
        echo "Registration successful!";
        header("Location: ../user/index.html ");
        
    } else {
        echo "Something went wrong. Please try again.";
    }
}
?>

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
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Basic validation
    if (empty($email) || empty($password)) {
        echo "Email and Password are required.";
        exit;
    }

    // Fetch the user from the database
    $stmt = $pdo->prepare("SELECT * FROM user_table WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Start the session and store user information
        session_start();
        $_SESSION['user_id'] = $user['id']; // Adjust this to your user ID field
        $_SESSION['user_email'] = $user['email'];

        // Redirect to a welcome page or dashboard
        header("Location: ../user/index.html");
        exit;
    } else {
        echo "Invalid email or password.";
    }
}
?>

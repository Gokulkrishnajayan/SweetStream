<?php
// Database configuration
$host = 'sql104.infinityfree.com'; // Your database host
$dbname = 'if0_37456290_Sweetstream'; // Your database name
$username = 'if0_37456290'; // Your database username
$password = '6gN73BgwVA7vK0d'; // Your database password

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
        echo "Login successful!";

        if("admin"===$user['privilege']){
            header("Location: ../admin/dark/dashboard-analytics.html");
        }
        elseif("user"===$user['privilege']){
            header("Location: ../user/index.html");
        }
        elseif("delivery"=== $user['privilege']){
            header("Location: ../delivery/index.html");
        }
        exit;
    } else {
        echo "Invalid email or password.";
    }
}
?>

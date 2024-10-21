<?php
 require_once 'db.php';

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

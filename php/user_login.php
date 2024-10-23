<?php
 include $_SERVER['DOCUMENT_ROOT'] . '/SweetStream/php/db.php';

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
       // Store user data in session
       $_SESSION['user_id'] = $user['id'];
       $_SESSION['name'] = $user['name'];
       $_SESSION['privilege'] = $user['privilege'];
        echo "Login successful!";

        if("admin"===$user['privilege']){
            header("Location: ../admin/dark/dashboard-analytics.html");
        }
        elseif("user"===$user['privilege']){
            header("Location: ../user/index.php");
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

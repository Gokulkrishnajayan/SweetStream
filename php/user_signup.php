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
    $fullName = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);
    $userPrivilege =  trim($_POST['user_privileges']);

    // Basic validation
    if (empty($fullName) || empty($email) || empty($password) || empty($confirmPassword) || empty($userPrivilege)) {
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
    $stmt = $pdo->prepare("INSERT INTO user_table (name, email, password,privilege) VALUES (?, ?, ?, ?)");
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->execute([$fullName, $email, $hashedPassword,$userPrivilege])) {
        echo "Registration successful!";
        
        if("user"===$userPrivilege){
            header("Location: ../user/index.html");
        }
        elseif("delivery"=== $userPrivilege){
            header("Location: ../delivery/index.html");
        }
        exit;
        
    } else {
        echo "Something went wrong. Please try again.";
    }
}
?>

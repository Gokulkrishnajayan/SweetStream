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
<?php
// Create PDO database connection (replace mysqli)
// Adapt for MAMP (Windows/Mac)
$host = '127.0.0.1';
$dbname = 'db_portfolio';
$username = 'root';
$password = 'root'; // MAMP: root | WAMP: "" (empty)
$port = 3306; // From your MAMP WebStart page

try {
    // PDO connection with error mode set to exception
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Throw exceptions on error
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Default fetch as associative array
            PDO::ATTR_EMULATE_PREPARES => false // Disable emulation for security
        ]
    );
} catch (PDOException $e) {
    // Handle connection error
    die("Database connection failed: " . $e->getMessage());
}
?>
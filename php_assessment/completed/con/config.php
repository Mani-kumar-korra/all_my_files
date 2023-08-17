<?php
// Database configuration
$db_host = 'localhost';     // Your database host
$db_name = 'sports'; // Your database name
$db_user = 'root'; // Your database username
$db_pass = 'admin@123'; // Your database password

// PDO options
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Enable error reporting
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Set default fetch mode to associative array
    PDO::ATTR_EMULATE_PREPARES => false, // Turn off emulation of prepared statements
    PDO::ATTR_PERSISTENT => false, // Disable persistent connections (set to true if needed)
    // Add any additional PDO options here if required
];

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass, $options);
} catch (PDOException $e) {
    // Handle any errors that occurred during PDO connection
    die("Connection failed: " . $e->getMessage());
}

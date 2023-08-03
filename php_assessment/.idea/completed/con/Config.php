<?php
// Database connection details
$host = 'localhost';
$dbname = 'sports';
$username = 'root';
$password = 'admin@123';

// Create a new MySQLi connection
//$conn = new mysqli($host, $username, $password, $dbname);
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

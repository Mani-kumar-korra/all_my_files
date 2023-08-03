<?php
// Database connection details
$host = 'localhost';
$dbname = 'sports';
$username = 'root';
$password = 'admin@123';

// Create a new MySQLi connection
//$conn = new mysqli($host, $username, $password, $dbname);
    $db = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

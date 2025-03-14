<?php
// filepath: c:\xampp\htdocs\php_SQL_latest\template_1\db_connection.php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'onepiece');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
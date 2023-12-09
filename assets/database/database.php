<?php
$host = 'localhost';
$username = 'root';
$password = ''; // If you have set a password, provide it here
$database = 'porfolio';

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8
$conn->set_charset('utf8');
?>

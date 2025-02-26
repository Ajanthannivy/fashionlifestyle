<?php
// Database configuration
$servername = "localhost";  // Your database server
$username = "root";         // Your database username (default is usually 'root' for local setups)
$password = "";             // Your database password (default is empty for local setups)
$dbname = "fashiondress";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

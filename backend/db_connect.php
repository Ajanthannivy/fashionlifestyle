<?php
$servername = "localhost";
$username = "root"; // Default for XAMPP/WAMP
$password = ""; // Default for XAMPP/WAMP
$dbname = "fashiondress";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

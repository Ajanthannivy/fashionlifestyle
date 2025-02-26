<?php
$host = "localhost";
$user = "root"; // Change if using another user
$password = ""; // Change if your database has a password
$dbname = "fashiondress";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

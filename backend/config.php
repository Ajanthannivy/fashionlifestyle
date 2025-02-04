<?php
$host = "localhost";  // Change if necessary
$user = "root";       // Change your database username
$pass = "";           // Change your database password
$dbname = "feedback";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

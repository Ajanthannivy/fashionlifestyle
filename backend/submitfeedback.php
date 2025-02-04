<?php
header("Content-Type: application/json");

// Database connection
$host = "localhost";
$user = "root";  // Change if you have a different MySQL user
$pass = "";  // Change if you have a password
$dbname = "fashion";

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["message" => "Database connection failed: " . $conn->connect_error]));
}

// Get POST data
$message = isset($_POST['message']) ? trim($_POST['message']) : '';
$rating = isset($_POST['rating']) ? (int) $_POST['rating'] : 0;

// Validate input
if (empty($message) || $rating < 1 || $rating > 5) {
    echo json_encode(["message" => "Invalid input. Please provide feedback and a valid rating."]);
    exit;
}

// Insert data into database
$stmt = $conn->prepare("INSERT INTO feedback (message, rating) VALUES (?, ?)");
$stmt->bind_param("si", $message, $rating);

if ($stmt->execute()) {
    echo json_encode(["message" => "Feedback submitted successfully!"]);
} else {
    echo json_encode(["message" => "Error: " . $stmt->error]);
}

// Close connection
$stmt->close();
$conn->close();
?>

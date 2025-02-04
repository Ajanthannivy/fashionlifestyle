<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root"; // Change if necessary
$password = "";
$database = "fashiondress";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["response" => "Database connection failed."]));
}

// Get user message
$userMessage = trim($_POST['message']);
$response = "I'm not sure about that. Can you rephrase?";

// Check the database for a matching response
$stmt = $conn->prepare("SELECT bot_response FROM chatbot_responses WHERE user_query = ?");
$stmt->bind_param("s", $userMessage);
$stmt->execute();
$stmt->bind_result($botResponse);

if ($stmt->fetch()) {
    $response = $botResponse;
}

$stmt->close();
$conn->close();

// Return response as JSON
echo json_encode(["response" => $response]);
?>

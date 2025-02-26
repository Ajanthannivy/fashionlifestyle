<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fashiondress";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Receive the id from the frontend
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

// Delete the cloth record from the database
$sql = "DELETE FROM men_grooming WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "product deleted successfully"]);
} else {
    echo json_encode(["message" => "Error deleting cloth: " . $conn->error]);
}

$conn->close();
?>

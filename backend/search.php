<?php
$servername = "localhost";
$username = "root";  // Change if necessary
$password = "";
$dbname = "fashion";  // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search_query = isset($_GET['query']) ? trim($_GET['query']) : '';

if ($search_query !== '') {
    $sql = "SELECT * FROM products WHERE name LIKE ? OR category LIKE ?";
    $stmt = $conn->prepare($sql);
    $search_param = "%$search_query%";
    $stmt->bind_param("ss", $search_param, $search_param);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    echo json_encode($products);
}

$conn->close();
?>

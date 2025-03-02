<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'fashiondress';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "
    SELECT id, name AS product_name, price, color, category, image FROM women_footwear
    UNION ALL
    SELECT id, name AS product_name, price, color, category, image FROM women_accessories
    UNION ALL
    SELECT id, name AS product_name, price, color, category, image FROM women_trending
     UNION ALL
    SELECT id, name AS product_name, price, color, category, image FROM clothes
     UNION ALL
    SELECT id, name AS product_name, price, color, category, image FROM  women_makeup
     UNION ALL
    SELECT id, name AS product_name, price, color, category, image FROM women_jewwllery
     UNION ALL
    SELECT id, name AS product_name, price, color, category, image FROM women_activewear
";
$result = $conn->query($sql);
$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

echo json_encode($products);
$conn->close();
?>

<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'fashiondress';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['query'])) {
    $search = $conn->real_escape_string($_GET['query']);

    $sql = "
        SELECT id, name AS product_name, price, color, category, image FROM women_footwear
        WHERE name LIKE '%$search%' OR category LIKE '%$search%' OR color LIKE '%$search%'
        UNION ALL
        SELECT id, name AS product_name, price, color, category, image FROM women_accessories
        WHERE name LIKE '%$search%' OR category LIKE '%$search%' OR color LIKE '%$search%'
        UNION ALL
        SELECT id, name AS product_name, price, color, category, image FROM women_trending
        WHERE name LIKE '%$search%' OR category LIKE '%$search%' OR color LIKE '%$search%'
        UNION ALL
        SELECT id, name AS product_name, price, color, category, image FROM clothes
        WHERE name LIKE '%$search%' OR category LIKE '%$search%' OR color LIKE '%$search%'
        UNION ALL
        SELECT id, name AS product_name, price, color, category, image FROM women_makeup
        WHERE name LIKE '%$search%' OR category LIKE '%$search%' OR color LIKE '%$search%'
        UNION ALL
        SELECT id, name AS product_name, price, color, category, image FROM women_jewwllery
        WHERE name LIKE '%$search%' OR category LIKE '%$search%' OR color LIKE '%$search%'
        UNION ALL
        SELECT id, name AS product_name, price, color, category, image FROM women_activewear
        WHERE name LIKE '%$search%' OR category LIKE '%$search%' OR color LIKE '%$search%'
        UNION ALL
    ";

    $result = $conn->query($sql);
    $output = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output[] = $row;
        }
    }

    echo json_encode($output);
}

$conn->close();
?>

<?php
include('db.php');

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $sql = "SELECT * FROM products WHERE name LIKE '%$query%' OR category LIKE '%$query%'";
    $result = $conn->query($sql);

    echo "<h2>Search Results for '$query'</h2>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>
                    <img src='images/{$row['image']}' width='100'>
                    <h3>{$row['name']}</h3>
                    <p>₹ {$row['price']}</p>
                </div>";
        }
    } else {
        echo "<p>No products found.</p>";
    }
}
?>

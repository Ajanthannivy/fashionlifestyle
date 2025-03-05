<?php
include('db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Please log in to view your cart.";
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT products.*, cart.quantity FROM cart 
        JOIN products ON cart.product_id = products.id 
        WHERE cart.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Your Cart</h2>";

while ($row = $result->fetch_assoc()) {
    echo "<div>
            <img src='images/{$row['image']}' width='100'>
            <h3>{$row['name']}</h3>
            <p>₹ {$row['price']}</p>
            <p>Quantity: {$row['quantity']}</p>
        </div>";
}

$stmt->close();
$conn->close();
?>

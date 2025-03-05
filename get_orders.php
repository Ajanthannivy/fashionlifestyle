<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

$user_id = $_SESSION['user_id'];

// Query to fetch orders for the logged-in user
$query = "SELECT * FROM orders WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);

$orders = [];
while ($order = mysqli_fetch_assoc($result)) {
    $orders[] = $order;
}

echo json_encode($orders);
?>

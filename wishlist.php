<?php
include('db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Please login to add items to Wishlist!";
    exit();
}

$user_id = $_SESSION['user_id']; // Authentication System Added

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    $check = "SELECT * FROM wishlist WHERE user_id='$user_id' AND product_id='$product_id'";
    $result = $conn->query($check);

    if ($result->num_rows == 0) {
        $sql = "INSERT INTO wishlist (user_id, product_id) VALUES ('$user_id', '$product_id')";
        if ($conn->query($sql)) {
            echo "Added to Wishlist!";
        }
    } else {
        echo "Already in Wishlist!";
    }
}
?>

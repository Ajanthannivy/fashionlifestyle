<?php
// move-to-bag.php

// Start session to access user data
session_start();

// Database connection (replace with your own connection settings)
$connection = mysqli_connect('localhost', 'username', 'password', 'fashiondress');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the request
    $data = json_decode(file_get_contents('php://input'), true);
    $item_id = $data['itemId'];
    $user_id = $_SESSION['user_id']; // Assume user is logged in, and user_id is stored in session

    // Remove item from wishlist (assuming the table structure has user_id and item_id)
    $query = "DELETE FROM wishlist WHERE user_id = '$user_id' AND item_id = '$item_id'";
    if (mysqli_query($connection, $query)) {
        // Add item to cart table (or session, depending on your implementation)
        $query = "INSERT INTO cart (user_id, item_id, quantity) VALUES ('$user_id', '$item_id', 1)";
        mysqli_query($connection, $query);

        // Respond with success
        echo json_encode(['status' => 'success']);
    } else {
        // Handle error
        echo json_encode(['status' => 'error', 'message' => 'Failed to move item']);
    }
}
?>

<?php
include '../fashionlifestyle/useraccount/db.php';  // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $user_id = 1; // Assuming you're working with a single user for now (replace with session-based user id)

    // Check if the product is already in the wishlist
    $checkQuery = "SELECT * FROM wishlist WHERE product_id = $product_id AND user_id = $user_id";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['success' => false, 'message' => 'Item already in wishlist']);
    } else {
        // Add to wishlist
        $insertQuery = "INSERT INTO wishlist (product_id, user_id) VALUES ($product_id, $user_id)";
        if (mysqli_query($conn, $insertQuery)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error adding to wishlist']);
        }
    }
}
?>

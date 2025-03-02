<?php
include '../fashionlifestyle/useraccount/db.php';  // Include database connection

// Assuming user_id is stored in session
$user_id = 1; // Replace with actual user id from session

$query = "SELECT products.*, wishlist.id as wishlist_id FROM wishlist 
          JOIN products ON wishlist.product_id = products.id 
          WHERE wishlist.user_id = $user_id";

$result = mysqli_query($conn, $query);
$wishlist = [];

while ($row = mysqli_fetch_assoc($result)) {
    $wishlist[] = $row;
}

echo json_encode($wishlist);
?>

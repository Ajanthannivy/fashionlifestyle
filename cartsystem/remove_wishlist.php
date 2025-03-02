<?php
include '../useraccount/db.php'; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];

    $deleteWishlist = "DELETE FROM wishlist WHERE product_id = $product_id";
    if (mysqli_query($conn, $deleteWishlist)) {
        echo "Item removed from wishlist.";
    } else {
        echo "Error removing item.";
    }
}
?>

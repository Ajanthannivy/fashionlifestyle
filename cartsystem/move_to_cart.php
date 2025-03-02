<?php
include '../useraccount/db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];

    // Check if the product exists in wishlist
    $checkQuery = "SELECT * FROM wishlist WHERE id = $product_id";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        // Move the product to cart
        $insertQuery = "INSERT INTO cart (product_id) SELECT product_id FROM wishlist WHERE id = $product_id";
        if (mysqli_query($conn, $insertQuery)) {
            // Delete from wishlist after moving to cart
            $deleteQuery = "DELETE FROM wishlist WHERE id = $product_id";
            mysqli_query($conn, $deleteQuery);
            echo "Item moved to bag successfully!";
        } else {
            echo "Error moving item.";
        }
    } else {
        echo "Product not found in wishlist.";
    }
}
?>

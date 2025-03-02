<?php
include '../useraccount/db.php'; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];

    // Check if product is already in wishlist
    $checkQuery = "SELECT * FROM wishlist WHERE product_id = $product_id";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "Product already in wishlist!";
    } else {
        // Insert into wishlist table
        $insertQuery = "INSERT INTO wishlist (product_id) VALUES ($product_id)";
        if (mysqli_query($conn, $insertQuery)) {
            echo "Product added to wishlist!";
        } else {
            echo "Error adding product to wishlist.";
        }
    }
}
?>

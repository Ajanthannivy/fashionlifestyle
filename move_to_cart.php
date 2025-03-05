<?php
include('db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<h2>Please <a href='login.php'>Login</a> to continue!</h2>";
    exit();
}

$user_id = $_SESSION['user_id'];

// Form to Product Data 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $wishlist_id = $_POST['wishlist_id'];
    $product_id = $_POST['product_id'];
    $size = $_POST['size'];
    $quantity = $_POST['quantity'];

    // Check whether the product is still in stock
    $check_stock_sql = "SELECT quantity FROM products WHERE id = '$product_id'";
    $stock_result = $conn->query($check_stock_sql);
    $stock_row = $stock_result->fetch_assoc();

    if ($stock_row['quantity'] < $quantity) {
        echo "<h2>Stock is not available. <a href='wishlist.php'>Go Back</a></h2>";
        exit();
    }

    // Product Cart add
    $add_to_cart_sql = "INSERT INTO cart (user_id, product_id, size, quantity) 
                        VALUES ('$user_id', '$product_id', '$size', '$quantity')";

    if ($conn->query($add_to_cart_sql) === TRUE) {
        // Wishlist delete Product
        $delete_wishlist_sql = "DELETE FROM wishlist WHERE id = '$wishlist_id'";
        $conn->query($delete_wishlist_sql);

        // Stock Update
        $new_stock = $stock_row['quantity'] - $quantity;
        $update_stock_sql = "UPDATE products SET quantity = '$new_stock' WHERE id = '$product_id'";
        $conn->query($update_stock_sql);

        // Cart Page Redirect 
        header("Location: cart.php");
        exit();
    } else {
        echo "<h2>Error: " . $conn->error . "</h2>";
    }
} else {
    echo "<h2>Invalid Request</h2>";
}
?>

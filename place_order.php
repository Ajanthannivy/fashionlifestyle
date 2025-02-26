<?php
session_start();
include('./user/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ./user/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$address = mysqli_real_escape_string($conn, $_POST['address']);
$payment_method = $_POST['payment'];

// Check if cart is empty
$cart_check = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'");
if (mysqli_num_rows($cart_check) == 0) {
    echo "<script>alert('Your cart is empty!'); window.location.href = 'index.php';</script>";
    exit();
}

// Insert Order
$order_query = "INSERT INTO orders (user_id, address, payment_method, total_price, status) 
                VALUES ('$user_id', '$address', '$payment_method', 
                (SELECT SUM(products.price * cart.quantity) FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = '$user_id'), 'Pending')";

if (mysqli_query($conn, $order_query)) {
    $order_id = mysqli_insert_id($conn);

    // Insert Order Items
    $cart_items = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'");
    while ($item = mysqli_fetch_assoc($cart_items)) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];
        $price_query = mysqli_query($conn, "SELECT price FROM products WHERE id = '$product_id'");
        $price_row = mysqli_fetch_assoc($price_query);
        $price = $price_row['price'];

        mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$price')");
    }

    // Empty the cart
    mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'");

    echo "<script>alert('Order Placed Successfully!'); window.location.href = 'order_success.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>

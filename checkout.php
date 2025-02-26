<?php
session_start();
include('./user/db.php'); // Database Connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ./user/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch Cart Items
$sql = "SELECT cart.id, products.name, products.image, products.price, cart.quantity 
        FROM cart 
        JOIN products ON cart.product_id = products.id 
        WHERE cart.user_id = '$user_id'";

$result = mysqli_query($conn, $sql);
$cart_items = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Calculate Total Price
$total_price = 0;
foreach ($cart_items as $item) {
    $total_price += $item['price'] * $item['quantity'];
}

// If cart is empty, redirect to index
if (count($cart_items) == 0) {
    echo "<script>alert('Your cart is empty!'); window.location.href = 'index.php';</script>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    
    <style>
        body {
    font-family: Arial, sans-serif;
}
.checkout-container {
    width: 80%;
    margin: auto;
}
table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}
th {
    background-color: #f4f4f4;
}
button {
    background-color: #28a745;
    color: white;
    padding: 10px;
    border: none;
    cursor: pointer;
}
button:hover {
    background-color: #218838;
}

    </style>
</head>
<body>

<h2>Checkout</h2>

<div class="checkout-container">
    <table>
        <tr>
            <th>Product</th>
            <th>Image</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        <?php foreach ($cart_items as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['name']); ?></td>
                <td><img src="<?= htmlspecialchars($item['image']); ?>" width="50"></td>
                <td>₹<?= number_format($item['price'], 2); ?></td>
                <td><?= $item['quantity']; ?></td>
                <td>₹<?= number_format($item['price'] * $item['quantity'], 2); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Total: ₹<?= number_format($total_price, 2); ?></h3>

    <!-- Payment & Place Order Form -->
    <form action="place_order.php" method="POST">
        <label for="address">Delivery Address:</label>
        <textarea name="address" required></textarea>
        
        <label for="payment">Payment Method:</label>
        <select name="payment" required>
            <option value="cod">Cash on Delivery</option>
            <option value="card">Credit/Debit Card</option>
        </select>
        
        <button type="submit">Place Order</button>
    </form>
</div>

</body>
</html>

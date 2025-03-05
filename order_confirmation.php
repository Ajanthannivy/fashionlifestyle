<?php
session_start();

// Retrieve order details from local storage (if stored)
$orderDetails = isset($_SESSION['order']) ? $_SESSION['order'] : null;

if (!$orderDetails) {
    echo "<h2>Order Not Found!</h2>";
    exit;
}

$name = $orderDetails['name'];
$address = $orderDetails['address'];
$paymentMode = $orderDetails['paymentMode'];
$cart = $orderDetails['cart'];

// Clear session after retrieving order details
unset($_SESSION['order']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body>
    <h2>Order Placed Successfully!</h2>
    <p><strong>Name:</strong> <?= htmlspecialchars($name) ?></p>
    <p><strong>Address:</strong> <?= htmlspecialchars($address) ?></p>
    <p><strong>Payment Mode:</strong> <?= htmlspecialchars($paymentMode) ?></p>

    <h3>Order Summary</h3>
    <ul>
        <?php foreach ($cart as $item): ?>
            <li><?= htmlspecialchars($item['name']) ?> - ₹<?= htmlspecialchars($item['price']) ?> x <?= htmlspecialchars($item['quantity']) ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="index.php">Back to Home</a>
</body>
</html>

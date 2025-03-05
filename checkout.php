<?php
include('db.php');
session_start();
require 'vendor/autoload.php'; // Stripe Library Include

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$payment_mode = $_POST['payment_mode']; // COD or Card
$address = $_POST['address']; // Address from form

// Fetch cart items
$cart_items = $conn->query("SELECT cart.*, products.name, products.price 
                            FROM cart 
                            JOIN products ON cart.product_id = products.id 
                            WHERE cart.user_id = '$user_id'");

$total_amount = 0;
$order_success = true;
$order_items = []; // For Stripe Payment

while ($row = $cart_items->fetch_assoc()) {
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];
    $price = $row['price'];
    $total_price = $quantity * $price;
    $total_amount += $total_price;

    // Save order in database
    $query = "INSERT INTO orders (user_id, product_id, quantity, total_price, payment_mode, order_status, address) 
              VALUES (?, ?, ?, ?, ?, 'pending', ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiidss", $user_id, $product_id, $quantity, $total_price, $payment_mode, $address);

    if (!$stmt->execute()) {
        $order_success = false;
    }
    $stmt->close();

    // Prepare items for Stripe Payment
    $order_items[] = [
        'name' => $row['name'],
        'price' => $price,
        'quantity' => $quantity
    ];
}

// If all orders inserted successfully
if ($order_success) {
    if ($payment_mode === "COD") {
        // Cash on Delivery - Clear cart and redirect to success page
        $conn->query("DELETE FROM cart WHERE user_id = '$user_id'");
        header("Location: cart.php?message=Order Placed Successfully!");
        exit();
    } else {
        // Stripe Payment Process
        \Stripe\Stripe::setApiKey('sk_test_51QprK4HspNUtSzZSeLu1fLRzetLUk8I7uotk2Xlge9cuAuuSAEZxNkTnoKh1RcvTjHm6H7zrwX425g9sknQuzLwr00aG7tSPiM');

        $line_items = [];
        foreach ($order_items as $item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'inr',
                    'product_data' => ['name' => $item['name']],
                    'unit_amount' => $item['price'] * 100, // Stripe requires amount in cents
                ],
                'quantity' => $item['quantity'],
            ];
        }

        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => 'http://yourwebsite.com/payment-success.php?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'http://yourwebsite.com/order-failed.html',
        ]);

        // Return the session ID to the client-side to redirect to Stripe
        echo json_encode(['id' => $checkout_session->id]);
        exit();
    }
} else {
    header("Location: cart.php?message=Order Failed!");
    exit();
}
?>

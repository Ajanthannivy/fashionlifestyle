<?php
require 'vendor/autoload.php';

$host = "localhost";
$user = "root";
$password = "";
$database = "fashiondress";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

\Stripe\Stripe::setApiKey('sk_test_51QprK4HspNUtSzZSeLu1fLRzetLUk8I7uotk2Xlge9cuAuuSAEZxNkTnoKh1RcvTjHm6H7zrwX425g9sknQuzLwr00aG7tSPiM');

$data = json_decode(file_get_contents('php://input'), true);
$cart = $data['cart'];
$name = $data['name'];
$address = $data['address'];
$paymentMode = $data['paymentMode'];

$totalAmount = 0;
foreach ($cart as $item) {
    $totalAmount += $item['price'] * $item['quantity'];
}

// Create Stripe Checkout Session for Card Payment
if ($paymentMode === "Card") {
    $line_items = [];
    foreach ($cart as $item) {
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
} else {
    // Handle COD orders - save to database, clear cart and redirect to success page
    $query = "INSERT INTO orders (name, address, payment_mode, total_amount, order_status) 
              VALUES (?, ?, ?, ?, 'Pending')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssd", $name, $address, $paymentMode, $totalAmount);
    $stmt->execute();
    $stmt->close();
    
    // Clear cart and redirect to success page
    echo json_encode(['status' => 'success']);
}
<?php
require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('your_stripe_secret_key');

session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$order_id = $_GET['order_id'];
$amount = $_GET['amount'];

$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'price_data' => [
            'currency' => 'inr',
            'product_data' => ['name' => 'Fashion Store Order'],
            'unit_amount' => $amount * 100, 
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => "stripe_success.php?order_id=$order_id&session_id={CHECKOUT_SESSION_ID}",
    'cancel_url' => "billing.php",
]);

header("Location: " . $session->url);
exit();
?>

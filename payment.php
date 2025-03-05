<?php
require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51QprK4HspNUtSzZSeLu1fLRzetLUk8I7uotk2Xlge9cuAuuSAEZxNkTnoKh1RcvTjHm6H7zrwX425g9sknQuzLwr00aG7tSPiM');

session_start();
include('db.php'); // Database connection

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$total_amount = isset($_GET['total']) ? (float)$_GET['total'] : 0;

header('Content-Type: application/json');

try {
    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'inr',
                'product_data' => [
                    'name' => 'Nc Fashion Orders',
                ],
                'unit_amount' => $total_amount * 100, // Stripe expects amount in cents
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost/fashionstore/women/success.php?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => 'http://localhost/fashionstore/women/billing.php?message=Payment+Cancelled',
    ]);

    echo json_encode(['id' => $checkout_session->id]);

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

?>
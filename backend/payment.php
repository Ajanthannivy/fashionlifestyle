<?php
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('');

header('Content-Type: application/json');

$input = json_decode(file_get_contents("php://input"), true);
$totalAmount = $input['totalAmount'] ?? 5000; // Default $50.00 if amount is missing

try {
    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'Order Payment',
                ],
                'unit_amount' => $totalAmount,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost/success.html',
        'cancel_url' => 'http://localhost/cancel.html',
    ]);

    echo json_encode(['id' => $checkout_session->id]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>


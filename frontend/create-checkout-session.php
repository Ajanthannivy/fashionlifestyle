<?php
require '../vendor/autoload.php'; // ✅ Always on top

use Stripe\Stripe;
use Stripe\Checkout\Session;

Stripe::setApiKey('sk_test_51QprK4HspNUtSzZSj4kVoiyruYK66vOuxaAHjpIEaWdOrmMv7YhaUknLza3SY9A5xmycyLJQqQtrvA65nr3oCfpu005JCbQZCj');

header('Content-Type: application/json');

try {
    $checkout_session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'Test Product',
                ],
                'unit_amount' => 5000, // $50.00 in cents
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost/frontend/success.html',
        'cancel_url' => 'http://localhost/frontend/cancel.html',
    ]);

    echo json_encode(['id' => $checkout_session->id]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>

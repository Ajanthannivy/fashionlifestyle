<?php
require '../vendor/autoload.php';

use Stripe\Stripe;
use Stripe\Checkout\Session;

// Set your secret key securely
\Stripe\Stripe::setApiKey('sk_test_51QprK4HspNUtSzZSeLu1fLRzetLUk8I7uotk2Xlge9cuAuuSAEZxNkTnoKh1RcvTjHm6H7zrwX425g9sknQuzLwr00aG7tSPiM');

header('Content-Type: application/json');

try {
    $checkout_session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'LKR',
                'product_data' => [
                    'name' => 'Test Product',
                ],
                'unit_amount' => 5000, // ✅ Correct LKR (no cents system)
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://127.0.0.1/fashionlifestyle/frontend/success.html',
        'cancel_url' => 'http://127.0.0.1/fashionlifestyle/frontend/cancel.html',
    ]);

    echo json_encode(['id' => $checkout_session->id]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>

<?php
require '../vendor/autoload.php';

use Stripe\Stripe;
use Stripe\Checkout\Session;

// Set your secret key securely. Ideally, use environment variables or a secure vault
$secret_key = getenv('STRIPE_SECRET_KEY');
if (!$secret_key) {
    http_response_code(500);
    echo json_encode(['error' => 'Stripe secret key not set.']);
    exit;
}
\Stripe\Stripe::setApiKey($secret_key);

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
                'unit_amount' => 5000, // Correct LKR (no cents system)
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
    echo json_encode(['error' => 'Stripe API error: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'General error: ' . $e->getMessage()]);
}
?>
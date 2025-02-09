<?php
require '../vendor/autoload.php'; // ✅ Always on top

use Stripe\Stripe;
use Stripe\Checkout\Session;

// Set your secret key. Remember to switch to your live secret key in production!
\Stripe\Stripe::setApiKey('sk_test_51QprK4HspNUtSzZSeLu1fLRzetLUk8I7uotk2Xlge9cuAuuSAEZxNkTnoKh1RcvTjHm6H7zrwX425g9sknQuzLwr00aG7tSPiM');

header('Content-Type: application/json');

try {
    // Create the checkout session
    $checkout_session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'lkr', // Ensure this is the correct currency code
                'product_data' => [
                    'name' => 'Test Product',
                ],
                'unit_amount' => 5000, // Amount is in cents (i.e., 50.00 LKR)
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost/frontend/success.html',
        'cancel_url' => 'http://localhost/frontend/cancel.html',
    ]);

    // Return the session ID as JSON
    echo json_encode(['id' => $checkout_session->id]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Catch Stripe-specific errors
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
} catch (Exception $e) {
    // Catch other errors
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
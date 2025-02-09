<?php
// checkout.php (Stripe Payment Processing)

require '/wamp/www/fashionlifestyle/vendor/autoload.php';
require 'db.php';

\Stripe\Stripe::setApiKey('sk_test_51QprK4HspNUtSzZSeLu1fLRzetLUk8I7uotk2Xlge9cuAuuSAEZxNkTnoKh1RcvTjHm6H7zrwX425g9sknQuzLwr00aG7tSPiM');

header('Content-Type: application/json');

$amount = 5000; // Example amount in cents (e.g., $50)

$paymentIntent = \Stripe\PaymentIntent::create([
    'amount' => $amount,
    'currency' => 'usd',
]);

echo json_encode([
    'clientSecret' => $paymentIntent->client_secret,
]);
?>
<?php
require 'vendor/autoload.php'; // Include Stripe library
require 'db.php'; // Database connection

\Stripe\Stripe::setApiKey('sk_test_51QprK4HspNUtSzZSeLu1fLRzetLUk8I7uotk2Xlge9cuAuuSAEZxNkTnoKh1RcvTjHm6H7zrwX425g9sknQuzLwr00aG7tSPiM');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['customer_name'];
    $email = $_POST['customer_email'];
    $token = $_POST['stripeToken'];
    $amount = 1000; // Example: $10.00 (Amount in cents)
    $currency = 'usd';

    try {
        // Create a charge
        $charge = \Stripe\Charge::create([
            "amount" => $amount,
            "currency" => $currency,
            "source" => $token,
            "description" => "Payment from $email",
        ]);

        // Save to database
        $stmt = $conn->prepare("INSERT INTO payments (customer_name, customer_email, amount, currency, stripe_payment_id, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsss", $name, $email, $amount, $currency, $charge->id, $status);
        $status = 'successful';

        if ($stmt->execute()) {
            header("Location: success.php"); // Redirect to success page
            exit();
        } else {
            echo "Database error!";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

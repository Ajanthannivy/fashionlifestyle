<?php
require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51QprK4HspNUtSzZSeLu1fLRzetLUk8I7uotk2Xlge9cuAuuSAEZxNkTnoKh1RcvTjHm6H7zrwX425g9sknQuzLwr00aG7tSPiM');

include('db.php');

$order_id = $_GET['order_id'];
$session_id = $_GET['session_id'];

try {
    $session = \Stripe\Checkout\Session::retrieve($session_id);
    $payment_intent = $session->payment_intent;
    $amount_paid = $session->amount_total / 100;  // Convert to INR
    $payment_status = $session->payment_status;

    if ($payment_status == 'paid') {
        $sql = "UPDATE orders SET stripe_payment_id = ?, stripe_payment_status = 'Paid', payment_status = 'Paid' WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $payment_intent, $order_id);
        $stmt->execute();

        echo "<h2>✅ Payment Successful! Order ID: #$order_id</h2>";
        echo "<p>Payment ID: $payment_intent</p>";
        echo "<p>Total Amount Paid: ₹$amount_paid</p>";
    } else {
        echo "<h2>❌ Payment Failed!</h2>";
    }
} catch (Exception $e) {
    echo "<h2>Error Processing Payment</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>

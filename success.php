<?php
session_start();
require 'db.php';
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51QprK4HspNUtSzZSeLu1fLRzetLUk8I7uotk2Xlge9cuAuuSAEZxNkTnoKh1RcvTjHm6H7zrwX425g9sknQuzLwr00aG7tSPiM');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Validate session_id
if (!isset($_GET['session_id']) || empty($_GET['session_id'])) {
    $_SESSION['order_error_message'] = "Invalid Payment Session!";
    header("Location: billing.php");
    exit();
}

$session_id = $_GET['session_id'];

try {
    $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);
    $payment_status = $checkout_session->payment_status;
    $stripe_payment_id = $checkout_session->payment_intent;
    $total_amount = $checkout_session->amount_total / 100; // Convert from paisa to INR

    
    if ($payment_status === 'paid') {
        // Insert order into database
        $order_query = "INSERT INTO orders (user_id, total_amount, payment_mode, stripe_payment_id, payment_status, order_status) 
                        VALUES (?, ?, 'Card', ?, 'Paid', 'Confirmed')";
        $stmt = $conn->prepare($order_query);

        if ($stmt) {
            $stmt->bind_param("ids", $user_id, $total_amount, $stripe_payment_id);
            if ($stmt->execute()) {
                $_SESSION['order_success_message'] = "Your payment was successful! Order has been confirmed.";

                // Clear Cart after successful order
                $delete_cart_query = "DELETE FROM cart WHERE user_id = ?";
                $stmt = $conn->prepare($delete_cart_query);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
            }
            $stmt->close();
        }

        // Redirect to homepage with success message
        header("Location: index.php?message=Payment+Successful");
        exit();
    } else {
        throw new Exception("Payment failed. Please try again.");
    }
} catch (Exception $e) {
    $_SESSION['order_error_message'] = "Error: " . $e->getMessage();
    header("Location: billing.php");
    exit();
}
?>

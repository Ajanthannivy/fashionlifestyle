<?php
require 'vendor/autoload.php';

$host = "localhost";
$user = "root";
$password = "";
$database = "fashiondress";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

\Stripe\Stripe::setApiKey('your_secret_key_here');

$session_id = $_GET['session_id'];
$session = \Stripe\Checkout\Session::retrieve($session_id);

$customer_details = $session->customer_details;
$amount_total = $session->amount_total / 100;
$transaction_id = $session->payment_intent;

$query = "INSERT INTO orders (name, address, payment_mode, transaction_id, total_amount, order_status) 
          VALUES (?, ?, ?, ?, ?, 'Completed')";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssd", $customer_details->name, $customer_details->address->line1, $session->payment_method_types[0], $transaction_id, $amount_total);
$stmt->execute();
$stmt->close();

header("Location: order-success.html");
exit();
?>


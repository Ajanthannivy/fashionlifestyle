<?php
require 'db.php';

if (isset($_GET['payment_intent'])) {
    $payment_intent = $_GET['payment_intent'];
    $status = $_GET['redirect_status'];

    if ($status === 'succeeded') {
        echo "<h1>Payment Successful!</h1>";
    } else {
        echo "<h1>Payment Failed!</h1>";
    }
}
?>
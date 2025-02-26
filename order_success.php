<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location:./user/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link rel="stylesheet" href="../css/order.css">
</head>
<body>

<h2>🎉 Your Order has been Placed Successfully!</h2>
<p>Thank you for shopping with us.</p>

<a href="index.php">Back to Home</a>

</body>
</html>

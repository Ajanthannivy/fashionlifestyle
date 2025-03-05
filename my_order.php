<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    echo "<p>User not logged in</p>";
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch orders with product details
$query = "SELECT o.id AS order_id, o.status, o.order_date, o.total_amount,
                 oi.product_id, oi.quantity, p.name, p.price, p.image
          FROM orders o
          JOIN order_items oi ON o.id = oi.order_id
          JOIN products p ON oi.product_id = p.id
          WHERE o.user_id = $user_id";

$result = mysqli_query($conn, $query);

$orders = [];
while ($row = mysqli_fetch_assoc($result)) {
    $order_id = $row['order_id'];

    if (!isset($orders[$order_id])) {
        $orders[$order_id] = [
            "order_id" => $order_id,
            "status" => $row['status'],
            "order_date" => $row['order_date'],
            "total_amount" => $row['total_amount'],
            "items" => []
        ];
    }

    $orders[$order_id]["items"][] = [
        "product_id" => $row['product_id'],
        "name" => $row['name'],
        "price" => $row['price'],
        "image" => $row['image'],
        "quantity" => $row['quantity']
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .order {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }
        .order img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 15px;
        }
        .order-details {
            display: flex;
            align-items: center;
        }
        .order p {
            margin: 5px 0;
        }
        .order h3 {
            margin-top: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>My Orders</h1>

    <?php if (empty($orders)): ?>
        <p>You currently have no orders.</p>
        <p><a href="index.php">Start Shopping</a></p>
    <?php else: ?>
        <?php foreach ($orders as $order): ?>
            <div class="order">
                <h3>Order ID: <?php echo $order['order_id']; ?></h3>
                <p><strong>Status:</strong> <?php echo $order['status']; ?></p>
                <p><strong>Ordered on:</strong> <?php echo $order['order_date']; ?></p>
                <p><strong>Total:</strong> ₹<?php echo $order['total_amount']; ?></p>

                <h4>Items:</h4>
                <?php foreach ($order['items'] as $item): ?>
                    <div class="order-details">
                        <img src="img/products/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                        <div>
                            <p><strong><?php echo $item['name']; ?></strong></p>
                            <p>Price: ₹<?php echo $item['price']; ?></p>
                            <p>Quantity: <?php echo $item['quantity']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</div>

</body>
</html>

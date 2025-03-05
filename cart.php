<?php
include('db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<h2>Please <a href='login.php'>Login</a> to view your Cart!</h2>";
    exit();
}

$user_id = $_SESSION['user_id'];


$sql = "SELECT cart.*, products.name, products.price, products.image 
        FROM cart 
        JOIN products ON cart.product_id = products.id 
        WHERE cart.user_id = '$user_id'";
$result = $conn->query($sql);

// Total Price & Quantity 
$total_price = 0;
$total_quantity = 0;
?>

<!DOCTYPE html>
<html lang="ta">
<head>
    <title>My Cart</title>
    <style>
        .cart-container {
            width: 70%;
            margin: auto;
            text-align: center;
        }

        .cart-item {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px 0;
            justify-content: space-between;
        }

        .cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }

        .cart-item div {
            flex-grow: 1;
            text-align: left;
            padding-left: 15px;
        }

        .remove-btn {
            background: red;
            color: white;
            border: none;
            cursor: pointer;
            padding: 5px;
        }

        .checkout-btn {
            background: green;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .total-summary {
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h2>My Cart</h2>

<div class="cart-container">
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="cart-item">
                <img src="images/<?php echo $row['image']; ?>" alt="Product">
                <div>
                    <h3><?php echo $row['name']; ?></h3>
                    <p>Size: <?php echo $row['size']; ?></p>
                    <p>Quantity: <?php echo $row['quantity']; ?></p>
                    <p>Price: ₹<?php echo $row['price']; ?></p>
                    <p>Total: ₹<?php echo ($row['price'] * $row['quantity']); ?></p>
                </div>
                <form method="POST" action="remove_cart.php">
                    <input type="hidden" name="cart_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="remove-btn">Remove</button>
                </form>
            </div>
            <?php 
                $total_price += ($row['price'] * $row['quantity']); 
                $total_quantity += $row['quantity'];
            ?>
        <?php endwhile; ?>

        <div class="total-summary">Total Items: <?php echo $total_quantity; ?></div>
        <div class="total-summary">Total Price: ₹<?php echo $total_price; ?></div>

        <form action="billing.php" method="POST">
            <button type="submit" class="checkout-btn">Proceed to Checkout</button>
        </form>
    <?php else: ?>
        <h3>Your Cart is Empty!</h3>
    <?php endif; ?>
</div>

</body>
</html>

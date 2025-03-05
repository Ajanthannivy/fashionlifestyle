<?php
include('db.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user address details
$query = "SELECT * FROM user_profiles WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Fetch cart items
$query = "SELECT cart.*, products.name, products.image, products.price, cart.quantity 
          FROM cart 
          JOIN products ON cart.product_id = products.id 
          WHERE cart.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$cart_items = $stmt->get_result();

// Calculate total price
$subtotal = 0;
$delivery_fee = 350;
while ($row = $cart_items->fetch_assoc()) {
    $subtotal += $row['price'] * $row['quantity'];
}
$total = $subtotal + $delivery_fee;
$stmt->close();

// COD Order Processing & Save in Database
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payment_mode']) && $_POST['payment_mode'] === 'COD') {
    $order_query = "INSERT INTO orders (user_id, total_amount, payment_mode, order_status) VALUES (?, ?, 'COD', 'Confirmed')";
    $stmt = $conn->prepare($order_query);
    $stmt->bind_param("id", $user_id, $total);
    if ($stmt->execute()) {
        $_SESSION['order_success_message'] = "Your COD order has been confirmed!";
        
        // Clear cart after order placed
        $delete_cart_query = "DELETE FROM cart WHERE user_id = ?";
        $stmt = $conn->prepare($delete_cart_query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        header("Location: billing.php"); // Reload page to show message
        exit();
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Billing Details</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
       body {
           font-family: Arial, sans-serif;
           background-color: #f5f5f5;
           margin: 0;
           padding: 0;
       }
       .container {
           display: flex;
           justify-content: center;
           align-items: flex-start;
           gap: 30px;
           padding: 40px;
           max-width: 1000px;
           margin: auto;
       }
       .form-section, .checkout-section {
           flex: 1;
           background-color: #fff;
           padding: 25px;
           border-radius: 8px;
           box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
       }
       h2 {
           font-size: 22px;
           font-weight: bold;
           margin-bottom: 15px;
           color: #333;
           border-bottom: 2px solid #ddd;
           padding-bottom: 8px;
       }
       label {
           display: block;
           font-weight: bold;
           margin-top: 12px;
       }
       select {
           width: 100%;
           padding: 10px;
           margin-top: 5px;
           border: 1px solid #ccc;
           border-radius: 5px;
           font-size: 14px;
       }
       button {
           width: 100%;
           background-color: palevioletred;
           color: white;
           padding: 12px;
           border: none;
           border-radius: 5px;
           font-size: 16px;
           cursor: pointer;
           margin-top: 15px;
           font-weight: bold;
           transition: background 0.3s ease-in-out;
       }
       button:hover {
           background-color: navy;
       }
       .success-message {
           background-color: #d4edda;
           color: #155724;
           padding: 10px;
           margin: 20px 0;
           border: 1px solid #c3e6cb;
           border-radius: 5px;
       }
    </style>
</head>
<body>

<div class="container">
    <div class="form-section">
        <?php if (isset($_SESSION['order_success_message'])): ?>
            <div class="success-message">
                <?php echo $_SESSION['order_success_message']; unset($_SESSION['order_success_message']); ?>
            </div>
        <?php endif; ?>

        <h2>DELIVERY DETAILS</h2>

<?php if ($user): ?>
    <p><?php echo htmlspecialchars($user['address_line1']); ?></p>
    
    <?php if (!empty($user['address_line2'])): ?>
        <p><?php echo htmlspecialchars($user['address_line2']); ?></p>
    <?php endif; ?>

    <p><?php echo htmlspecialchars($user['city']) . ", " . htmlspecialchars($user['postal_code']); ?></p>
    <p><?php echo htmlspecialchars($user['country']); ?></p>
    <p>📞 <?php echo htmlspecialchars($user['phone']); ?></p>

    <!-- Edit Address Button -->
    <a href="profile.php" class="edit-button">Edit Address</a>

<?php else: ?>
    <p>Address details not available. <a href="profile.php">Add here</a></p>
<?php endif; ?>

<!-- Styling for Button -->
<style>
    .edit-button {
        display: inline-block;
        margin-top: 10px;
        padding: 10px 15px;
        background-color: navy;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: background 0.3s ease-in-out;
    }
    .edit-button:hover {
        background-color: darkred;
    }
</style>


<!-- CSS for Better Styling -->
<style>
    .delivery-details {
        background: #f9f9f9;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .edit-address-btn {
        display: inline-block;
        margin-top: 10px;
        padding: 10px 15px;
        background-color: navy;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: background 0.3s;
    }
    .edit-address-btn:hover {
        background-color: darkred;
    }
</style>

        <!-- COD Order Form -->
        <form method="POST">
            <label for="payment_mode">PAYMENT METHOD:</label>
            <select name="payment_mode" id="payment_mode">
                <option value="COD">COD (Cash on Delivery)</option>
                <option value="Card">Credit/Debit Card</option>
            </select>
            <button type="submit">Confirm Order</button>
        </form>

        <!-- Stripe Payment Button -->
        <button type="button" id="checkout-button">Pay with Stripe</button>
        <?php
        if (isset($_GET['message'])) {
    echo '<div class="success-message">' . htmlspecialchars($_GET['message']) . '</div>';
}?>

    </div>

    <div class="checkout-section">
        <h2>Order Summary</h2>
        <p>Cart Total: ₹<?php echo number_format($subtotal, 2); ?></p>
        <p>Delivery Charge: ₹<?php echo number_format($delivery_fee, 2); ?></p>
        <hr/>
        <h3>Total: ₹<?php echo number_format($total, 2); ?></h3>
    </div>
</div>

<script>
    var stripe = Stripe("pk_test_51QprK4HspNUtSzZSj4kVoiyruYK66vOuxaAHjpIEaWdOrmMv7YhaUknLza3SY9A5xmycyLJQqQtrvA65nr3oCfpu005JCbQZCj");
    var checkoutButton = document.getElementById("checkout-button");

    checkoutButton.addEventListener("click", function () {
        fetch("payment.php?total=<?php echo $total; ?>", { method: "POST" })
            .then(response => response.json())
            .then(session => {
                return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .catch(error => console.error("Error:", error));
    });
</script>

<a href="index.php">Back to Home</a>

</body>
</html>

<?php
include('db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<h2>Please <a href='login.php'>Login</a> to continue!</h2>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cart_id = $_POST['cart_id'];

    
    $sql = "DELETE FROM cart WHERE id = '$cart_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: cart.php");
        exit();
    } else {
        echo "<h2>Error: " . $conn->error . "</h2>";
    }
}
?>

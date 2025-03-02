<?php
session_start();
include '../user/db.php';

$user_id = $_SESSION['user_id']; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Check if product is already in cart
    $checkQuery = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Insert into cart
        $insertQuery = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("iii", $user_id, $product_id, $quantity);
        if ($stmt->execute()) {
            echo "Added to cart!";
        } else {
            echo "Error adding to cart!";
        }
    } else {
        echo "Already in cart!";
    }
}

// Fetch cart items
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $query = "SELECT p.*, c.quantity FROM products p JOIN cart c ON p.id = c.product_id WHERE c.user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $cartItems = [];
    while ($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
    }
    echo json_encode($cartItems);
}

// Remove from cart
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $product_id = $_DELETE['product_id'];

    $deleteQuery = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("ii", $user_id, $product_id);
    if ($stmt->execute()) {
        echo "Removed from cart!";
    } else {
        echo "Error removing item!";
    }
}

// Move item from wishlist to cart
if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    parse_str(file_get_contents("php://input"), $_PUT);
    $product_id = $_PUT['product_id'];

    // Remove from wishlist
    $deleteQuery = "DELETE FROM wishlist WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();

    // Add to cart
    $insertQuery = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ii", $user_id, $product_id);
    if ($stmt->execute()) {
        echo "Moved to cart!";
    } else {
        echo "Error moving item!";
    }
}
?>

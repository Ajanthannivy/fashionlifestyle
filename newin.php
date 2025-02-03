<?php
// Database connection details
$host = 'localhost';
$dbname = 'fashion';
$username = 'root';  // Your MySQL username
$password = '';      // Your MySQL password (if any)

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Catch any connection errors and display a message
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Fetch products from the database
$query = "SELECT * FROM products ORDER BY created_at DESC LIMIT 10";
$stmt = $pdo->query($query);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Store</title>
    <style>
        /* Your existing CSS styles */
    </style>
</head>
<body>

    <header>
        <h1>Fashion Store</h1>
        <nav>
            <a href="#">Home</a>
           
        </nav>
    </header>

    <section id="hero">
        <h2>New Arrivals are Here!</h2>
        <p>Discover the latest trends in fashion.</p>
        <a href="#" class="btn">Shop Now</a>
    </section>

    <section id="products">
        <h2>Featured Products</h2>
        <div class="product-container">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <p>$<?= number_format($product['price'], 2) ?></p>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <script>
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', () => {
                alert("Item added to cart!");
            });
        });
    </script>

    <footer>
        <p>&copy; 2025 Fashion Store. All rights reserved.</p>
    </footer>

</body>
</html>

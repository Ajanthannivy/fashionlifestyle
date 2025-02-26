<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "fashiondress";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Wolfmania - Fashion Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        .product-card {
            transition: transform 0.3s ease-in-out;
        }
        .product-card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-gray-100">
    

    <header class="relative h-96">
        <img alt="Fashion banner showing a stylish model in trendy clothing" class="absolute inset-0 w-full h-full object-cover" height="960" src="https://storage.googleapis.com/a1aa/image/UwAoVDJnHnmu5TCt8NwIIgmlH9T3puQ21ab2-iOyOZM.jpg" width="1920"/>
        <div class="h-full flex items-center justify-center bg-black bg-opacity-50">
            <h1 class="text-white text-4xl font-bold">Discover the Latest Fashion Trends</h1>
        </div>
    </header>

    <div class="container mx-auto mt-8">
        <h2 class="text-3xl font-bold text-center mb-6">Featured Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

            <?php
            // Fetch products from database
            $sql = "SELECT * FROM products ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="bg-white p-4 rounded-lg shadow-lg product-card">';
                    echo '<img class="w-full h-64 object-cover rounded-md" src="' . htmlspecialchars($row["product_image"]) . '" alt="' . htmlspecialchars($row["product_name"]) . '"/>';
                    echo '<h3 class="text-xl font-semibold mt-2">' . htmlspecialchars($row["product_name"]) . '</h3>';
                    echo '<p class="text-gray-600">$' . number_format($row["product_price"], 2) . '</p>';
                    echo '<button class="bg-red-500 text-white px-4 py-2 rounded mt-2 w-full">Add to Cart</button>';
                    echo '</div>';
                }
            } else {
                echo "<p class='text-center text-gray-600'>No products available.</p>";
            }

            $conn->close();
            ?>

        </div>
    </div>

    <footer class="bg-gray-800 text-white text-center p-4 mt-8">
        <p>© 2025 Wolfmania. All Rights Reserved.</p>
    </footer>
</body>
</html>

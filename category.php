<?php include('db.php'); ?>

<!DOCTYPE html>
<html lang="ta">
<head>
    <title>Category View</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>body {
    font-family: Arial, sans-serif;
}

#wishlist-section {
    position: fixed;
    top: 20px;
    right: 30px;
    font-size: 30px;
    color: red;
}

.products {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.product-card {
    width: 200px;
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
    position: relative;
    transition: transform 0.3s;
}

.product-card:hover {
    transform: scale(1.05);
}

.product-img {
    width: 100%;
    height: auto;
}

.product-info h3 {
    margin: 10px 0;
    font-size: 16px;
}

.product-info p {
    color: #f33;
    font-size: 14px;
}

.wishlist-button {
    background: none;
    border: none;
    font-size: 24px;
    color: gray;
    position: absolute;
    bottom: 10px;
    right: 10px;
    cursor: pointer;
    transition: color 0.3s;
}

.wishlist-button:hover {
    color: red;
}
</style>
</head>
<body>



<?php
include('db.php');

if (isset($_GET['category']) && isset($_GET['gender'])) {
    $category = mysqli_real_escape_string($conn, $_GET['category']);
    $gender = mysqli_real_escape_string($conn, $_GET['gender']);

    echo "<h2>$gender - $category Products</h2>";

    // Filter by category and gender
    $sql = "SELECT * FROM products WHERE category='$category' AND gender='$gender'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='products'>";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product-card'>
                    <img src='images/{$row['image']}' class='product-img'>
                    <div class='product-info'>
                        <h3>{$row['name']}</h3>
                        <h3>{$row['description']}</h3>
                        <p>₹ {$row['price']}</p>
                        
                    </div>
                      <form action='wishlist.php' method='POST'>
                        <input type='hidden' name='product_id' value='{$row['id']}'>
                        <button type='submit' class='wishlist-button'>
                            <i class='fas fa-heart'></i>
                        </button>
                    </form>
                    </div>";
        }
        echo "</div>";
    } else {
        echo "<p>No products found for $gender in $category.</p>";
    }
} else {
    echo "<p>Invalid category or gender.</p>";
}
?>



</body>
</html>
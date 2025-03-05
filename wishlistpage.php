<?php
include('db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<h2>Please <a href='login.php'>Login</a> to view your Wishlist!</h2>";
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT products.*, wishlist.id AS wishlist_id FROM wishlist 
        JOIN products ON wishlist.product_id = products.id 
        WHERE wishlist.user_id = '$user_id'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ta">
<head>
    <title>Wishlist</title>
    <style>
        .wishlist-item {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px 0;
            width: 500px;
        }

        .wishlist-item img {
            width: 80px;
            height: 80px;
            margin-right: 15px;
            object-fit: cover;
            border-radius: 5px;
        }

        .wishlist-item div {
            flex-grow: 1;
        }

        .wishlist-item select, 
        .wishlist-item button {
            margin-left: 10px;
            padding: 5px;
        }

        .wishlist-item button {
            background: green;
            color: white;
            border: none;
            cursor: pointer;
        }

        .wishlist-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .out-of-stock {
            color: red;
            font-weight: bold;
        }
    </style>
     <script>
        function updateStock(productId, stock) {
            let quantitySelect = document.getElementById("quantity_" + productId);
            let button = document.getElementById("btn_" + productId);
            let stockMsg = document.getElementById("stock_msg_" + productId);

            if (stock == 0) {
                stockMsg.innerHTML = "Out of Stock";
                button.disabled = true;
                quantitySelect.innerHTML = "<option value=''>Out of Stock</option>";
            } else {
                stockMsg.innerHTML = "";
                button.disabled = false;
                quantitySelect.innerHTML = "<option value=''>Select Quantity</option>";
                for (let i = 1; i <= stock; i++) {
                    quantitySelect.innerHTML += `<option value="${i}">${i}</option>`;
                }
            }
        }
    </script>
</head>
<body>

<h2>Your Wishlist</h2>

<div class="wishlist-container">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="wishlist-item">
            <img src="images/<?php echo $row['image']; ?>" alt="Product">
            <div>
                <h3><?php echo $row['name']; ?></h3>
                <p>₹ <?php echo $row['price']; ?></p>

                <form method="POST" action="move_to_cart.php">
                    <input type="hidden" name="wishlist_id" value="<?php echo $row['wishlist_id']; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">

                    <label>Size:</label>
                    <select name="size" required>
                        <option value="">Select Size</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>
                        <option value="free">Free Size</option>
                    </select>

                    <label>Quantity:</label>
                    <select name="quantity" id="quantity_<?php echo $row['id']; ?>" required>
                        <option value="">Select Quantity</option>
                        <?php for ($i = 1; $i <= $row['quantity']; $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>

                    <p id="stock_msg_<?php echo $row['id']; ?>" class="out-of-stock">
                        <?php echo ($row['quantity'] == 0) ? "Out of Stock" : ""; ?>
                    </p>

                    <button type="submit" name="move_to_cart" id="btn_<?php echo $row['id']; ?>" 
                        <?php echo ($row['quantity'] == 0) ? "disabled" : ""; ?>>Move To Bag
                    </button>
                </form>

                <script>
                    updateStock(<?php echo $row['id']; ?>, <?php echo $row['quantity']; ?>);
                </script>
            </div>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>

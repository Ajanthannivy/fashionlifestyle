<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "fashiondress"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Products</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        button {
            padding: 5px 10px;
            color: white;
            border: none;
            cursor: pointer;
        }
        .delete-btn {
            background-color: red;
        }
        .update-btn {
            background-color: blue;
        }
    </style>
</head>
<body>
    <h2>Products List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Product Image</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['product_name']}</td>
                    <td>{$row['product_price']}</td>
                    <td><img src='{$row['product_image']}' width='50'></td>
                    <td>{$row['created_at']}</td>
                    <td>
                        <button class='update-btn' onclick=\"updateProduct({$row['id']})\">Update</button>
                        <button class='delete-btn' onclick=\"deleteProduct({$row['id']})\">Delete</button>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No products found</td></tr>";
        }
        ?>
    </table>

    <script>
        function deleteProduct(id) {
            if (confirm("Are you sure you want to delete this product?")) {
                window.location.href = "delete.php?id=" + id;
            }
        }

        function updateProduct(id) {
            window.location.href = "update.html?id=" + id;
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>

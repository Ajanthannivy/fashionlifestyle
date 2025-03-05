<?php include('../db.php'); ?>

<!DOCTYPE html>
<html lang="ta">
<head>
    <title>View Products</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid black;
        }
        img {
            width: 80px;
            height: auto;
        }
        .btn {
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
        }
        .edit-btn {
            background-color: #28a745;
        }
        .delete-btn {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <h2>📦 Your Products</h2>
    <table>
    <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Category</th>
    <th>Gender</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Image</th>
    <th>Description</th>
    <th>Actions</th>
</tr>

<?php
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['category']}</td>
            <td>{$row['gender']}</td>
            <td>Rs. {$row['price']}</td>
            <td>{$row['quantity']}</td> 
            <td><img src='../images/{$row['image']}' width='80'></td>
            <td>{$row['description']}</td>
            <td>
                <a href='edit_product.php?id={$row['id']}'>Edit</a> |
                <a href='delete_product.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
            </td>
        </tr>";
}
?>
 </table>
</body>
</html>

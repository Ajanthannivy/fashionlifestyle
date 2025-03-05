<?php
include('../db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="ta">
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>✏️ Product Edit</h2>
    <form action="update_product.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $row['id']; ?>">

        <label>Product Name:</label>
        <input type="text" name="name" value="<?= $row['name']; ?>" required><br>

        <label>Category:</label>
        <select name="category">
            <option value="<?= $row['category']; ?>"><?= $row['category']; ?></option>
            <option value="Dresses">Dresses</option>
            <option value="T-Shirts">T-Shirts</option>
            <option value="Coats">Coats</option>
            <option value="Shorts">Shorts</option>
            <option value="Jeans">Jeans</option>
            <option value="Wedding">Wedding</option>             
        </select><br>

        <label>Gender:</label>
        <select name="gender">
            <option value="<?= $row['gender']; ?>"><?= $row['gender']; ?></option>
            <option value="Men">Men</option>
            <option value="Women">Women</option>
           
        </select><br>

        <label>Price:</label>
        <input type="number" name="price" value="<?= $row['price']; ?>" required><br>

        <label>Current Image:</label><br>
        <img src="../images/<?= $row['image']; ?>" width="100"><br>
        <label>New Image:</label>
        <input type="file" name="image"><br>

        <label>Description:</label>
        <textarea name="description" required><?= $row['description']; ?></textarea><br>

        <button type="submit" name="update">Update Product</button>
    </form>
</body>
</html>

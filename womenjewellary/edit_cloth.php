
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Accessories</title>
</head>
<body>

<h2>Edit Accessories</h2>

<?php
$id = $_GET['id'];  

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fashiondress";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM women_jewellery WHERE id = $id";
$result = $conn->query($sql);
$cloth = $result->fetch_assoc();

$conn->close();
?>

<form action="update_cloth.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $cloth['id']; ?>">

    <label>Cloth Name:</label>
    <input type="text" name="name" value="<?php echo $cloth['name']; ?>" required><br><br>

    <label>Price:</label>
    <input type="number" name="price" value="<?php echo $cloth['price']; ?>" required><br><br>

    <label>Color:</label>
    <input type="text" name="color" value="<?php echo $cloth['color']; ?>" required><br><br>

    <label>Category:</label>
    <select name="category">
        <option value="Earings" <?php echo ($cloth['category'] == 'Earings') ? 'selected' : ''; ?>>Earings</option>
        <option value="Necklaces" <?php echo ($cloth['category'] == 'Necklaces') ? 'selected' : ''; ?>>Necklaces</option>
        <option value="Bracelets" <?php echo ($cloth['category'] == 'Bracelets') ? 'selected' : ''; ?>>Bracelets</option>
        <option value="Rings" <?php echo ($cloth['category'] == 'Rings') ? 'selected' : ''; ?>>Rings</option>
        
       
    </select><br><br>

    <label>Upload New Image (Optional):</label>
    <input type="file" name="image"><br><br>

    <button type="submit" name="submit">Update Cloth</button>
</form>

</body>
</html>
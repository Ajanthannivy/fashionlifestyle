
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Cloth</title>
</head>
<body>

<h2>Edit Cloth</h2>

<?php
$id = $_GET['id'];  // Get the product ID from the URL

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fashiondress";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the current cloth data
$sql = "SELECT * FROM women_accessories WHERE id = $id";
$result = $conn->query($sql);
$cloth = $result->fetch_assoc();

$conn->close();
?>

<form action="update_cloth.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $cloth['id']; ?>">

    <label>Accessories Name:</label>
    <input type="text" name="name" value="<?php echo $cloth['name']; ?>" required><br><br>

    <label>Price:</label>
    <input type="number" name="price" value="<?php echo $cloth['price']; ?>" required><br><br>

    <label>Color:</label>
    <input type="text" name="color" value="<?php echo $cloth['color']; ?>" required><br><br>

    <label>Category:</label>
    <select name="category">
        <option value="Sunglass" <?php echo ($cloth['category'] == 'Sunglass') ? 'selected' : ''; ?>>Sunglass</option>
        <option value="Caps & Hats" <?php echo ($cloth['category'] == 'Caps & Hats') ? 'selected' : ''; ?>>Caps & Hats</option>
        <option value="Bags & Purses" <?php echo ($cloth['category'] == 'Bags & Purses') ? 'selected' : ''; ?>>Bags & Purses</option>
        <option value="Hair Accessories" <?php echo ($cloth['category'] == 'Hair Accessories') ? 'selected' : ''; ?>>Hair Accessories</option>
        
       
    </select><br><br>

    <label>Upload New Image (Optional):</label>
    <input type="file" name="image"><br><br>

    <button type="submit" name="submit">Update Cloth</button>
</form>

</body>
</html>
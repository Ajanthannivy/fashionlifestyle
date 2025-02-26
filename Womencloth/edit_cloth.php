
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
$sql = "SELECT * FROM clothes WHERE id = $id";
$result = $conn->query($sql);
$cloth = $result->fetch_assoc();

$conn->close();
?>

<form action="update_cloth.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $cloth['id']; ?>">

    <label>Cloth Name:</label>
    <input type="text" name="cloth_name" value="<?php echo $cloth['cloth_name']; ?>" required><br><br>

    <label>Price:</label>
    <input type="number" name="price" value="<?php echo $cloth['price']; ?>" required><br><br>

    <label>Color:</label>
    <input type="text" name="color" value="<?php echo $cloth['color']; ?>" required><br><br>

    <label>Category:</label>
    <select name="category">
        <option value="Dresses" <?php echo ($cloth['category'] == 'Dresses') ? 'selected' : ''; ?>>Dresses</option>
        <option value="T-Shirts" <?php echo ($cloth['category'] == 'T-Shirts') ? 'selected' : ''; ?>>T-Shirts</option>
        <option value="Shorts" <?php echo ($cloth['category'] == 'Shorts') ? 'selected' : ''; ?>>Shorts</option>
        <option value="Coats" <?php echo ($cloth['category'] == 'Coats') ? 'selected' : ''; ?>>Coats</option>
        <option value="Jeans" <?php echo ($cloth['category'] == 'Jeans') ? 'selected' : ''; ?>>Jeans</option>
        <option value="Holiday" <?php echo ($cloth['category'] == 'Holiday') ? 'selected' : ''; ?>>HoliDay</option>
        <option value="Wedding" <?php echo ($cloth['category'] == 'Wedding') ? 'selected' : ''; ?>>Wedding</option>
        <option value="Denim" <?php echo ($cloth['category'] == 'Denim') ? 'selected' : ''; ?>>Denim</option>
       
    </select><br><br>

    <label>Upload New Image (Optional):</label>
    <input type="file" name="image"><br><br>

    <button type="submit" name="submit">Update Cloth</button>
</form>

</body>
</html>
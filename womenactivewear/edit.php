
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>

<h2>Edit Grooming</h2>

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


$sql = "SELECT * FROM women_activewear WHERE id = $id";
$result = $conn->query($sql);
$cloth = $result->fetch_assoc();

$conn->close();
?>

<form action="update.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $cloth['id']; ?>">

    <label>Cloth Name:</label>
    <input type="text" name="name" value="<?php echo $cloth['name']; ?>" required><br><br>

    <label>Price:</label>
    <input type="number" name="price" value="<?php echo $cloth['price']; ?>" required><br><br>

    <label>Color:</label>
    <input type="text" name="color" value="<?php echo $cloth['color']; ?>" required><br><br>

    <label>Category:</label>
    <select name="category">
        <option value="Trainers" <?php echo ($cloth['category'] == 'Trainers') ? 'selected' : ''; ?>>Trainers</option>
        <option value="Shorts" <?php echo ($cloth['category'] == 'Shorts') ? 'selected' : ''; ?>>Shorts</option>
        <option value="Jackets" <?php echo ($cloth['category'] == 'Jackets') ? 'selected' : ''; ?>>Jackets</option>
        <option value="Leggings" <?php echo ($cloth['category'] == 'Leggings') ? 'selected' : ''; ?>>Leggings</option>
        <option value="Swim" <?php echo ($cloth['category'] == 'Swim') ? 'selected' : ''; ?>>Swim</option>
        <option value="Football" <?php echo ($cloth['category'] == 'Football') ? 'selected' : ''; ?>>Football</option>
        <option value="Gym & Training" <?php echo ($cloth['category'] == 'Gym & Training') ? 'selected' : ''; ?>>Gym & Training</option>
      
        
       
    </select><br><br>

    <label>Upload New Image (Optional):</label>
    <input type="file" name="image"><br><br>

    <button type="submit" name="submit">Update Cloth</button>
</form>

</body>
</html>
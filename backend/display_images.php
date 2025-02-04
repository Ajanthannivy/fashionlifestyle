<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "pathfinder");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all images from the database
$sql = "SELECT * FROM blog";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* Three columns */
            gap: 16px;
            padding: 16px;
            max-width: 1200px;
            margin: auto;
        }
        .image-container {
            background: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .image-container img {
            max-width: 100%;
            border-radius: 8px;
        }
        .caption {
            margin-top: 8px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>

    <div class="container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="image-container">
                    <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['alt_text']; ?>">
                    <div class="caption"><?php echo $row['caption']; ?></div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No images found.</p>
        <?php endif; ?>
    </div>

</body>
</html>

<?php
$conn->close();
?>

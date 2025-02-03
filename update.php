<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "pathfinder");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql = "DELETE FROM blog WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: update.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $stmt->close();
}

// Fetch all images
$sql = "SELECT * FROM blog";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin: Manage Images</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f8f9fa;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #007bff;
            color: white;
        }
        a {
            text-decoration: none;
            padding: 5px 10px;
            color: white;
            background-color: #28a745;
            border-radius: 4px;
            margin-right: 5px;
        }
        a.delete {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <h1>Admin: Manage Images</h1>
    <a href="admin_upload.php">Add New Image</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Caption</th>
                <th>Alt Text</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['alt_text']; ?>" style="width: 100px;"></td>
                        <td><?php echo $row['caption']; ?></td>
                        <td><?php echo $row['alt_text']; ?></td>
                        <td>
                            <a href="admin_upload.php?edit=<?php echo $row['id']; ?>">Edit</a>
                            <a href="update.php?delete=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this image?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No images found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
<?php $conn->close(); ?>

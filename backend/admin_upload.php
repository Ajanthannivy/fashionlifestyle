<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "pathfinder");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for adding or editing images
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $caption = $_POST['caption'];
    $alt_text = $_POST['alt_text'];
    $image_path = "";

    // File upload logic
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] !== "") {
        $target_dir = "admin/uploads/";
        $image_path = $target_dir . basename($_FILES["image"]["name"]);
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
            die("Error uploading file. Check file permissions and path.");
        }
    }

    // Check if data is being passed correctly
    echo "ID: $id, Caption: $caption, Alt Text: $alt_text, Image Path: $image_path<br>";

    // Update or insert based on ID
   if ($id > 0) {
    $sql = "UPDATE blog SET caption=?, alt_text=?";
    if ($image_path !== "") {
        $sql .= ", image_path=?";
    }
    $sql .= " WHERE id=?";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    if ($image_path !== "") {
        $stmt->bind_param("sssi", $caption, $alt_text, $image_path, $id);
    } else {
        $stmt->bind_param("ssi", $caption, $alt_text, $id);
    }
} else {
    // Insert query
    $sql = "INSERT INTO blog (caption, alt_text, image_path) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $caption, $alt_text, $image_path);
}


    echo "SQL Query: $sql<br>"; // Debugging SQL Query

    $stmt = $conn->prepare($sql);
    if ($id > 0) {
        if ($image_path !== "") {
            $stmt->bind_param("sssi", $caption, $alt_text, $image_path, $id);
        } else {
            $stmt->bind_param("ssi", $caption, $alt_text, $id);
        }
    } else {
        $stmt->bind_param("sss", $caption, $alt_text, $image_path);
    }

    if ($stmt->execute()) {
        echo "Operation successful: ID=" . ($id > 0 ? $id : $conn->insert_id);
        header("Location: update.php"); // Comment this line during debugging
        exit;
    } else {
        echo "Database Error: " . $stmt->error; // Debugging error
    }
}

// Fetch image details for editing
$image = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $sql = "SELECT id, caption, alt_text, image_path FROM blog WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Bind the result to variables
    $stmt->bind_result($image_id, $caption, $alt_text, $image_path);

    // Fetch the result
    if ($stmt->fetch()) {
        $image = array(
    'id' => $image_id,
    'caption' => $caption,
    'alt_text' => $alt_text,
    'image_path' => $image_path
);
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin: Add/Edit Images</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f8f9fa;
        }
        form {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        form input, form textarea, form button {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        form button {
            background-color: #007bff;
            color: white;
            border: none;
        }
        form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Admin: Add/Edit Image</h1>
   <form action="update.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo isset($image['id']) ? $image['id'] : ''; ?>">
    <label for="caption">Caption</label>
    <input type="text" name="caption" id="caption" required value="<?php echo isset($image['caption']) ? $image['caption'] : ''; ?>">
    <label for="alt_text">Alt Text</label>
    <input type="text" name="alt_text" id="alt_text" required value="<?php echo isset($image['alt_text']) ? $image['alt_text'] : ''; ?>">
    <label for="image">Image</label>
    <input type="file" name="image" id="image">
    <?php if (isset($image['image_path'])): ?>
        <p>Current Image: <img src="<?php echo $image['image_path']; ?>" alt="Current Image" style="width: 100px; height: auto;"></p>
    <?php endif; ?>
    <button type="submit"><?php echo isset($image) ? "Update Image" : "Add Image"; ?></button>
</form>

</body>
</html>

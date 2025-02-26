<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "fashiondress";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Increase file size limits (if needed)
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '20M');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = trim($_POST["product_name"]);
    $product_price = floatval($_POST["product_price"]); // Ensure price is a valid float
    $target_dir = "uploads/";

    // Handle file upload
    if (!empty($_FILES["product_image"]["name"])) {
        $file_name = basename($_FILES["product_image"]["name"]);
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate image type
        $allowed_types = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowed_types)) {
            die("Error: Invalid file type. Only JPG, JPEG, PNG & GIF allowed.");
        }

        // Check file size (Max: 10MB)
        $maxFileSize = 10 * 1024 * 1024; // 10MB
        if ($_FILES["product_image"]["size"] > $maxFileSize) {
            die("Error: File size exceeds 10MB limit.");
        }

        // Check for file upload errors
        if ($_FILES["product_image"]["error"] !== UPLOAD_ERR_OK) {
            die("File upload error: " . $_FILES["product_image"]["error"]);
        }

        // Ensure "uploads/" directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Move uploaded file to target directory
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
            // Insert into database
            $stmt = $conn->prepare("INSERT INTO products (product_name, product_price, product_image) VALUES (?, ?, ?)");
            if ($stmt === false) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("sds", $product_name, $product_price, $target_file);

            if ($stmt->execute()) {
                echo "<script>alert('Product added successfully!'); window.location.href='product.php';</script>";
            } else {
                echo "Database error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            die("Error: Failed to move uploaded file.");
        }
    } else {
        die("Error: Please upload an image.");
    }
}

$conn->close();
?>

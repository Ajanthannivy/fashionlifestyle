<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fashiondress";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['submit'])) {
    // Get the POST data
    $name = $_POST['name'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $category = $_POST['category'];

    // Image handling
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = 'uploads/' . basename($image_name);  // Save image in 'uploads' folder
    move_uploaded_file($image_tmp, $image_path);

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'fashiondress');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the cloth data into the database
    $sql = "INSERT INTO women_accessories (name, price, color, category, image) VALUES ('$name', '$price', '$color', '$category', '$image_path')";
   
        if ($conn->query($sql) === TRUE) {
            echo "New clothing item added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload image.";
    }

$conn->close();
?>

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
   
    $name = $_POST['name'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $category = $_POST['category'];

    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = 'uploads/' . basename($image_name);  
    move_uploaded_file($image_tmp, $image_path);

    $conn = new mysqli('localhost', 'root', '', 'fashiondress');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

  
    $sql = "INSERT INTO women_jewellery (name, price, color, category, image) VALUES ('$name', '$price', '$color', '$category', '$image_path')";
   
        if ($conn->query($sql) === TRUE) {
            echo "New jewellery item added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload image.";
    }

$conn->close();
?>

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
    $id = $_POST['id'];
    $cloth_name = $_POST['cloth_name'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $category = $_POST['category'];
    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $upload_dir = "uploads/";

    // If a new image is uploaded, handle it
    if (!empty($image_name)) {
        move_uploaded_file($image_tmp_name, $upload_dir . $image_name);
        $image_path = $upload_dir . $image_name;
    } else {
        // Use the existing image if no new image is uploaded
        $sql = "SELECT image FROM men_clothes WHERE id = $id";
        $result = $conn->query($sql);
        $cloth = $result->fetch_assoc();
        $image_path = $cloth['image'];
    }

    // Update the cloth details
    $sql = "UPDATE men_clothes SET cloth_name = '$cloth_name', price = '$price', color = '$color', category = '$category', image = '$image_path' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Cloth updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

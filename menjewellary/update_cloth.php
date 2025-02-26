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
    $name = $_POST['name'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $category = $_POST['category'];
    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $upload_dir = "uploads/";

   
    if (!empty($image_name)) {
        move_uploaded_file($image_tmp_name, $upload_dir . $image_name);
        $image_path = $upload_dir . $image_name;
    } else {
     
        $sql = "SELECT image FROM men_jewellery WHERE id = $id";
        $result = $conn->query($sql);
        $cloth = $result->fetch_assoc();
        $image_path = $cloth['image'];
    }

    $sql = "UPDATE men_jewellery SET name = '$name', price = '$price', color = '$color', category = '$category', image = '$image_path' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "product updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

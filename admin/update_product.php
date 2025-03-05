<?php
include('../db.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $gender = $_POST['gender'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Image handling
    if ($_FILES['image']['name'] != "") {
        $query = "SELECT image FROM products WHERE id = $id";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $old_image = "../images/" . $row['image'];

        // Delete old image
        if (file_exists($old_image)) {
            unlink($old_image);
        }

        // Upload new image
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp, "../images/" . $image_name);

        $sql = "UPDATE products SET name='$name', category='$category', gender='$gender', price='$price', image='$image_name', description='$description' WHERE id='$id'";
    } else {
        $sql = "UPDATE products SET name='$name', category='$category', gender='$gender', price='$price', description='$description' WHERE id='$id'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Product Updated Successfully!'); window.location='view_products.php';</script>";
    } else {
        echo "Error updating product: " . $conn->error;
    }
}
?>

<?php
include('../db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete image from folder
    $query = "SELECT image FROM products WHERE id = $id";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $image_path = "../images/" . $row['image'];

    if (file_exists($image_path)) {
        unlink($image_path);
    }

    // Delete product from database
    $sql = "DELETE FROM products WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Product Deleted Successfully!'); window.location='view_products.php';</script>";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}
?>

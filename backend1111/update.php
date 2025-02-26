<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "fashiondress"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST["id"]);
    $product_name = $_POST["product_name"];
    $product_price = floatval($_POST["product_price"]);

    $sql = "UPDATE products SET product_name = ?, product_price = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdi", $product_name, $product_price, $id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Product updated successfully!');
                window.location.href = 'view.php';
              </script>";
    } else {
        echo "<script>
                alert('Error updating product: " . $conn->error . "');
                window.history.back();
              </script>";
    }

    $stmt->close();
}

$conn->close();
?>

<?php include('../db.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 50%;
            margin: auto;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        input, select, textarea, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h2>Add New Product</h2>
    <form action="add_product.php" method="POST" enctype="multipart/form-data">
        <label>Product Name:</label>
        <input type="text" name="name" required><br>

        <label>Gender:</label>
        <select name="gender">
            <option value="Men">Men</option>
            <option value="Women">Women</option>
        </select><br>

        <label>Category:</label>
        <select name="category">
        <option value="Dresses">Dresses</option>
            <option value="T-Shirts">T-Shirts</option>
            <option value="Coats">Coats</option>
            <option value="Shorts">Shorts</option>
            <option value="Jeans">Jeans</option>
            <option value="Wedding">Wedding</option>
            <option value="Denim">Denim</option>
            <option value="Holiday">Holiday</option>
            <option value="Modest">Modest Fashion</option>


            <option value="SequinEdit">Sequin Edit</option>
            <option value="Wintersun">Winter Sun</option>

            <option value="Caps">Caps & Hats</option>
            <option value="HairAccessories">Hair Accessories</option>
            <option value="Sunglass">Sunglass</option>
            <option value="Bags">Bags & purses</option>

            <option value="Earings">Earings</option>
            <option value="Necklace">Necklace</option>
            <option value="Bracelets">Bracelets</option>
            <option value="Rings">Rings</option>


            <option value="Makeup">Makeup</option>
            <option value="Skincare">Skincare</option>
            <option value="Haircare">Haircare</option>
            <option value="Bodycare">Bodycare</option>

            <option value="Trainers">Trainers</option>
            <option value="Activeaccessories">Activewear Accessories</option>
            <option value="Leggings">Leggings</option>
            <option value="Swim">Swim</option>
            <option value="Football">Football</option>
            <option value="Gymshoes">Gymshoes</option>

            <option value="Heels">Heels</option>
            <option value="Shoes">Shoes</option>
            <option value="Sandals">Sandals</option>

        </select><br>

        <label>Price (rs):</label>
        <input type="number" name="price" min="1" required><br>

        <label>Select Image:</label>
        <input type="file" name="image" accept="image/*" required><br>

        <label>Description:</label>
        <textarea name="description" required></textarea><br>

        <label>Quantity:</label>
        <textarea name="quantity" required></textarea><br>


        <button type="submit" name="submit">Add Product</button>
    </form>
</body>
</html>


<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $gender = $_POST['gender']; 

    // Image upload
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = "../images/" . $image_name;
    move_uploaded_file($image_tmp, $image_path);

    // Insert into database
    $sql = "INSERT INTO products (name, category, price, image, description, gender,quantity) 
            VALUES ('$name', '$category', '$price', '$image_name', '$description', '$gender','$quantity')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Product Added Successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

?>




<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "fashiondress";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET["id"])) {
    die("No dress selected.");
}

$dress_id = $_GET["id"];
$sql = "SELECT * FROM dresses WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $dress_id);
$stmt->execute();
$result = $stmt->get_result();
$dress = $result->fetch_assoc();

if (!$dress) {
    die("Dress not found.");
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Add to Cart - Wolfmania</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">

<div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <img class="w-full h-96 object-cover rounded-md" src="<?= htmlspecialchars($dress["image"]) ?>" 
                 alt="<?= htmlspecialchars($dress["dress_name"]) ?>">
        </div>
        <div>
            <h2 class="text-3xl font-bold"><?= htmlspecialchars($dress["dress_name"]) ?></h2>
            <p class="text-gray-600 mt-2">Color: <span class="font-semibold"><?= htmlspecialchars($dress["color"]) ?></span></p>
            <p class="text-gray-600 text-xl mt-2">$<?= number_format($dress["price"], 2) ?></p>
            
            <form action="checkout.php" method="POST">
                <input type="hidden" name="dress_id" value="<?= $dress["id"] ?>">
                <label for="size" class="block text-gray-700 mt-4">Select Size:</label>
                <select name="size" id="size" required class="mt-2 p-2 border rounded w-full">
                    <option value="">-- Select Size --</option>
                    <option value="S">Small (S)</option>
                    <option value="M">Medium (M)</option>
                    <option value="L">Large (L)</option>
                    <option value="XL">Extra Large (XL)</option>
                </select>

                <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded mt-4 w-full">Proceed to Checkout</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>

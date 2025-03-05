<?php
session_start();
$conn = new mysqli("localhost", "root", "", "fashion_store");

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch Existing User Profile Data
$sql = "SELECT * FROM user_profiles WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Default empty values if no profile found
if (!$user) {
    $user = [
        'address_line1' => '',
        'address_line2' => '',
        'city' => '',
        'postal_code' => '',
        'country' => '',
        'phone' => ''
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h3>Update Profile</h3>
<form method="POST" action="update_profile.php" id="#profile">
    <input type="text" name="address_line1" placeholder="Address Line 1" value="<?= htmlspecialchars($user['address_line1']); ?>" required>
    <input type="text" name="address_line2" placeholder="Address Line 2" value="<?= htmlspecialchars($user['address_line2']); ?>">
    <input type="text" name="city" placeholder="City" value="<?= htmlspecialchars($user['city']); ?>" required>
    <input type="text" name="postal_code" placeholder="Postal Code" value="<?= htmlspecialchars($user['postal_code']); ?>" required>
    <input type="text" name="country" placeholder="Country" value="<?= htmlspecialchars($user['country']); ?>" required>
    <input type="text" name="phone" placeholder="Phone" value="<?= htmlspecialchars($user['phone']); ?>" required>
    <button type="submit">Update</button>
</form> 
</body>
</html>


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

// Validate and Fetch Form Data
$address_line1 = trim($_POST['address_line1']);
$address_line2 = trim($_POST['address_line2']);
$city = trim($_POST['city']);
$postal_code = trim($_POST['postal_code']);
$country = trim($_POST['country']);
$phone = trim($_POST['phone']);

// Basic input validation
if (empty($address_line1) || empty($city) || empty($postal_code) || empty($country) || empty($phone)) {
    die("All required fields must be filled!");
}

// Check if Profile Exists
$check_sql = "SELECT user_id FROM user_profiles WHERE user_id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("i", $user_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

// Update or Insert Profile
if ($check_result->num_rows > 0) {
    $sql = "UPDATE user_profiles SET 
            address_line1 = ?, address_line2 = ?, city = ?, postal_code = ?, country = ?, phone = ?
            WHERE user_id = ?";
} else {
    $sql = "INSERT INTO user_profiles (address_line1, address_line2, city, postal_code, country, phone, user_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssi", $address_line1, $address_line2, $city, $postal_code, $country, $phone, $user_id);

if ($stmt->execute()) {
    $_SESSION['success_message'] = "Profile Updated Successfully!";
} else {
    $_SESSION['error_message'] = "Error Updating Profile!";
}

$stmt->close();
$conn->close();

// Redirect back to Profile Page
header("Location: profile.php");
exit();
?>

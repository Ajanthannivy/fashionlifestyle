<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "fashiondress");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$ic_number = $_POST['ic_number'];
$phone1 = $_POST['phone1'];
$phone2 = isset($_POST['phone2']) ? $_POST['phone2'] : NULL;
$address = $_POST['address'];
$postal_code = $_POST['postal_code'];
$interest = $_POST['interest'];

// Check if email exists in users table
$emailCheck = $conn->prepare("SELECT email FROM users WHERE email = ?");
$emailCheck->bind_param("s", $email);
$emailCheck->execute();
$result = $emailCheck->get_result();

if ($result->num_rows == 0) {
    echo "Error: Email is not registered in the users table.";
    exit();
}

// Insert into customers table
$stmt = $conn->prepare("INSERT INTO customers (full_name, email, ic_number, phone1, phone2, address, postal_code, interest) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $full_name, $email, $ic_number, $phone1, $phone2, $address, $postal_code, $interest);

if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>

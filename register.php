<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "fashion");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if all required fields are provided
if (!empty($_POST['email']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['password']) && !empty($_POST['date_of_birth']) && !empty($_POST['interest'])) {
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password = $_POST['password'];
    $date_of_birth = $_POST['date_of_birth']; // Expected format: YYYY-MM-DD
    $interest = $_POST['interest']; // 'womenswear' or 'menswear'

    // Check if email already exists
    $check = $conn->prepare("SELECT email FROM register_detail WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "The email address is already registered. Please try another.";
        echo '<a href="register.html">Try Again</a>';
    } else {
        // Securely hash the password
        $hashed_pass = md5($password); // You can replace md5 with password_hash for stronger encryption

        // Insert new record using prepared statement
        $query = $conn->prepare("
            INSERT INTO register_detail (email, first_name, last_name, password, date_of_birth, interestEnum) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $query->bind_param("ssssss", $email, $first_name, $last_name, $hashed_pass, $date_of_birth, $interest);

        if ($query->execute()) {
            echo "Thank you for registering.";
            echo '<a href="login.html">Click Here</a> to log in to your account.';
        } else {
            echo "Error: " . $conn->error;
        }
        $query->close();
    }
    $check->close();
} else {
    echo "All fields are required!";
}

$conn->close();
?>

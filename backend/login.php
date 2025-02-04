<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "fashion");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and validate form inputs
    $email = trim($_POST['email']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $password = $_POST['password'];
    $date_of_birth = $_POST['date_of_birth']; // Expected in YYYY-MM-DD format
    $interest = $_POST['interest']; // 'womenswear' or 'menswear'
    $subscribe = isset($_POST['subscribe']) ? 1 : 0; // Checkbox for subscription

    // Basic validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format. Please try again.");
    }

    if (empty($first_name) || empty($last_name) || empty($password) || empty($date_of_birth) || empty($interest)) {
        die("All fields are required!");
    }

    // Check if email already exists
    $check_query = $conn->prepare("SELECT email FROM register_detail WHERE email = ?");
    $check_query->bind_param("s", $email);
    $check_query->execute();
    $check_query->store_result();

    if ($check_query->num_rows > 0) {
        echo "The email address is already registered. Please try another.";
        echo '<a href="register.html">Try Again</a>';
    } else {
        // Securely hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert user data into the database
        $insert_query = $conn->prepare("
            INSERT INTO register_detail (email, first_name, last_name, password, date_of_birth, interestEnum, subscribe)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $insert_query->bind_param("ssssssi", $email, $first_name, $last_name, $hashed_password, $date_of_birth, $interest, $subscribe);

        if ($insert_query->execute()) {
            echo "Registration successful!";
            echo '<a href="login.html">Click here</a> to log in to your account.';
        } else {
            echo "Error: " . $conn->error;
        }

        $insert_query->close();
    }

    $check_query->close();
} else {
    echo "Invalid request method.";
}

$conn->close();
?>

<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST["first-name"]);
    $last_name = trim($_POST["last-name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $subscribe = isset($_POST["subscribe"]) ? 1 : 0;

    // Validate required fields
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        die("All fields are required!");
    }

    // Hash the password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert into the database
    $sql = "INSERT INTO users (first_name, last_name, email, password_hash, subscribed) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $first_name, $last_name, $email, $password_hash, $subscribe);

    if ($stmt->execute()) {
        echo "Account created successfully!";
        header("Location: customerlogin.html"); // Redirect to a success page
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

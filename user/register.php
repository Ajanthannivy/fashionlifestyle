<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);
    
    if ($stmt->execute()) {
        echo "<script>alert('Registration successful! You can now login.'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Registration failed! Try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register | Fashion Store</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>

/* General body styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4; /* Light background color */
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Form container */
form {
    background-color: #fff; /* White background for form */
    padding: 20px;
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Light shadow for form */
    width: 100%;
    max-width: 400px; /* Limit form width */
    box-sizing: border-box;
}

/* Heading styling */
h2 {
    text-align: center;
    color: #333; /* Dark text for heading */
}

/* Input field styling */
input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%; /* Full width of the form */
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ccc; /* Light border for inputs */
    border-radius: 4px; /* Rounded corners */
    box-sizing: border-box; /* Include padding and border in width */
    font-size: 16px; /* Font size */
}

/* Focus effect for input fields */
input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus {
    border-color: #007BFF; /* Blue border on focus */
    outline: none; /* Remove default focus outline */
}

/* Button styling */
button {
    background-color: #007BFF; /* Blue background color */
    color: white; /* White text */
    border: none; /* Remove border */
    padding: 12px 20px; /* Padding inside the button */
    font-size: 16px; /* Font size */
    cursor: pointer; /* Pointer cursor on hover */
    border-radius: 5px; /* Rounded corners */
    width: 100%; /* Full width of the form */
    transition: background-color 0.3s ease; /* Smooth transition for background color */
}

/* Button hover effect */
button:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

/* Link styling */
p {
    text-align: center;
    font-size: 14px;
    color: #555;
}

/* Link styling inside paragraph */
p a {
    color: #007BFF;
    text-decoration: none; /* Remove underline */
}

p a:hover {
    text-decoration: underline; /* Underline on hover */
}

</style>
<body>
    <form action="register.php" method="POST">
        <h2>Register</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Sign Up</button>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </form>
</body>
</html>

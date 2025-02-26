<?php
session_start();
include 'db.php';  // Include your database connection

// Check if a valid reset token is passed
if (!isset($_GET['token'])) {
    echo "Invalid token.";
    exit();
}

$token = $_GET['token'];

// Check if the token is valid by searching for it in the database
$stmt = $conn->prepare("SELECT id, email, token_expiry FROM users WHERE reset_token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

// Check if a user with the given token exists
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $expiry_time = new DateTime($row['token_expiry']);
    $current_time = new DateTime();

    // Check if the token is expired
    if ($current_time > $expiry_time) {
        echo "Token has expired.";
        exit();
    }

    // The token is valid, allow the user to reset the password
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if ($new_password !== $confirm_password) {
            echo "Passwords do not match.";
        } else {
            // Hash the new password before storing it
            $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the database and remove the reset token
            $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, token_expiry = NULL WHERE reset_token = ?");
            $stmt->bind_param("ss", $new_hashed_password, $token);

            if ($stmt->execute()) {
                echo "Your password has been reset successfully.";
                // Redirect to login page after successful reset
                echo "<script>window.location.href='login.php';</script>";
            } else {
                echo "Error resetting password.";
            }
        }
    }
} else {
    echo "Invalid or expired token.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin-top: 50px;
        }
        .container {
            background: white;
            padding: 20px;
            width: 300px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background: #28a745;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Reset Your Password</h2>
    <form method="POST">
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
        <button type="submit">Reset Password</button>
    </form>
</div>

</body>
</html>

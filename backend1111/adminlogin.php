<?php
// Start session
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "fashiondress");

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Check if email and password are submitted via POST
if (isset($_POST['email'], $_POST['password'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        // Prepare the query to check the email
        $query = $conn->prepare("SELECT id, password FROM adminregister WHERE email = ?");
        if ($query) {
            $query->bind_param("s", $email);
            $query->execute();
            $query->store_result();

            if ($query->num_rows > 0) {
                $query->bind_result($user_id, $stored_password);
                $query->fetch();

                // Hash the provided password and compare with the stored one
                $hashed_password = md5($password);

                if ($stored_password === $hashed_password) {
                    // Successful login
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['email'] = $email;
                    echo "success"; // Send success response
                } else {
                    echo "Invalid email or password."; // Incorrect password
                }
            } else {
                echo "Invalid email or password."; // Email not found
            }
            $query->close();
        } else {
            echo "Error preparing query: " . $conn->error;
        }
    } else {
        echo "Both email and password are required.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>

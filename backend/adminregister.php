<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "fashiondress");

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Check if email and password are submitted
if (isset($_POST['email'], $_POST['password'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Ensure email and password are not empty
    if (!empty($email) && !empty($password)) {
        // Check if email already exists
        $query = $conn->prepare("SELECT id FROM adminregister WHERE email = ?");
        if ($query) {
            $query->bind_param("s", $email);
            $query->execute();
            $query->store_result();

            if ($query->num_rows > 0) {
                echo "The email is already registered. Please use another email.";
            } else {
                // Hash the password for security
                $hashed_password = md5($password);

                // Insert new user into the database
                $insert = $conn->prepare("INSERT INTO adminregister (email, password) VALUES (?, ?)");
                if ($insert) {
                    $insert->bind_param("ss", $email, $hashed_password);
                    if ($insert->execute()) {
                        echo "success"; // Indicate successful registration
                    } else {
                        echo "Error: Unable to register. Please try again.";
                    }
                    $insert->close();
                } else {
                    echo "Error preparing insert statement: " . $conn->error;
                }
            }
            $query->close();
        } else {
            echo "Error preparing select statement: " . $conn->error;
        }
    } else {
        echo "Email and password are required.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>

<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "fashiondress");

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Check if name, email, password, and confirm password are submitted
if (isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirm-password'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm-password']);

    // Ensure name, email, and password are not empty and passwords match
    if (!empty($name) && !empty($email) && !empty($password) && !empty($confirmPassword)) {
        if ($password !== $confirmPassword) {
            echo "Passwords do not match.";
        } else {
            // Check if email already exists
            $query = $conn->prepare("SELECT id FROM users WHERE email = ?");
            if ($query) {
                $query->bind_param("s", $email);
                $query->execute();
                $query->store_result();

                if ($query->num_rows > 0) {
                    echo "The email is already registered. Please use another email.";
                } else {
                    // Hash the password for security
                    $hashed_password = md5($password);

                    // Insert new customer into the database
                    $insert = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
                    if ($insert) {
                        $insert->bind_param("sss", $name, $email, $hashed_password);
                        if ($insert->execute()) {
                            // Redirect to registration page with email as a URL parameter
                            header("Location: registration.php?email=" . urlencode($email));
                            exit(); // Make sure to call exit after the header to stop further execution
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
        }
    } else {
        echo "Name, email, password, and confirm password are required.";
    }
} else {
    echo "Invalid request. Please ensure all fields are filled out correctly.";
}

$conn->close();
?>

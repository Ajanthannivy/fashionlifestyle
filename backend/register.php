<?php
// Establishing database connection
$servername = "localhost"; // Database server
$username = "root";        // Database username
$password = "";            // Database password
$dbname = "fashiondress";  // Database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for a connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $address = $_POST['address'];
    $postal_code = $_POST['postal_code'];
    $interest = $_POST['interest'];

    // Insert data into the userregister table
    $sql = "INSERT INTO userregister (email, first_name, last_name, date_of_birth, address, postal_code, interest) 
            VALUES ('$email', '$first_name', '$last_name', '$date_of_birth', '$address', '$postal_code', '$interest')";
 if ($conn->query($sql) === TRUE) {
    // Store email in session
    $_SESSION['user_email'] = $email;

    // Redirect to My Account page with email in URL
    header("Location: myaccount.php?email=" . urlencode($email));
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>

<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "fashiondress");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch customer details from the database
$email = "bavimohan23@gmail.com"; // You can get this dynamically from session or GET request
$stmt = $conn->prepare("SELECT full_name, email, ic_number, phone1, phone2, address, postal_code, interest FROM customers WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Customer Details</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 40px;
                background-color: #f9f9f9;
            }
            .container {
                max-width: 600px;
                background: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            h2 {
                text-align: center;
                color: #333;
            }
            p {
                font-size: 16px;
                color: #555;
                line-height: 1.6;
            }
            .highlight {
                font-weight: bold;
                color: #000;
            }
        </style>
    </head>
    <body>

        <div class="container">
            <h2>Customer Details</h2>
            <p><span class="highlight">Full Name:</span> <?php echo htmlspecialchars($row['full_name']); ?></p>
            <p><span class="highlight">Email:</span> <?php echo htmlspecialchars($row['email']); ?></p>
            <p><span class="highlight">IC Number:</span> <?php echo htmlspecialchars($row['ic_number']); ?></p>
            <p><span class="highlight">Phone Number 1:</span> <?php echo htmlspecialchars($row['phone1']); ?></p>
            <p><span class="highlight">Phone Number 2:</span> <?php echo htmlspecialchars($row['phone2']); ?></p>
            <p><span class="highlight">Address:</span> <?php echo htmlspecialchars($row['address']); ?></p>
            <p><span class="highlight">Postal Code:</span> <?php echo htmlspecialchars($row['postal_code']); ?></p>
            <p><span class="highlight">Interest:</span> <?php echo htmlspecialchars(ucfirst($row['interest'])); ?></p>
        </div>

    </body>
    </html>

    <?php
} else {
    echo "<p>No customer details found.</p>";
}

$conn->close();
?>

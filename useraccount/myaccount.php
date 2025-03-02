<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch the email from session (ensure it's set properly during login)
$email = $_SESSION['email'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account | Fashion Store</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f4f4f4;
        }
        .container {
            display: flex;
            width: 100%;
        }
        .sidebar {
            width: 250px;
            background-color: #333;
            color: white;
            padding: 20px;
            min-height: 100vh;
        }
        .sidebar h2 {
            margin-bottom: 20px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .sidebar ul li:hover, .sidebar ul li.active {
            background-color: #555;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
            background-color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .pagination {
            margin-top: 20px;
        }
        .pagination button {
            padding: 10px;
            border: none;
            cursor: pointer;
            margin: 5px;
        }
        .pagination .active {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }
		
    </style>
    <script>
	
	function loadContent(section) {
    const contentFrame = document.getElementById('content-frame');

    if (section === 'customers') {
        fetch('cusdetailsview.php')
            .then(response => response.text())
            .then(data => {
                contentFrame.innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching customer data:', error);
                contentFrame.innerHTML = "<p>Error loading customer data.</p>";
            });
    } else if (section === 'AddCustomerdetails') {
        fetch('cusdetail.html?' + new Date().getTime()) // Prevent caching
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                contentFrame.innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching customer details:', error);
                contentFrame.innerHTML = "<p>Error loading customer details.</p>";
            });
    } else {
        contentFrame.innerHTML = `<h1>${section.charAt(0).toUpperCase() + section.slice(1)}</h1><p>Details about ${section} will appear here.</p>`;
    }
}

    </script>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2>NC Fashion</h2>
            <h3>HELLO <?php echo strtoupper($_SESSION['username']); ?></h3>
            <ul>
			
                <li onclick="loadContent('dashboard')">Dashboard</li>
				<li onclick="loadContent('AddCustomerdetails')">AddCustomerdetails</li>
                <li onclick="loadContent('products')">Products</li>
                <li onclick="loadContent('customers')">Customers</li>
				<li onclick="loadContent('orders')">Orders</li>
                <li onclick="loadContent('products')">Products</li>
                <li onclick="loadContent('payments')">Payments</li>
                <li onclick="loadContent('reports')">Reports</li>
                <li onclick="loadContent('settings')">Settings</li>
            </ul>
        </aside>
        <main class="content" id="content-frame">
            <h1>Welcome to NC Fashion Dashboard</h1>
        </main>
    </div>
</body>
</html>

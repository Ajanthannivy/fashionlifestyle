<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Account | Fashion Store</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .account-container {
            display: flex;
            width: 100%;
        }
        .sidebar {
            width: 25%;
            padding: 20px;
            background: #f4f4f4;
            min-height: 100vh;
        }
        .main-content {
            width: 75%;
            padding: 20px;
            text-align: center;
        }
        .loading {
            text-align: center;
            font-size: 16px;
            color: gray;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="account-container">
        <!-- Sidebar Menu -->
        <div class="sidebar">
            <h2>HELLO <?php echo strtoupper($_SESSION['username']); ?></h2>
            <ul>
                <li><a href="#" class="menu-link" data-section="address">Address Book</a></li>
                <li><a href="#" class="menu-link" data-section="account-info">Account Information</a></li>
                <li><a href="#" class="menu-link" data-section="orders">My Orders</a></li>
                <li><a href="#" class="menu-link" data-section="wishlist">My Wishlist</a></li>
                <li><a href="logout.php" class="logout-button">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="main-content" id="content-area">
            <h3>Welcome to Your Account</h3>
            <p>Select an option from the menu.</p>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $(".menu-link").click(function(e) {
            e.preventDefault(); // Prevent default link behavior

            var section = $(this).data("section");
            var pageUrl = "";

            // Define URLs for external pages
            var externalPages = {
                "address": "cusdetail.html",
                "account-info": "cusdetailsview.php",
                "orders": "myorder.php",
                "wishlist": "mywishlist.php"
            };

            // Show a loading message
            $("#content-area").html("<div class='loading'>Loading...</div>");

            // Load content dynamically
            if (externalPages[section]) {
                pageUrl = externalPages[section];

                $("#content-area").load(pageUrl, function(response, status, xhr) {
                    if (status === "error") {
                        $("#content-area").html("<p>Failed to load content. Please try again.</p>");
                    }
                });
            }
        });
    });
    </script>

</body>
</html>
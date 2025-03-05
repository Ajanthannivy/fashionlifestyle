<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        .order-item {
            padding: 15px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: flex;
            align-items: center;
        }

        .order-item img {
            margin-right: 15px;
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .orders i {
            margin-right: 10px;
        }

        body {
    font-family: 'Roboto', sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}
.container {
    display: flex;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}
.sidebar {
    width: 25%;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.sidebar img {
    border-radius: 50%;
    width: 80px;
    height: 80px;
}
.sidebar h2 {
    font-size: 18px;
    margin: 10px 0;
}
.sidebar p {
    font-size: 14px;
    color: #666;
}
.sidebar ul {
    list-style: none;
    padding: 0;
}
.sidebar ul li {
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}
.sidebar ul li a {
    text-decoration: none;
    color: #333;
    display: flex;
    align-items: center;
}
.sidebar ul li a i {
    margin-right: 10px;
}
.sidebar ul li.active a {
    color: #0070f3;
}
.content {
    width: 75%;
    padding: 20px;
}
.content h1 {
    font-size: 24px;
    margin-bottom: 20px;
}
.content .orders {
    background-color: #fff;
    padding: 20px;
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.content .orders i {
    font-size: 50px;
    color: #333;
    margin-bottom: 20px;
}
.content .orders p {
    font-size: 16px;
    color: #333;
    margin: 10px 0;
}
.content .orders button {
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-size: 14px;
}
.footer {
    text-align: center;
    padding: 20px;
    font-size: 12px;
    color: #666;
}
.footer a {
    color: #666;
    text-decoration: none;
    margin: 0 10px;
}
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.header img {
    height: 40px;
}
.header h1 {
    font-size: 18px;
    margin: 0;
}
.header .logo {
    display: flex;
    align-items: center;
}
.header .logo img {
    margin-right: 10px;
}
@media (max-width: 768px) {
    .container {
        flex-direction: column;
    }
    .sidebar, .content {
        width: 100%;
    }
}
    </style>
</head>
<body>

<div class="header">
    <div class="logo">
        <img alt="Logo" height="40" src="logo.png" width="100"/>
    </div>
    <h1>MY ACCOUNT</h1>
    <img alt="Logo" height="40" src="logo.png" width="100"/>
</div>

<div class="container">
    <div class="sidebar">
        <img alt="User profile picture" height="80" src="img/design3.jpg" width="80"/>
        <h2>Hi, User</h2>
        <p>Welcome back!</p>
        <ul>
            <li><a href="javascript:void(0);" id="myOrdersLink"><i class="fas fa-box"></i> My Orders</a></li>
            <li><a href="#"><i class="fas fa-question-circle"></i> Need help?</a></li>
            <li><a href="#"><i class="fas fa-gift"></i> Gift cards & vouchers</a></li>
            <li><a href="profile.php#profile"><i class="fas fa-user"></i> My details</a></li>
            <li><a href="#"><i class="fas fa-lock"></i> Change password</a></li>
            <li><a href="#"><i class="fas fa-address-book"></i> Address book</a></li>
            <li><a href="#"><i class="fas fa-credit-card"></i> Payment methods</a></li>
            <li><a href="#"><i class="fas fa-comment-dots"></i> Contact preferences</a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i> Sign out</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>My Orders</h1>
        <div class="orders">
            <i class="fas fa-spinner fa-spin"></i> Loading...
        </div>
    </div>
</div>

<div class="footer">
    <a href="index.html">Nc Fashion Homepage</a>
    <a href="#">Terms & Conditions</a>
    <a href="#">Privacy Policy</a>
    <p>© ASOS 2025</p>
</div>

<script>
document.getElementById('myOrdersLink').addEventListener('click', function() {
    // Clear any existing content
    document.querySelector('.content').innerHTML = '<h1>My Orders</h1><div class="orders"><i class="fas fa-spinner fa-spin"></i> Loading...</div>';

    // Fetch the orders via AJAX
    fetch('get_orders.php')
        .then(response => response.json())
        .then(data => {
            const content = document.querySelector('.content');
            
            if (data.error) {
                content.innerHTML = `<p>${data.error}</p>`;
            } else if (data.length === 0) {
                content.innerHTML = '<p>You currently have no orders.</p><p>Best get shopping NC pronto...</p><button>Start Shopping</button>';
            } else {
                let ordersHtml = '<h1>Your Orders</h1>';
                data.forEach(order => {
                    ordersHtml += `<div class="order-item">
                                    <p><strong>Order ID:</strong> ${order.id}</p>
                                    <p><strong>Status:</strong> ${order.status}</p>
                                    <p><strong>Ordered on:</strong> ${order.order_date}</p>
                                    <p><strong>Total:</strong> ${order.total_amount}</p>
                                </div>`;
                });
                content.innerHTML = ordersHtml;
            }
        })
        .catch(error => {
            document.querySelector('.content').innerHTML = '<p>Error loading orders. Please try again later.</p>';
        });
});
</script>

</body>
</html>

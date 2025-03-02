<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user details from the database based on email
    $sql = "SELECT id, username, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        // Check password
        if (password_verify($password, $row['password'])) {
            // Store both username and email in session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];  // Save the username
            $_SESSION['email'] = $row['email'];        // Save the email
            
            // Redirect to the account page
            echo "<script>alert('Login successful!'); window.location.href='myaccount.php';</script>";
        } else {
            echo "<script>alert('Invalid credentials!');</script>";
        }
    } else {
        echo "<script>alert('User not found!');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login | Fashion Store</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function createParticles() {
            const particles = document.createElement('div');
            particles.classList.add('particles');
            document.body.appendChild(particles);
            for (let i = 0; i < 50; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                particles.appendChild(particle);
                let angle = Math.random() * Math.PI * 2;
                let speed = Math.random() * 0.5 + 0.2;
                setInterval(() => {
                    angle += 0.02;
                    particle.style.transform = `translate(${Math.cos(angle) * speed}vw, ${Math.sin(angle) * speed}vh)`;
                }, 50);
            }
        }
        window.onload = createParticles;
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        body {
            min-height: 100vh;
            background:black;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .container {
            position: relative;
            z-index: 1;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(0, 170, 255, 0.2);
            width: 400px;
        }
        h2 {
            color: #00aeff;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2em;
            text-shadow: 0 0 10px rgba(0, 170, 255, 0.5);
        }
        input {
            width: 100%;
            padding: 12px;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 16px;
            transition: all 0.3s ease;
            margin-bottom: 10px;
        }
        input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 15px rgba(0, 170, 255, 0.3);
        }
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(45deg, #00aeff, #0066ff);
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 10px;
        }
        button:hover {
            background: linear-gradient(45deg, #0066ff, #00aeff);
            box-shadow: 0 0 15px rgba(0, 170, 255, 0.5);
        }
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }
        .particle {
            position: absolute;
            width: 3px;
            height: 3px;
            background: rgba(0, 170, 255, 0.5);
            border-radius: 50%;
            left: calc(50% + (Math.random() * 100 - 50)vw);
            top: calc(50% + (Math.random() * 100 - 50)vh);
        }
        p a {
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <form action="login.php" method="POST">
                <h2>Login</h2>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
                <p><a href="forgetpassword.php">Forgot Password?</a></p>
                <p>Don't have an account? <a href="register.php">Sign Up</a></p>
            </form>
        </div>
    </div>
</body>
</html>

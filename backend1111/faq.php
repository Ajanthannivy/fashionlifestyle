<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "fashion");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch answered FAQs
$sql = "SELECT message, reply FROM questions WHERE status='answered'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Help & FAQs</title>
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>
    <style>
        :root {
            --color-light-pink: #afdde5;
            --color-pink: #964734;
            --color-dark-pink: #0fa4af;
            --color-deep-purple: #024950;
            --color-black:  #000000;
            --color-white: #ffffff;
            --color-border: #eee;
        }
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--color-light-pink);
            text-align: center;
        }
        header {
            background: var(--color-deep-purple);
            color: var(--color-white);
            padding: 1rem;
        }
        #faq {
            max-width: 600px;
            margin: 20px auto;
            background: var(--color-white);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .faq-item {
            margin-bottom: 10px;
        }
        .faq-question {
            background: var(--color-dark-pink);
            color: var(--color-white);
            border: none;
            width: 100%;
            padding: 10px;
            text-align: left;
            cursor: pointer;
            border-radius: 5px;
        }
        .faq-answer {
            display: none;
            padding: 10px;
            background: var(--color-border);
            border-radius: 5px;
        }
        #contact-form {
            max-width: 600px;
            margin: 20px auto;
            background: var(--color-white);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid var(--color-border);
            border-radius: 5px;
        }
        button {
            background: var(--color-pink);
            color: var(--color-white);
            border: none;
            padding: 10px;
            width: 100%;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background: var(--color-dark-pink);
        }
    </style>
</head>
<body>

    <header>
        <h1>Help & FAQs</h1>
    </header>

    <section id="faq">
        <input type="text" id="faq-search" placeholder="Search FAQs...">

        <!-- Static FAQs -->
        <div class="faq-item">
            <button class="faq-question">How do I track my order?</button>
            <div class="faq-answer">You can track your order by logging into your account and checking the 'Orders' section.</div>
        </div>
        <div class="faq-item">
            <button class="faq-question">What is your return policy?</button>
            <div class="faq-answer">We accept returns within 30 days. Items must be unworn and in original packaging.</div>
        </div>

        <!-- Dynamic FAQs from Database -->
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="faq-item">
                <button class="faq-question"><?= htmlspecialchars($row['message']) ?></button>
                <div class="faq-answer"><?= htmlspecialchars($row['reply']) ?></div>
            </div>
        <?php endwhile; ?>
    </section>

    <section id="contact-form">
        <h2>Still need help? Contact us</h2>
        <form action="process.php" method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" placeholder="Your Message" required></textarea>
            <button type="submit">Submit</button>
        </form>
    </section>

    <script>
        // JavaScript to toggle FAQ answers
        document.querySelectorAll('.faq-question').forEach(button => {
            button.addEventListener('click', () => {
                const answer = button.nextElementSibling;
                answer.style.display = (answer.style.display === 'block') ? 'none' : 'block';
            });
        });
    </script>

</body>
</html>

<?php
$conn->close();
?>

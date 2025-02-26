<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fashion";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Admin Reply
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reply'])) {
    $id = intval($_POST['id']);
    $reply = $conn->real_escape_string($_POST['reply']);

    $sql = "UPDATE questions SET reply='$reply', status='answered' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Reply sent successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch Unanswered Questions
$sql = "SELECT * FROM questions WHERE status='pending'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; }
        th { background: #964734; color: white; }
    </style>
</head>
<body>
    <h1>Admin Panel - Answer Questions</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Question</th>
            <th>Reply</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['message']) ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <textarea name="reply" required></textarea>
                        <button type="submit">Send Reply</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>

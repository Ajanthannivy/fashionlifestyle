<?php
include('db.php');
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT COUNT(*) AS count FROM cart WHERE user_id = '$user_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo $row['count']; // Cart item count return 
} else {
    echo "0"; // User login 
}
?>

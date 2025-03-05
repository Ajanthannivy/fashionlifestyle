<?php
include('db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Unauthorized Access!";
    exit();
}

if (isset($_POST['wishlist_id'])) {
    $wishlist_id = $_POST['wishlist_id'];

    $sql = "DELETE FROM wishlist WHERE id='$wishlist_id'";
    if ($conn->query($sql)) {
        header("Location: wishlist.php");
    } else {
        echo "Error removing item!";
    }
}
?>

<?php
include '../useraccount/db.php';

header('Content-Type: application/json');

$result = mysqli_query($conn, "SELECT * FROM wishlist");

$wishlist = [];
while ($row = mysqli_fetch_assoc($result)) {
    $wishlist[] = $row;
}

echo json_encode($wishlist);
?>




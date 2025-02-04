<?php
// Start session
session_start();

// Destroy the session to log out the user
session_destroy();

// Redirect to the home page or login page
header("Location: index.html"); // Redirect to home page or login page
exit();
?>

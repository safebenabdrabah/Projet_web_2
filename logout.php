<?php
session_start(); // Start session

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other page after logging out
    header("Location: login.php");
    exit;
} else {
    // If the user is not logged in, redirect them to the login page
    header("Location: login.php");
    exit;
}
?>

<?php
// Start PHP session
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    http_response_code(200);
    // Return a username from the session
    $username = $_SESSION['username'];
    echo $username;
} else {
    // Redirect the user to the login page if not logged in
    http_response_code(401);
}
?>

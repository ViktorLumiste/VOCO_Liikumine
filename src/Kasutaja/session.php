<?php
$c_name = $_POST['cname'];
// Start PHP session
session_start();

// Check if the user is logged in
if (isset($_SESSION[$c_name])) {
    http_response_code(200);
    // Return a username from the session
    $return = $_SESSION[$c_name];
    echo $return;
} else {
    // Redirect the user to the login page if not logged in
    http_response_code(401);
}
?>

<?php

// Database credentials
require '../Database.php';
global $conn;

// Get email and password from the form
$email = $_POST['loginEmail'];
$password = $_POST['loginPassword'];

// Perform a simple query to check user credentials
$sql = "SELECT Parool,Nimi FROM KASUTAJAD WHERE Email='$email'";
$result = $conn->query($sql);
// Get the password from the db
$results = mysqli_fetch_assoc($result);
$resultstring = $results['Parool'];
// Unhash the password
$unhashed = password_verify($password, $resultstring);
//Get the username from db
$username = $results['Nimi'] ;
// Check if the query was successful
if ($unhashed) {
    // Start PHP session
    session_start();

    // Set session variables
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;

    // User authentication successful
    http_response_code(200); // OK
    echo "Login successful!";
} else {
    // User authentication failed
    http_response_code(401); // Unauthorized
    echo "Login failed. Invalid email or password.";
}

// Close the database connection
$conn->close();
?>
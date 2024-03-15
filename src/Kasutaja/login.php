<?php

// Database credentials
require '../Database.php';
global $conn;

// Get email and password from the form
$email = $_POST['loginEmail'];
$password = $_POST['loginPassword'];

// Perform a simple query to check user credentials
$sql = "SELECT Parool,Nimi,Pilt, roll FROM KASUTAJAD WHERE Email='$email'";
$result = $conn->query($sql);
if ($result !== false && $result->num_rows > 0) {
    // Get the password from the db
    $results = mysqli_fetch_assoc($result);
    $resultstring = $results['Parool'];
    // Unhash the password
    $unhashed = password_verify($password, $resultstring);
    $username = $results['Nimi'] ;
    $pfp = $results['Pilt'] ;
    $role = $results['roll'];
    // Check if the query was successful
    if ($unhashed) {
        // Start PHP session
        session_start();

        // Set session variables
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['pfp'] = $pfp;
        $_SESSION['role'] = $role;

        // User authentication successful
        http_response_code(200); // OK
        echo "Login successful!";
    } else {
        // User authentication failed
        http_response_code(401); // Unauthorized
        echo "Login failed. Invalid email or password.";
    }
} else {
    http_response_code(401); // Unauthorized
    echo "Incorrect password or email.";
}
// Close the database connection
$conn->close();
?>
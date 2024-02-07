<?php

// Database credentials
$servername = "localhost";
$database = "lumisteviktor_VOCO_Liikumine";
$username = "lumisteviktor";
$password = "2$9?,bzk+VN0";

// Create connection for reading data
$conn = mysqli_connect($servername, $username, $password, $database);
// Check if the connection failed
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Get username and password from the form
$username = $_POST['loginName'];
$password = $_POST['loginPassword'];

// Perform a simple query to check user credentials
$sql = "SELECT Parool FROM KASUTAJAD WHERE Nimi='$username'";
$result = $conn->query($sql);
// Get the password from the db
$results = mysqli_fetch_assoc($result);
$resultstring = $results['Parool'];
// Unhash the password
$unhashed = password_verify($password, $resultstring);

// Check if the query was successful
if ($unhashed) {
    // Start PHP session
    session_start();

    // Set session variables
    $_SESSION['username'] = $username;

    // User authentication successful
    http_response_code(200); // OK
    echo "Login successful!";
} else {
    // User authentication failed
    http_response_code(401); // Unauthorized
    echo "Login failed. Invalid username or password.";
}

// Close the database connection
$conn->close();
?>
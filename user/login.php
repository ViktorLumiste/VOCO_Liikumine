<?php

// Database credentials
$servername = "localhost";
$database = "lumisteviktor_VOCO_Liikumine";
$username = "lumisteviktor";
$password = "2$9?,bzk+VN0";


// Create connection for reading data
$conn = mysqli_connect($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$username = $_POST['loginName'];
$password = $_POST['loginPassword'];

// Perform a simple query to check user credentials
$sql = "SELECT * FROM KASUTAJAD WHERE Nimi='$username' AND Parool='$password'";
$result = $conn->query($sql);

// Check if the query was successful
if ($result !== false && $result->num_rows > 0) {
    // User authentication successful
    http_response_code(200); // OK
    echo "Login successful!";
} else {
    // User authentication failed
    http_response_code(401); // Unauthorized
    echo "Login failed. Invalid username or password.";
}
echo $username;
echo $password;
// Close the database connection
$conn->close();
?>

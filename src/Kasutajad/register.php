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

// Get user data from the form
$name = $_POST['regName'];
$email = $_POST['regEmail'];
$password = $_POST['regPassword'];
$picture = null;
$phone = $_POST['regPhone'];
$role = $_POST['regRole'];


// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
// Insert the user data into the db
$sql = "INSERT INTO KASUTAJAD (Nimi, Email, Parool, Pilt, Telefon,roll) VALUES ('$name', '$email', '$hashedPassword', '$picture','$phone','$role')";

if ($conn->query($sql) === TRUE) {
    echo "User registered successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
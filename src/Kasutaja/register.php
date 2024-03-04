<?php

// Database credentials
require '../Database.php';
global $conn;

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
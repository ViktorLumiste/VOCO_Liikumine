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

// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert the user data into the db
$sql = "INSERT INTO KASUTAJAD (Nimi, Email, Parool, Pilt, Telefon, roll) VALUES ('$name', '$email', '$hashedPassword', '$picture','$phone','o')";

if ($conn->query($sql) === TRUE) {
    $lastInsertedId = $conn->insert_id;
    echo "User registered successfully. User ID: " . $lastInsertedId;
} else {
    echo "Error: <br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>

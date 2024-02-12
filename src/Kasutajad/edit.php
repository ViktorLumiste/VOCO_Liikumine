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
//Receive data from the front-end POST
$newUsername = $_POST['username'];
$newPassword = $_POST['password'];
$email = $_POST['email'];
//Rehash the new password
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
//Insert new data into the db
$sql = "UPDATE KASUTAJAD SET Nimi='$newUsername', Parool='$hashedPassword' where Email='$email';";

$result = $conn->query($sql);
$conn->close();
?>
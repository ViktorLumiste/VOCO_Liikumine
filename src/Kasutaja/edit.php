<?php

// Database credentials
require '../Database.php';
global $conn;
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
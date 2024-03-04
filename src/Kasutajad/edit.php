<?php

// Database credentials
require '../Database.php';
global $conn;

$newUsername = $_POST['username'];
$newPassword = $_POST['password'];
$newEmail = $_POST['newemail'];
$newPhone = $_POST['phone'];
$email = $_POST['email'];

$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

$sql = "UPDATE KASUTAJAD SET Nimi='$newUsername', Parool='$hashedPassword', Email='$newEmail', Telefon='$newPhone' where Email='$email';";

$result = $conn->query($sql);
echo $sql;
// Close the database connection
$conn->close();
?>
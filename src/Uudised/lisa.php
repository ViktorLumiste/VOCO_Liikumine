<?php

// Database credentials
require '../Database.php';
global $conn;

// Get news data from the form
$thumbnail = $_POST['thumbnail'];
$title = $_POST['title'];
$content = $_POST['content'];
$content = str_replace("'", "\'", $content);
session_start();
$user = $_SESSION['username'];


// Insert data into db
$sql1 = "SELECT Kasutaja_ID FROM KASUTAJAD WHERE Nimi='$user'";
$result = $conn->query($sql1);

if ($result !== false && $result->num_rows > 0) {
    $results = mysqli_fetch_assoc($result);
    $userID = $results['Kasutaja_ID'] ;

    $sql = "INSERT INTO UUDISED (Kasutaja_ID, Uudise_Pealkiri, Uudise_Sisu, Thumbnail) VALUES ('$userID', '$title', '$content', '$thumbnail')";

    if ($conn->query($sql) === TRUE) {
        echo "News added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

} else {
    echo "You are not logged in.";
}

// Close the database connection
$conn->close();
?>
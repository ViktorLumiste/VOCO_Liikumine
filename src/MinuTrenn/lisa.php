<?php
session_start(); // Start the session at the very beginning

// Database credentials
require '../Database.php';
global $conn;

// Get news data from the form
$thumbnail = $_POST['thumbnail'];
$title = $_POST['title'];
$content = $_POST['content'];
$content = str_replace("'", "\'", $content);
$date = $_POST['date'];

$user = $_SESSION['username'];

// Insert data into db
$sql1 = "SELECT * FROM KASUTAJAD WHERE Nimi='$user';";
$result = $conn->query($sql1);

if ($result !== false && $result->num_rows > 0) {
    $results = mysqli_fetch_assoc($result);
    $userID = $results['Kasutaja_ID'] ;
    
    $sql = "INSERT INTO SUNDMUSED (Kasutaja_ID, Sundmuse_Pealkiri, Sundmuse_Sisu, Thumbnail, Toimub) VALUES ('$userID', '$title', '$content', '$thumbnail', '$date')";

    if ($conn->query($sql) === TRUE) {
        echo "News added successfully";
    } else {
        echo "Error: " . $sql1 . $conn->error;
    }
    
} else {
    echo "You are not logged in.";
}

// Close the database connection
$conn->close();
?>
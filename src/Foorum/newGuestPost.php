<?php

// Database credentials
require '../Database.php';
global $conn;

$title = $_POST['title'];
$content = $_POST['content'];
$content = str_replace("'", "\'", $content);
$image = $_POST['image'];


$sql = "INSERT INTO FOORUM (Pealkiri, Tekst, Kasutaja_ID, Public, Pilt)VALUES('$title', '$content', 0, 't', '$image');";

if ($conn->query($sql) === TRUE) {
    echo "Post added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}




// Close the database connection
$conn->close();
?>
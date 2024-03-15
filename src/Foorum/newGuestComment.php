<?php
// Retrieve data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// Database credentials
require '../Database.php';
global $conn;

$content = $_POST['vastus'];
$content = str_replace("'", "\'", $content);
$PostID = $_POST['postId'];


$sql = "INSERT INTO FOORUM_REPLY (Vastus, Kasutaja_ID, Foorum_ID, Vastuse_Aeg)VALUES('$content', 1, '$PostID', NOW());";

if ($conn->query($sql) === TRUE) {
    echo "Comment added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}




// Close the database connection
$conn->close();
?>
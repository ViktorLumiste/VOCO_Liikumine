<?php
// Retrieve data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// Database credentials
require '../Database.php';
global $conn;

$content = $_POST['vastus'];
$PostID = $_POST['postId'];

session_start();
$username = $_SESSION['username'];

$sql1 = "SELECT Kasutaja_ID FROM KASUTAJAD WHERE Nimi='$username'";
$result = $conn->query($sql1);

if ($result !== false && $result->num_rows > 0) {
    $results = mysqli_fetch_assoc($result);
    $userID = $results['Kasutaja_ID'] ;

    $sql = "INSERT INTO FOORUM_REPLY (Vastus, Kasutaja_ID, Foorum_ID, Vastuse_Aeg)VALUES('$content', '$userID', '$PostID', NOW());";

    if ($conn->query($sql) === TRUE) {
        echo "Comment added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

} else {
    echo "You cant comment without logging in.";
}



// Close the database connection
$conn->close();
?>
<?php
// Retrieve data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// Database credentials
require '../Database.php';
global $conn;

$title = $_POST['title'];
$content = $_POST['content'];
$content = str_replace("'", "\'", $content);
$image = $_POST['image'];

session_start();
$username = $_SESSION['username'];

$sql1 = "SELECT Kasutaja_ID FROM KASUTAJAD WHERE Nimi='$username'";
$result = $conn->query($sql1);

if ($result !== false && $result->num_rows > 0) {
    $results = mysqli_fetch_assoc($result);
    $userID = $results['Kasutaja_ID'] ;
    $sql = "INSERT INTO FOORUM (Pealkiri, Tekst, Kasutaja_ID, Public, Pilt)VALUES('$title', '$content', $userID, 't', '$image');";

    if ($conn->query($sql) === TRUE) {
        echo "Post added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

} else {
    echo "You cant post without logging in.";
}



// Close the database connection
$conn->close();
?>
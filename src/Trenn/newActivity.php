<?php

// Database credentials
require '../Database.php';
global $conn;

$ID = $_POST['actType'];
$day = $_POST['actDay'];
$start = $_POST['actStart'];
$end = $_POST['actEnd'];
$max = $_POST['actMax'];
$location = $_POST['actPlace'];

session_start();
$username = $_SESSION['username'];

$sql1 = "SELECT Kasutaja_ID FROM KASUTAJAD WHERE Nimi='$username'";
$result = $conn->query($sql1);

if ($result !== false && $result->num_rows > 0) {
    $results = mysqli_fetch_assoc($result);
    
    $sql = "INSERT INTO TRENNID (Trenni_ID , Paev, Algab, Lopeb, Max_Osalejate_arv, Asukoht)VALUES('$ID', '$day', '$start', '$end', $max, '$location');";

    if ($conn->query($sql) === TRUE) {
        echo "Activity added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
} else {
    echo "You cant add activities without logging in.";
}



// Close the database connection
$conn->close();
?>
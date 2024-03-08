<?php
// Database credentials
require '../Database.php';
global $conn;

$aID = $_POST['ID'];

session_start();
$username = $_SESSION['username'];

$sql1 = "SELECT Kasutaja_ID FROM KASUTAJAD WHERE Nimi='$username'";
$result1 = $conn->query($sql1);

if ($result1 !== false && $result1->num_rows > 0) {
    $results = mysqli_fetch_assoc($result1);
    $userID = $results['Kasutaja_ID'];
    $sql = "SELECT * FROM KASUTAJA_REG_TRENNIS WHERE Trenni_ID = '$aID' AND Kasutaja_ID='$userID'";
    
    $result2 = $conn->query($sql); // Use a different variable for the second query

    if ($result2 !== false && $result2->num_rows > 0) {
        echo "User already reg'd to activity";
    } else {
        $sql = "INSERT INTO KASUTAJA_REG_TRENNIS (Trenni_ID, Kasutaja_ID) VALUES ('$aID', '$userID');";

        if ($conn->query($sql) === TRUE) {
            echo "User successfully reg'd to activity";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    echo "You can't reg without logging in.";
}

// Close the database connection
$conn->close();
?>

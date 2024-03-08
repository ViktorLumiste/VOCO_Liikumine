<?php
// Retrieve data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// Database credentials
require '../Database.php';
global $conn;

$id = $_POST['PostID'];

$sql = "SELECT r.Vastus as Vastus, r.Vastuse_Aeg as Vastuse_Aeg, (SELECT k.Nimi FROM KASUTAJAD k WHERE k.Kasutaja_ID=r.Kasutaja_ID) as Nimi FROM FOORUM_REPLY r WHERE Foorum_ID='$id'";
$result = $conn->query($sql);

$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}
echo json_encode($rows);

// Close the database connection
$conn->close();
?>
<?php
// Retrieve data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// Database credentials
require '../Database.php';
global $conn;

$sql = "SELECT k.Nimi as Nimi, f.Pealkiri as Pealkiri, f.Tekst as Tekst, f.Pilt as Pilt, f.Foorum_ID as Foorum_ID, f.Postimise_Aeg as Postimise_Aeg, f.Kinnitatud as Kinnitatud, (SELECT COUNT(Foorum_ID) FROM FOORUM_REPLY r WHERE r.Foorum_ID = f.Foorum_ID) as Comments FROM FOORUM f JOIN KASUTAJAD k ON f.Kasutaja_ID=k.Kasutaja_ID;";
$result = $conn->query($sql);

$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}
echo json_encode($rows);

// Close the database connection
$conn->close();
?>
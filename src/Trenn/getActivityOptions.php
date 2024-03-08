<?php
// Database credentials
require '../Database.php';
global $conn;

$sql = "SELECT Trenni_ID, Tegevus, Kirjeldus, Kellele FROM TRENNI_INFO";
$result = $conn->query($sql);

$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}
echo json_encode($rows);

// Close the database connection
$conn->close();
?>
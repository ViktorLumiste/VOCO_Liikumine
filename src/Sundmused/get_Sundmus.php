<?php
// Retrieve data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// Database credentials
require '../Database.php';
global $conn;

$id = $_POST['SundmusID'];

$sql = "SELECT * FROM SUNDMUSED WHERE Sundmuse_ID='$id'";
$result = $conn->query($sql);

$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}
echo json_encode($rows);

// Close the database connection
$conn->close();
?>
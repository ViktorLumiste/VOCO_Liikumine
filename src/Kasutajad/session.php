<?php
$servername = "localhost";
$database = "lumisteviktor_VOCO_Liikumine";
$username = "lumisteviktor";
$password = "2$9?,bzk+VN0";

$conn = mysqli_connect($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_GET['username'];

$sql = "SELECT Kasutaja_ID FROM KASUTAJAD WHERE Nimi='$username'";
$result = $conn->query($sql);

if ($result === false) {
    die("Query failed: " . $conn->error);
}

$results = mysqli_fetch_assoc($result);

$response = array('sessionID' => $results);
echo json_encode($response);
?>

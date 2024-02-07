<?php
//          WIP!!!
// Database credentials
$servername = "localhost";
$database = "lumisteviktor_VOCO_Liikumine";
$username = "lumisteviktor";
$password = "2$9?,bzk+VN0";


// Create connection for reading data
$conn = mysqli_connect($servername, $username, $password, $database);
// Check if the connection failed
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch schedule data from the database
$query = "SELECT Trenni_Nimi as activityName, DATE_FORMAT(Algab, '%H:%i') AS start_time, DATE_FORMAT(Lopeb, '%H:%i') AS end_time, DAYNAME(Paev) AS weekday FROM TRENNID ORDER BY start_time";
$result = $conn->query($query);

// Prepare data for JSON response
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Close the connection
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($data);
?>
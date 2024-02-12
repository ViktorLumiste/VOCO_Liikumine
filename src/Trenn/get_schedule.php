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
$query = "SELECT TRENNI_INFO.Tegevus as activityName, DATE_FORMAT(TRENNID.Algab, '%H:%i') AS start_time, DATE_FORMAT(TRENNID.Lopeb, '%H:%i') AS end_time, DAYNAME(TRENNID.Paev) AS weekday FROM TRENNID JOIN TRENNI_INFO ON TRENNID.Trenni_ID = TRENNI_INFO.Trenni_ID ORDER BY start_time";
$result = $conn->query($query);


// Initialize arrays for each weekday
$weekdayArrays = array(
    'Monday' => array(),
    'Tuesday' => array(),
    'Wednesday' => array(),
    'Thursday' => array(),
    'Friday' => array()
);

// Sort data into arrays based on weekday
while ($row = $result->fetch_assoc()) {
    $weekday = $row['weekday'];
    $weekdayArrays[$weekday][] = $row;
}
// Close the connection
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($data);
?>
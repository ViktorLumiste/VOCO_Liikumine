<?php
// Retrieve data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// Database credentials
require '../Database.php';
global $conn;

// Fetch schedule data from the database
$query = "SELECT TRENNI_INFO.Tegevus as activityName, DATE_FORMAT(TRENNID.Algab, '%H:%i') AS start_time, DATE_FORMAT(TRENNID.Lopeb, '%H:%i') AS end_time, DAYNAME(TRENNID.Paev) AS weekday, TRENNID.Asukoht as placeName, TRENNI_INFO.Kellele as targetName FROM TRENNID JOIN TRENNI_INFO ON TRENNID.Trenni_ID = TRENNI_INFO.Trenni_ID where (week(TRENNID.Paev)+1)=$data[weekNum] ORDER BY start_time";
$result = $conn->query($query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

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
echo json_encode($weekdayArrays);
?>
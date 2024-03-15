<?php
// Database credentials
require '../Database.php';
global $conn;

// Retrieve data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

session_start();
$user = $_SESSION['username'];

$sql1 = "SELECT Kasutaja_ID FROM KASUTAJAD WHERE Nimi='$user'";
$result = $conn->query($sql1);

if ($result !== false && $result->num_rows > 0) {
    
    $results = mysqli_fetch_assoc($result);
    $userID = $results['Kasutaja_ID'] ;
    
    
// Fetch schedule data from the database
$query = "SELECT TRENNID.TrenniAja_ID as ID,TRENNI_INFO.Tegevus as activityName,TRENNI_INFO.Kirjeldus as Description, (SELECT COUNT(*) from KASUTAJA_REG_TRENNIS r where r.Trenni_ID=TRENNID.TrenniAja_ID) as Cur_Ppl,
TRENNID.Max_Osalejate_arv as Max_Ppl, DATE_FORMAT(TRENNID.Algab, '%H:%i') AS start_time,
DATE_FORMAT(TRENNID.Lopeb, '%H:%i') AS end_time, DAYNAME(TRENNID.Paev) AS weekday, TRENNID.Asukoht as placeName,
TRENNI_INFO.Kellele as targetName
FROM TRENNID JOIN TRENNI_INFO ON TRENNID.Trenni_ID = TRENNI_INFO.Trenni_ID where (week(TRENNID.Paev)+1)=$data[weekNum] AND TRENNID.TrenniAja_ID IN (SELECT Trenni_ID FROM KASUTAJA_REG_TRENNIS WHERE Kasutaja_ID=$userID) ORDER BY start_time";
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
} else {
    echo "Uh oh, not logged in stinky.";
}
// Close the connection
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($weekdayArrays, JSON_UNESCAPED_UNICODE);
?>
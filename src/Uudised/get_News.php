<?php
// Retrieve data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// Database credentials
require '../Database.php';
global $conn;

$sql = "SELECT Uudise_Pealkiri, Uudise_Sisu, Thumbnail from UUDISED";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output news data as HTML cards
    while ($row = $result->fetch_assoc()) {
        echo '<div class="news-card">';
        echo '<h2>' . $row['Uudise_Pealkiri'] . '</h2>';
        echo '<img src="' . $row['Thumbnail'] . '" ></img>';
        // You can customize the length of the short content as needed
        echo '<p>' . substr($row['Uudise_Sisu'], 0, 100) . '...</p> <button>Loe edasi...</button></div>';
    }
} else {
    echo "No news found";
}

header('Content-Type: application/json');
?>
<?php
// Retrieve data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// Database credentials
require '../Database.php';
global $conn;

$sql = "SELECT Uudise_Pealkiri, Uudise_Sisu from UUDISED";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output news data as HTML cards
    while ($row = $result->fetch_assoc()) {
        echo '<div class="news-card">';
        echo '<h2>' . $row['title'] . '</h2>';
        // You can customize the length of the short content as needed
        echo '<p>' . substr($row['Uudise_Sisu'], 0, 100) . '...</p>';
        echo '</div>';
    }
} else {
    echo "No news found";
}

header('Content-Type: application/json');
?>
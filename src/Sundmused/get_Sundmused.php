<?php
// Retrieve data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// Database credentials
require '../Database.php';
global $conn;

$sql = "SELECT Sundmuse_Pealkiri, Sundmuse_Sisu, Thumbnail, Sundmuse_ID, Toimub from SUNDMUSED";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output news data as HTML cards
    while ($row = $result->fetch_assoc()) {
        echo '<div class="news-card">';
        echo '<h2>' . $row['Sundmuse_Pealkiri'] . '</h2>';
        echo '<p>Toimub: ' . $row['Toimub'] .'</p>';
        echo '<img src="' . $row['Thumbnail'] . '" ></img>';
        // You can customize the length of the short content as needed
        echo '<p>' . substr($row['Uudise_Sisu'], 0, 100) . '...</p> <button onclick="openSundmus(' . $row['Sundmuse_ID'] . ')" >Loe edasi...</button></div>';
    }
} else {
    echo "No news found";
}

header('Content-Type: application/json');
?>
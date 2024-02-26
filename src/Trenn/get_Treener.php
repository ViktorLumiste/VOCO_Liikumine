<?php
// Retrieve data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// Database credentials
require '../Database.php';
global $conn;

// Fetch schedule data from the database
$query = "SELECT Nimi, Email, Pilt, Telefon, Kirjeldus from KASUTAJAD where roll='t'";
$result = $conn->query($query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
$html = '';
// Close the connection
$conn->close();
while ($row = $result->fetch_assoc()){
    $html = $html . '<div class="treener">
                <table>
                    <tr>
                        <td><img src="../images/uudis1.png" alt="treener"></td>
                        <td>
                            <h2>Nimi</h2>
                            <p>Telefon</p>
                            <p>Email</p>
                            <p>Treeneri ala</p>
                        </td>
                        <td>
                            <h2>' .$row["Nimi"]. '</h2>
                            <p>' .$row["Telefon"]. '</p>
                            <p><a href="mailto:' .$row["Email"]. ' class="trainers_gmail">' .$row["Email"]. '</a>
                            </p>
                            <p class="Trainers_sport">' .$row["Kirjeldus"]. '</p>
                        </td>
                    </tr>
                </table>
            </div>';
    http_response_code(200); // OK
}
echo $html;

header('Content-Type: application/json');
?>
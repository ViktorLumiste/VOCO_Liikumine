<?php

// Database credentials
require '../Database.php';
global $conn;


$verifiCode = $_POST['verification'];
$email = $_POST['email'];
$newUsername = isset($_POST['username']) ? $_POST['username'] : null;
$newPassword = isset($_POST['password']) ? $_POST['password'] : null;
$newEmail = isset($_POST['newemail']) ? $_POST['newemail'] : null;
$newPhone = isset($_POST['phone']) ? $_POST['phone'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;





$idQuery = "SELECT * FROM TAASTAMIS_KOODID t JOIN KASUTAJAD k ON t.Kasutaja_ID=k.Kasutaja_ID WHERE k.Email = '$email' AND NOT t.StartTime < NOW() - INTERVAL 5 MINUTE ORDER BY StartTime DESC LIMIT 1";
$result = $conn->query($idQuery);

if ($result !== false && $result->num_rows > 0) {
    $results = mysqli_fetch_assoc($result);
    $userID = $results['Kasutaja_ID'] ;
    $userCode = $results['Kood'];
    if($userCode === $verifiCode){
        // Build the SQL query based on the fields that have values
        $sql = "UPDATE KASUTAJAD SET ";
        if (!empty($newUsername)) {
            $sql .= "Nimi='$newUsername', ";
        }
        if (!empty($newPassword)) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql .= "Parool='$hashedPassword', ";
        }
        if (!empty($newEmail)) {
            $sql .= "Email='$newEmail', ";
        }
        if (!empty($newPhone)) {
            $sql .= "Telefon='$newPhone', ";
        }

        // Remove the trailing comma and add the WHERE clause
        $sql = rtrim($sql, ", ") . " WHERE Email='$email';";

        $result = $conn->query($sql);
        http_response_code(200);
        $clearQuery = "DELETE FROM TAASTAMIS_KOODID WHERE StartTime < NOW() - INTERVAL 5 MINUTE OR Kasutaja_ID = $userID";
        $result = $conn->query($idQuery);
    } else {
        http_response_code(401);
    }

    // Close the database connection
}
$conn->close();
?>

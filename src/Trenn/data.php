<?php

// Database credentials
require '../Database.php';
global $conn;


// Wait until a user posts a request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Get the start time from the user
    $starttime = $_POST["starttime"];
    // SQL query to retrieve user data based on start time
    $sql = "SELECT k.Nimi, t.* FROM TRENNID t join KASUTAJAD k on t.Treeneri_ID=k.Kasutaja_ID WHERE t.Algab = '$starttime'";
    $result = $conn->query($sql);
    
    if ($result != false & $result->num_rows > 0) {
        // Display user data if any was found
        echo "<h2>Sports Data:</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "Treener: " . $row["Nimi"] . "<br>";
            echo "Kellele: " . $row["Kellele"] . "<br>";
            echo "Paev: " . $row["Paev"] . "<br>";
            echo "Algab: " . $row["Algab"] . "<br>";
            echo "Lopeb: " . $row["Lopeb"] . "<br>";
            echo "Max_Osalejate_arv: " . $row["Max_Osalejate_arv"] . "<br>";
        }
    } else {
        // No data found
        echo "No user found with the provided username.";
        echo $starttime . "<br>";
        echo $sql . "<br>";
    }
}
// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Data Retrieval</title>
</head>
<body>

<h2>Enter Username to Retrieve User Data</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Enter start time: <input type="time" name="starttime">
    <input type="submit" name="submit" value="Submit">
</form>


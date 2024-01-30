<?php

// Database credentials
$servername = "localhost";
$database = "lumisteviktor_VOCO_Liikumine";
$username = "lumisteviktor";
$password = "2$9?,bzk+VN0";


// Create connection for reading data
$conn = mysqli_connect($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $starttime = $_POST["starttime"];
    // SQL query to retrieve user data based on username
    $sql = "SELECT k.Nimi, t.* FROM TRENNID t join KASUTAJAD k on t.Treeneri_ID=k.Kasutaja_ID WHERE t.Algab = '$starttime'";
    $result = $conn->query($sql);
    
    if ($result != false & $result->num_rows > 0) {
        // Display user data
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
        echo "No user found with the provided username.";
        echo $starttime . "<br>";
        echo $sql . "<br>";
    }
}

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


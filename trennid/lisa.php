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
    $sql1 = "SELECT Kasutaja_ID, Nimi FROM KASUTAJAD where roll='t'";
    $result1 = $conn->query($sql1);
    
    if ($result1->num_rows > 0) {
        while ($row1 = $result1->fetch_assoc()) {
            $options[] = $row1;
        }
    }
    $dropdownOptions = "";
    foreach ($options as $option) {
        $dropdownOptions .= "<option value='{$option['Kasutaja_ID']}'>{$option['Nimi']}</option>";
    }
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $id = $_POST["options"];
    $role = $_POST["role"];
    $day = $_POST["day"];
    $start = $_POST["start"];
    $end = $_POST["end"];
    $max = $_POST["max"];
    $place = $_POST["place"];
    
    // Insert data into the database
    $sql = "INSERT INTO TRENNID (Treeneri_ID , Kellele, Paev, Algab, Lopeb, Max_Osalejate_arv, Asukoht) VALUES ('$id', '$role','$day', '$start', '$end','$max','$place')";

    if ($conn->query($sql) === TRUE) {
        echo "Workout details inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Workout Form</title>
</head>
<body>

<h2>Enter Workout Details</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="options">Select an option:</label>
        <select id="options" name="options">
            <?php echo $dropdownOptions; ?>
        </select><br>
    Kelle jaoks: <select type="select" name="role" required><br>
    <option value='ope'>Õpetaja</option>
    <option value='opi'>Õpilane</option>
    </select><br>
    Päev: <input type="date" name="day" required><br>
    Algab: <input type="time" name="start" required><br>
    Lõpeb: <input type="time" name="end" required><br>
    Max Osalejate Arv: <input type="number" name="max" required><br>
    Asukoht: <input type="text" name="place" required><br>
    <input type="submit" value="Submit">
</form>

</body>
</html>

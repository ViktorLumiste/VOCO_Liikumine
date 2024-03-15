<?php

// Database credentials
require '../Database.php';
global $conn;

//Find all users who have a coach role
$sql1 = "SELECT Kasutaja_ID, Nimi FROM KASUTAJAD where roll='t'";
$result1 = $conn->query($sql1);
//If there are any users with a coach role add them to a list
if ($result1->num_rows > 0) {
    while ($row1 = $result1->fetch_assoc()) {
        $options[] = $row1;
    }
}
//Add each user as a selection to the dropdown list of coaches
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
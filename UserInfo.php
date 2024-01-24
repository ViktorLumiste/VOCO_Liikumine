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
    $username = $_POST["username"];

    // SQL query to retrieve user data based on username
    $sql = "SELECT * FROM KASUTAJAD WHERE Nimi = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display user data
        echo "<h2>User Data:</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "Username: " . $row["Nimi"] . "<br>";
            echo "Email: " . $row["Email"] . "<br>";
            echo "Password: " . $row["Parool"] . "<br>";
            echo "Phone: " . $row["Telefon"] . "<br>";
            echo "Role: " . $row["roll"] . "<br>";// Replace with your actual column names
            // Add more fields as needed
        }
    } else {
        echo "No user found with the provided username.";
    }
}

// Close connection
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
    Enter Username: <input type="text" name="username">
    <input type="submit" name="submit" value="Submit">
</form>


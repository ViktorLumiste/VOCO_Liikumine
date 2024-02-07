<?php

// Database credentials
$servername = "localhost";
$database = "lumisteviktor_VOCO_Liikumine";
$username = "lumisteviktor";
$password = "2$9?,bzk+VN0";


// Create connection for reading data
$conn = mysqli_connect($servername, $username, $password, $database);
// Check if the connection failed
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Wait until the user sends a post request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username from the request
    $username = $_POST["username"];

    // Fetch column names only if a username is provided
    if (!empty($username)) {
        $result = $conn->query("SHOW COLUMNS FROM KASUTAJAD");
        // Check if results are empty
        if ($result === false) {
            die("Error retrieving column names: " . $conn->error);
        }
        // If results are not empty add them to an array
        $columns = array();
        while ($row = $result->fetch_assoc()) {
            $columns[] = $row['Field'];
        }
    }
    //Update the user data based on how many columns were changed
    foreach ($columns as $column) {
        if (isset($_POST[$column])) {
            $columnValue = $_POST[$column];

            $sql = "UPDATE KASUTAJAD SET $column='$columnValue' WHERE Nimi='$username'";

            if ($conn->query($sql) !== TRUE) {
                echo "Error updating $column: " . $conn->error;
            }
        }
    }

    echo "User data updated successfully";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Data Update</title>
</head>
<body>
    <h2>Update User Data</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" id="usernameInput" required>

        <br>

        <div id="columnInputs" style="display: none;">
            <?php
            //Display as many fields as the user has in database
            if (isset($columns)) {
                foreach ($columns as $column) {
                    echo "<label for='$column'>$column:</label>";
                    echo "<input type='text' name='$column'><br>";
                }
            }
            ?>
        </div>

        <br>

        <input type="submit" value="Update Data">
    </form>

    <script>
        // Show additional inputs once a username is entered
        document.getElementById('usernameInput').addEventListener('input', function() {
            document.getElementById('columnInputs').style.display = 'block';
        });
    </script>
</body>
</html>
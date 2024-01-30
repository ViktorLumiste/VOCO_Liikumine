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

    // Fetch column names only if a username is provided
    if (!empty($username)) {
        $result = $conn->query("SHOW COLUMNS FROM KASUTAJAD");

        if ($result === false) {
            die("Error retrieving column names: " . $conn->error);
        }

        $columns = array();
        while ($row = $result->fetch_assoc()) {
            $columns[] = $row['Field'];
        }
    }

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
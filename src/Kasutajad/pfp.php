<?php
// Database credentials
require '../Database.php';
global $conn;



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $targetDir = '../KasutajaPildid/';
    $randomName = uniqid() . '.png';
    $targetFile = $targetDir . $randomName;
    $email = $_POST['email'];
    $oldFile = $_POST['oldFile'];


    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {

        $sql = "UPDATE KASUTAJAD SET Pilt='$randomName' WHERE Email = '$email'";

        if ($conn->query($sql) === TRUE) {
            if (file_exists($targetDir. $oldFile)) {
                unlink($targetDir . $oldFile);
            }
            echo $randomName;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo 'Failed to upload image.';
    }
} else {
    echo 'Invalid request.';
}
?>
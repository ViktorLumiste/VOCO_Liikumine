<?php
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the necessary fields are set
    if (isset($_POST["category"]) && isset($_FILES["file"])) {
        // Get the category name
        $category = $_POST["category"];
        
        // Create a folder with the category name if it doesn't exist
        $folderPath = "./Categorys/" . $category;
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true); // Change permission as needed
        }

        // Get the image file details
        $file = $_FILES["file"];
        $fileName = $file["name"];
        $fileTmpName = $file["tmp_name"];

        // Move the uploaded file to the category folder
        $destination = $folderPath . "/" . $fileName;
        if (move_uploaded_file($fileTmpName, $destination)) {
            // File uploaded successfully
            echo "success";
        } else {
            // Error while moving the file
            echo "Error: Failed to move the file.";
        }
    } else {
        // Required fields are missing
        echo "invalid";
    }
} else {
    // Request method is not POST
    echo "Invalid request method.";
}
?>

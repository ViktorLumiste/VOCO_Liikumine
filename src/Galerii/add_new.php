<?php
// Check if the category data is sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the category name from the POST data
    $categoryName = isset($_POST['category']) ? $_POST['category'] : '';

    // Validate the category name (you may add more validation as needed)
    if (!empty($categoryName)) {
        // Specify the base directory where category folders will be created
        $baseDirectory = __DIR__ . '/Categorys/';

        // Create the full path for the new category folder
        $categoryDirectory = $baseDirectory . $categoryName;

        // Check if the category folder already exists
        if (!file_exists($categoryDirectory)) {
            // Attempt to create the new category folder
            if (mkdir($categoryDirectory)) {
                // Provide feedback to the user
                echo "success";
            } else {
                // Provide feedback to the user
                echo "Error creating category folder";
            }
        } else {
            // Provide feedback to the user
            echo "exists";
        }
    } else {
        // Provide feedback to the user
        echo "invalid";
    }
} else {
    // Provide feedback to the user
    echo "Invalid request method";
}
?>

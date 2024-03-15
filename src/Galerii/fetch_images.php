<?php

try {
    // Path to the main folder containing category folders
    $mainFolderPath = './Categorys';

    // Get list of category folders
    $categoryFolders = glob($mainFolderPath . '/*', GLOB_ONLYDIR);

    // Initialize an array to store category data
    $categoryData = array();

    // Loop through each category folder
    foreach ($categoryFolders as $categoryFolder) {
        // Get the folder name
        $folderName = basename($categoryFolder);

        // Get list of image files in the category folder (supports multiple image file types)
        $imageFiles = glob($categoryFolder . '/*.{jpg,jpeg,png,gif,bmp}', GLOB_BRACE);

        // Prepare data for each category
        $categoryData[] = array(
            'folderName' => $folderName,
            'images' => $imageFiles
        );
    }

    // Encode the array as JSON
    $jsonData = json_encode($categoryData);

    // Send data to the client-side JavaScript
    echo $jsonData;
} catch (Exception $e) {
    // Handle exceptions or errors
    echo "An error occurred: " . $e->getMessage();
}

?>

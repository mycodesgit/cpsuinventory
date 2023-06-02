<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Initialize an empty variable to store the error message
$errorMsg = '';

// Example code with an intentional error
$division = 10 / 0;

// Check if an error occurred
if (error_get_last()) {
    // Capture the error message
    $error = error_get_last();
    $errorMsg = $error['message'];
}

// Return the error message
echo $errorMsg;
?>

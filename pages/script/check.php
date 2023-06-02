<?php
// Assuming you have already established a database connection
include '../../../init.php';

if (isset($_POST['username'])) {
    $username = $_POST['username'];

    // Prepare and execute a SELECT query to check if the username exists
    $query = "SELECT COUNT(*) AS count FROM users WHERE username = ?";
    $statement = $DB->prepare($query);
    $statement->bind_param("s", $username);
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();
    $count = $row['count'];

    // Return response based on username availability
    if ($count > 0) {
        echo 'taken';
    } else {
        echo 'available';
    }
}
?>

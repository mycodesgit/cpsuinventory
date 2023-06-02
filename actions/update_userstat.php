<?php
include '../init.php';

if (isset($_GET['id']) && isset($_GET['stat'])) {
    $id = $_GET['id'];
    $stat = $_GET['stat'];

    // Update the device mode in the database
    $stmt = $DB->prepare("UPDATE users SET log_status = ? WHERE id = ?");
    $stmt->bind_param("ii", $stat, $id);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
}
?>

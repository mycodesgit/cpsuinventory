<?php
session_start();
if (isset($_SESSION[AUTH_ID])) {
    $stmt = $DB->prepare("UPDATE users SET log_status = 0 WHERE id = ?");
    $stmt->bind_param("i", $_SESSION[AUTH_ID]);
    $stmt->execute();

    session_destroy();

    session_start();
    set_message("<i class='fas fa-check'></i> Logout Successfully." . $DB->error, "success");
    header("Location: ./login");
    exit;

} else {
    header("Location: ./login");
    exit;
}

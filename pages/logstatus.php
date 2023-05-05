<?php
    include '../init.php';
    
    $id = $_GET['id'];
    $stmt = $DB->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_object();

    echo $user->log_status;
?>
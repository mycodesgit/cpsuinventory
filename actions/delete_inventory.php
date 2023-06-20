<?php

    include '../init.php';
    session_start();
    $id = $_GET['id'];

    $sql = "UPDATE ppei SET statdel='0' WHERE id=?";
    $stmt = $DB->prepare($sql);
    $stmt->bind_param("s", $id);
    if ($stmt->execute()) {

        $userid = $_SESSION['id'];
        $sql_insert1 =mysqli_query($DB,"INSERT INTO logs (user_id, ppei_id, action, created_at) VALUES ($userid, $id, 'del', NOW())");

        echo "deleted";
    } else {
        echo "error";
    }



?>

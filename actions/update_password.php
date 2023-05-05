<?php

if (isset($_POST['update'])) {
    $token = $_SESSION[AUTH_TOKEN];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    if (empty($error)) {

        $sql = "UPDATE users SET password=? WHERE token=?";

        $stmt = $DB->prepare($sql);
        $stmt->bind_param("ss", $password, $token);

        if($stmt->execute()){
            set_message("<i class='fa fa-check'></i> Password Updated Successfully",  'success');
        } else {
            set_message("<i class='fa fa-times'></i> Failed to Update Password" .$DB->error, 'danger');
        }
    }
}

?>

<?php

if (isset($_POST['btn-enduser'])) {
    $token = $_POST['token'];
    $end_user = $_POST['end_user'];
    if($end_user == 0){
        $end_user = $_POST['other_enduser'];
    }

    $sql = "UPDATE ppei SET end_user=? WHERE token=?";

    $stmt = $DB->prepare($sql);
    $stmt->bind_param("ss", $end_user, $token);

    if($stmt->execute()){
        set_message("<i class='fa fa-check'></i> End User Updated Successfully",  'success');
    } else {
        set_message("<i class='fa fa-times'></i> End User Failed to Update" .$DB->error, 'danger');
    }
}

?>


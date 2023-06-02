<?php

if (isset($_POST['btn-remarks'])) {
    $token = $_POST['token'];
    $remarks = $_POST['remarks'];
    if($remarks == 0){
        $remarks = $_POST['other_remarks'];
    }
    $reason = $_POST['reason'];

    
    $sql = "UPDATE ppei SET remarks=? WHERE token=?";

    $stmt = $DB->prepare($sql);
    $stmt->bind_param("ss", $remarks, $token);

    if($stmt->execute()){
        set_message("<i class='fa fa-check'></i> Remarks Updated Successfully",  'success');
    } else {
        set_message("<i class='fa fa-times'></i> Remarks Failed to Update" .$DB->error, 'danger');
    }
}

?>


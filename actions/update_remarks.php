<?php

if (isset($_POST['btn-remarks'])) {
    $token = $_POST['token'];
    $remarks = "Return";
    $return_qty = $_POST['reason'];
    $reason = $_POST['reason'];

    
    $sql = "UPDATE ppei SET remarks=?, reason=?, return_qty=?   WHERE token=?";

    $stmt = $DB->prepare($sql);
    $stmt->bind_param("ssss", $remarks, $reason, "return_qty-".$return_qty, $token);

    if($stmt->execute()){
        set_message("<i class='fa fa-check'></i> Remarks Updated Successfully",  'success');
    } else {
        set_message("<i class='fa fa-times'></i> Remarks Failed to Update" .$DB->error, 'danger');
    }
}

?>


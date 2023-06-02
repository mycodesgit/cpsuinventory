<?php
if (!defined('ACCESS')) {
    die('DIRECT ACCESS NOT ALLOWED');
}

if (isset($_POST['btn-update-ppei'])) {
    $token = $_POST['token'];
    $property_no = $_POST['property_no'];
    $qty = $_POST['qty'];
    $description = $_POST['description'];
    $acquisition_date = $_POST['acquisition_date'];
    $unit = $_POST['unit'];
    $unit_value = $_POST['unit_value'];
    $classification_id = $_POST['classification_id'];
    $end_user = $_POST['end_user'];
    $where_about = $_POST['where_about'];
    $serial_no = $_POST['serial_no'];
    $specification = $_POST['specification'];
    $remarks = $_POST['remarks'];

    if ($remarks == 0) {
        $remarks = $_POST['other_remarks'];
    }

    // Update the record without checking if the serial number exists
    $sql_insert = "UPDATE ppei SET property_no=?, qty=?, description=?, acquisition_date=?, unit=?, unit_value=?, classification_id=?, end_user=?, where_about=?, serial_no=?, specification=?, remarks=?, statdel=1 WHERE token=?";

    $stmt_insert = $DB->prepare($sql_insert);
    $stmt_insert->bind_param("sisssisssssss", $property_no, $qty, $description, $acquisition_date, $unit, $unit_value, $classification_id, $end_user, $where_about, $serial_no, $specification, $remarks, $token);

    if ($stmt_insert->execute()) {
        set_message("<i class='fa fa-check'></i> Update Successfully", 'success');
    } else {
        set_message("<i class='fa fa-times'></i> Failed to Add" . $DB->error, 'danger');
    }
}
?>

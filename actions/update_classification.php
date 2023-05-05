<?php

if (isset($_POST['btn-update'])) {
    $token = $_GET['token'];
    $class_name = $_POST['class_name'];
    $class_code = $_POST['class_code'];
    $updated_at = date("Y-m-d H:i:s");

    // Check if the office_name or office_abbr already exist
    $sql_check = "SELECT COUNT(*) AS count FROM classification WHERE (class_name = ? OR class_code = ?) AND token <> ?";
    $stmt_check = $DB->prepare($sql_check);
    $stmt_check->bind_param("sss", $class_name, $class_code, $token);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_count = $result_check->fetch_assoc()['count'];

    if ($row_count > 0) {
        set_message("<i class='fa fa-times'></i> Classification Name or Code Already Exists", 'danger');
    } else {
        if (empty($error)) {

            $sql = "UPDATE classification SET class_name=?, class_code=?, updated_at=? WHERE token=?";

            $stmt = $DB->prepare($sql);
            $stmt->bind_param("ssss", $class_name, $class_code, $updated_at, $token);

            if($stmt->execute()){
                set_message("<i class='fa fa-check'></i> Classification Updated Successfully",  'success');
            } else {
                set_message("<i class='fa fa-times'></i> Classification Failed to Update Password" .$DB->error, 'danger');
            }
        }
    }
}

?>


<?php

if (isset($_POST['btn-update'])) {
    $token = $_GET['token'];
    $office_name = $_POST['office_name'];
    $office_abbr = $_POST['office_abbr'];
    $updated_at = date("Y-m-d H:i:s");

    // Check if the office_name or office_abbr already exist
    $sql_check = "SELECT COUNT(*) AS count FROM offices WHERE (office_name = ? OR office_abbr = ?) AND token <> ?";
    $stmt_check = $DB->prepare($sql_check);
    $stmt_check->bind_param("sss", $office_name, $office_abbr, $token);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_count = $result_check->fetch_assoc()['count'];

    if ($row_count > 0) {
        set_message("<i class='fa fa-times'></i> Office Name or Abbreviation Already Exists", 'danger');
    } else {
        if (empty($error)) {

            $sql = "UPDATE offices SET office_name=?, office_abbr=?, updated_at=? WHERE token=?";

            $stmt = $DB->prepare($sql);
            $stmt->bind_param("ssss", $office_name, $office_abbr, $updated_at, $token);

            if($stmt->execute()){
                set_message("<i class='fa fa-check'></i> Office Updated Successfully",  'success');
            } else {
                set_message("<i class='fa fa-times'></i> Office Failed to Update Password" .$DB->error, 'danger');
            }
        }
    }
}

?>


<?php

if (isset($_POST['btn-update'])) {
    $token = $_GET['token'];
    $category_name = $_POST['category_name'];
    $updated_at = date("Y-m-d H:i:s");

    // Check if the office_name or office_abbr already exist
    $sql_check = "SELECT COUNT(*) AS count FROM category WHERE (category_name = ?) AND token <> ?";
    $stmt_check = $DB->prepare($sql_check);
    $stmt_check->bind_param("ss", $category_name, $token);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_count = $result_check->fetch_assoc()['count'];

    if ($row_count > 0) {
        set_message("<i class='fa fa-times'></i> Category Name Already Exists", 'danger');
    } else {
        if (empty($error)) {

            $sql = "UPDATE category SET category_name=?, updated_at=? WHERE token=?";

            $stmt = $DB->prepare($sql);
            $stmt->bind_param("sss", $category_name, $updated_at, $token);

            if($stmt->execute()){
                set_message("<i class='fa fa-check'></i> Category Updated Successfully",  'success');
            } else {
                set_message("<i class='fa fa-times'></i> Category Failed to Update" .$DB->error, 'danger');
            }
        }
    }
}

?>


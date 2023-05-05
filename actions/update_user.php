<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if (isset($_POST['btn-update'])) {
    $token = $_GET['token'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $emp_gender = $_POST['emp_gender'];
    $usertype = $_POST['usertype'];
    $updated_at = date("Y-m-d H:i:s");

    // Check if the office_name or office_abbr already exist
    $sql_check = "SELECT COUNT(*) AS count FROM users WHERE (username = ?) AND token <> ?";
    $stmt_check = $DB->prepare($sql_check);
    $stmt_check->bind_param("ss", $username, $token);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_count = $result_check->fetch_assoc()['count'];

    if ($row_count > 0) {
        set_message("<i class='fa fa-times'></i> Username Already Exists", 'danger');
    } else {

        if (empty($error)) {

            $sql = "UPDATE users SET fname=?, mname=?, lname=?, username=?, emp_gender=?, usertype=?, updated_at=? WHERE token=?";

            $stmt = $DB->prepare($sql);
            $stmt->bind_param("ssssssss", $fname, $mname, $lname, $username, $emp_gender, $usertype, $updated_at, $token);

            if($stmt->execute()){
                set_message("<i class='fa fa-check'></i> User Updated Successfully",  'success');
            } else {
                set_message("<i class='fa fa-times'></i> User Failed to Updated" .$DB->error, 'danger');
            }
        }
    }
}
?>

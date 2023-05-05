<?php

if (isset($_POST['btn-update'])) {
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $emp_gender = $_POST['emp_gender'];
    $usertype = $_POST['usertype'];
    $token = $_SESSION[AUTH_TOKEN];

    if (!empty($fname) && !empty($lname) && !empty($username)) {

        $sql = "UPDATE users SET fname=?, mname=?, lname=?, username=?, emp_gender=?, usertype=? WHERE token=?";

        $stmt = $DB->prepare($sql);
        $stmt->bind_param("sssssss", $fname, $mname, $lname, $username, $emp_gender, $usertype, $token);

        if($stmt->execute()){
            set_message("<i class='fa fa-check'></i> Employee Updated Successfully",  'success');
        } else {
            set_message("<i class='fa fa-times'></i> Employee Failed to Update" .$DB->error, 'danger');
        }
    }
}

?>

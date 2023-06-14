<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if (isset($_POST['btn-submit'])) {
    $class_name = $_POST['class_name'];
    $class_code = $_POST['class_code'];

    // Check if the office_name or office_abbr already exist
    $sql_check = "SELECT COUNT(*) AS count FROM classification WHERE class_name = ? OR class_code = ?";
    $stmt_check = $DB->prepare($sql_check);
    $stmt_check->bind_param("ss", $class_name, $class_code);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_count = $result_check->fetch_assoc()['count'];

    if ($row_count > 0) {
        set_message("<i class='fa fa-times'></i> Classification Name or Code Already Exists", 'danger');
    } else {
        // generate a token
        $token = bin2hex(random_bytes(16));

        if (!empty($class_name) && !empty($class_code)) {
            
            $sql_insert = "INSERT INTO classification SET class_name=?, class_code=?, token=?";

            $stmt_insert = $DB->prepare($sql_insert);
            $stmt_insert->bind_param("sss", $class_name, $class_code, $token);

            if($stmt_insert->execute()){
                set_message("<i class='fa fa-check'></i> Classification Added Successfully",  'success');
                //header("Location: ./classification");
            } else {
                set_message("<i class='fa fa-times'></i> Classification Failed to Add" .$DB->error, 'danger');
                //header("Location: ./classification");
            }
        }
    }
}
?>

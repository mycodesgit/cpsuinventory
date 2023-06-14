<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if (isset($_POST['btn-submit'])) {
    $office_name = $_POST['office_name'];
    $office_abbr = $_POST['office_abbr'];

    // Check if the office_name or office_abbr already exist
    $sql_check = "SELECT COUNT(*) AS count FROM offices WHERE office_name = ? OR office_abbr = ?";
    $stmt_check = $DB->prepare($sql_check);
    $stmt_check->bind_param("ss", $office_name, $office_abbr);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_count = $result_check->fetch_assoc()['count'];

    if ($row_count > 0) {
        set_message("<i class='fa fa-times'></i> Office Name or Abbreviation Already Exists", 'danger');
    } else {
        // generate a token
        $token = bin2hex(random_bytes(16));

        if (!empty($office_name) && !empty($office_abbr)) {

            $sql_insert = "INSERT INTO offices SET office_name=?, office_abbr=?, token=?";
            $stmt_insert = $DB->prepare($sql_insert);
            $stmt_insert->bind_param("sss", $office_name, $office_abbr, $token);

            if($stmt_insert->execute()){
                set_message("<i class='fa fa-check'></i> Office Added Successfully",  'success');
                //header("Location: ./offices");
            } else {
                set_message("<i class='fa fa-times'></i> Office Failed to Add" .$DB->error, 'danger');
                //header("Location: ./offices");
            }
        }
    }
}
?>
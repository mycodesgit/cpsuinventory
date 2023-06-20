<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if (isset($_POST['btn-submit'])) {
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
    
    if($remarks == 0){
        $remarks = $_POST['other_remarks'];
    }

    // Check if the office_name or office_abbr already exist
    $sql_check = "SELECT COUNT(*) AS count FROM ppei WHERE serial_no = ? AND statdel = 1";
    $stmt_check = $DB->prepare($sql_check);
    $stmt_check->bind_param("s", $serial_no);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_count = $result_check->fetch_assoc()['count'];

    if ($row_count > 0) {
        set_message("<i class='fa fa-times'></i> Serial Number Already Exists", 'danger');
    } else {
        // generate a token
        $token = bin2hex(random_bytes(16));

        if (!empty($serial_no)) {

            $sql_insert = "INSERT INTO ppei SET property_no=?, qty=?, description=?, acquisition_date=?, unit=?, unit_value=?, classification_id=?, end_user=?, where_about=?, serial_no=?, specification=?, remarks=?, token=?, statdel=1";

            $stmt_insert = $DB->prepare($sql_insert);
            $stmt_insert->bind_param("sisssisssssss", $property_no, $qty, $description, $acquisition_date, $unit, $unit_value, $classification_id, $end_user, $where_about, $serial_no, $specification, $remarks, $token);

            if($stmt_insert->execute()){
                $inserted_id = $stmt_insert->insert_id;
                $userid = $_SESSION['id'];
    
                $sql_insert1 =mysqli_query($DB,"INSERT INTO logs (user_id, ppei_id, action, created_at) VALUES ($userid, $inserted_id, 'in', NOW())");
                set_message("<i class='fa fa-check'></i> Added Successfully",  'success');
            } else {
                set_message("<i class='fa fa-times'></i> Failed to Add" .$DB->error, 'danger');
            }
        }
    }
}
?>

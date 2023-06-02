<?php

//import.php

header('Content-type: text/html; charset=utf-8');
header("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");

set_time_limit(0);

ob_implicit_flush(1);

session_start();

if(isset($_SESSION['csv_file_name'])) {
    //$connect = new PDO("mysql:host=localhost; dbname=testing", "root", "");
    $file_data = fopen('file/' . $_SESSION['csv_file_name'], 'r');
    fgetcsv($file_data);

    while($row = fgetcsv($file_data)) {
        $data = array(
            ':id' => $row[0],
            ':property_no' => $row[1],
            ':qty' => $row[2],
            ':serial_no' => $row[3],
            ':description' => $row[4],
            ':specification' => $row[5],
            ':acquisition_date' => $row[6],
            ':unit' => $row[7],
            ':unit_value' => $row[8],
            ':classification_id' => $row[9],
            ':end_user' => $row[10],
            ':where_about' => $row[11],
            ':remarks' => $row[12],
            ':reason' => $row[13],
            ':statdel' => $row[14],
            ':date_issued' => $row[15],
            ':token' => $row[16],
            ':created_at' => $row[17]
        );
        $query = "INSERT INTO tbl_sample (id, property_no, qty, serial_no, description, specification, acquisition_date, unit, unit_value, classification_id, end_user, where_about, remarks, reason, statdel, date_issued, token, created_at) 
                VALUES (:id, :property_no, :qty, :serial_no, :description, :specification, :acquisition_date, :unit, :unit_value, :classification_id, :end_user, :where_about, :remarks, :reason, :statdel, :date_issued, :token, :created_at)
        ";

        $statement = $DB->prepare($query);
        $statement->execute($data);

        sleep(1);

        if(ob_get_level() > 0) {
            ob_end_flush();
        }
    }
     unset($_SESSION['csv_file_name']);
}

?>
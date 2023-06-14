<?php
session_start();

include '../../init.php';
// $host = 'localhost';
// $username = 'root';
// $password = 'r@@t';
// $database = 'db_cpsuinventory';

// $conn = mysqli_connect($host, $username, $password, $database);

// Check the connection
// if (!$DB) {
//     die("Connection failed: " . mysqli_connect_error());
// }

if (!isset($_SESSION['end_user'])) {
    $end_user = "";
}
if (isset($_SESSION['end_user'])) {
    $end_user = $_SESSION['end_user'];
}

if (!isset($_SESSION['date1'])) {
    $date1 = "";
}
if (isset($_SESSION['date1'])) {
    $date1 = $_SESSION['date1'];
}

if (!isset($_SESSION['date2'])) {
    $date2 = "";
}
if (isset($_SESSION['date2'])) {
    $date2 = $_SESSION['date2'];
}

if (!isset($_SESSION['end_user']) && !isset($_SESSION['date1']) && !isset($_SESSION['date2'])) {
    $query = $DB->prepare("SELECT ppei.*, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr 
    FROM ppei 
    INNER JOIN classification ON classification.id = ppei.classification_id 
    INNER JOIN offices ON offices.id = ppei.where_about 
    WHERE statdel = 1 
    ORDER BY (remarks = 'Good Order and Condition') DESC, remarks ASC");
    $query->execute();
}
if (isset($_SESSION['end_user']) && isset($_SESSION['date1']) && isset($_SESSION['date2'])) {
    $query = $DB->prepare("SELECT ppei.*, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr 
    FROM ppei 
    INNER JOIN classification ON classification.id = ppei.classification_id 
    INNER JOIN offices ON offices.id = ppei.where_about 
    WHERE statdel = 1 AND ppei.end_user = ?
    AND ppei.acquisition_date BETWEEN ? AND ?");
    $query->bind_param('sss',$end_user, $date1, $date2);
    $query->execute();
}
if(!isset($_SESSION['end_user']) && isset($_SESSION['date1']) && isset($_SESSION['date2'])){
    $query = $DB->prepare("SELECT ppei.*, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr 
    FROM ppei 
    INNER JOIN classification ON classification.id = ppei.classification_id 
    INNER                     JOIN offices ON offices.id = ppei.where_about 
    WHERE statdel = 1  
    AND ppei.acquisition_date BETWEEN ? AND ?");
    $query->bind_param('ss',$date1, $date2);
    $query->execute();
}
if(isset($_SESSION['end_user']) && !isset($_SESSION['date1']) && !isset($_SESSION['date2'])){
    $query = $DB->prepare("SELECT ppei.*, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr 
    FROM ppei 
    INNER JOIN classification ON classification.id = ppei.classification_id 
    INNER                     JOIN offices ON offices.id = ppei.where_about 
    WHERE statdel = 1  
    AND ppei.end_user = ?");
    $query->bind_param('s', $end_user);
    $query->execute();
}

$result = $query->get_result();
$data = array();
if ($result->num_rows > 0) {
    $cnt = 1;
    while ($item = $result->fetch_object()) {
        $id = $item->id;
        $acq = $item->acquisition_date; 
        $qcq_date = date("M d, Y", strtotime($acq));
        $action = '
            <a data-toggle="modal" id="'.$item->token.'" data-target="#return" onclick="modalReturn(this.id)" class="btn btn-secondary btn-xs" title="return">
            <i class="fas fa-pen"></i>
            </a>
            <a href="./edit-inventory&token='.$item->token.'" class="btn btn-info btn-xs" title="Edit">
                <i class="fas fa-info-circle"></i>
            </a>
            <a data-toggle="modal" id="'.$item->token.'" data-target="#release" onclick="modalRelease(this.id)" class="btn btn-secondary btn-xs" title="release">
                <i class="fas fa-arrow-right"></i>
            </a>
            <a id="'.$item->id.'" onclick="deleteItem(this.id)" class="btn btn-danger btn-xs" title="Delete">
                <i class="fas fa-trash"></i>
            </a>
        ';
        $no = $cnt;
        $data[] = array(
            'no' => $no,
            'property_no' => $item->property_no,
            'qty' => $item->qty,
            'description' => $item->description,
            'serial_no' => $item->serial_no,
            'acquisition_date' => $qcq_date,
            'unit' => $item->unit,
            'unit_value' => number_format($item->unit_value, 2),
            'end_user' => $item->end_user,
            'where_about' => $item->office_abbr,
            'remarks' => $item->remarks,
            'action' => $action,
        );
        $cnt++;
    }
}

// Close the database connection
mysqli_close($DB);

// Prepare the response in JSON format
$response = array(
    'data' => $data
);

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>


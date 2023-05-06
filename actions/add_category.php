<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if (isset($_POST['btn-submit'])) {
    $category_name = $_POST['category_name'];
    // Check if the office_name or office_abbr already exist
    $sql_check = "SELECT COUNT(*) AS count FROM category WHERE category_name = ?";
    $stmt_check = $DB->prepare($sql_check);
    $stmt_check->bind_param("s", $category_name);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_count = $result_check->fetch_assoc()['count'];

    if ($row_count > 0) {
        set_message("<i class='fa fa-times'></i> Office Name or Abbreviation Already Exists", 'danger');
    } else {
        // generate a token
        $token = bin2hex(random_bytes(16));

        if (!empty($category_name)) {

            $sql_insert = "INSERT INTO category SET category_name=?, token=?";

            $stmt_insert = $DB->prepare($sql_insert);
            $stmt_insert->bind_param("ss", $category_name, $token);

            if($stmt_insert->execute()){
                set_message("<i class='fa fa-check'></i> Category Added Successfully",  'success');
            } else {
                set_message("<i class='fa fa-times'></i> Category Failed to Add" .$DB->error, 'danger');
            }
        }
    }
}
?>

<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if (isset($_POST['btn-setsessions'])) {
    if($_POST['category_id'] != ""){
        $category_id = $_POST['category_id'];
        $_SESSION['category_id'] = $category_id;
    }
    if($_POST['category_id'] == ""){
        unset($_SESSION['category_id']);
    }
    if($_POST['acquisition_date'] != ""){
        $acquisition_date = $_POST['acquisition_date'];
        $_SESSION['acquisition_date'] = $acquisition_date;
    }
    if($_POST['acquisition_date'] == ""){
        unset($_SESSION['acquisition_date']);
    }
    if($_POST['where_about'] != ""){
        $where_about = $_POST['where_about'];
        $_SESSION['where_about'] = $where_about;
    }
    if($_POST['where_about'] == ""){
        unset($_SESSION['where_about']);
    }
    if($_POST['end_user'] != ""){
        $end_user = $_POST['end_user'];
        $_SESSION['end_user'] = $end_user;
    }
    if($_POST['end_user'] == ""){
        unset($_SESSION['end_user']);
    }
}
?>

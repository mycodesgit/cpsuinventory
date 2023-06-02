<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if (isset($_POST['btn-setsessions'])) {
    if($_POST['where_about'] != ""){
        $where_about = $_POST['where_about'];
        $_SESSION['where_about1'] = $where_about;
    }
    if($_POST['where_about'] == ""){
        unset($_SESSION['where_about1']);
    }
    if($_POST['end_user'] != ""){
        $end_user = $_POST['end_user'];
        $_SESSION['end_user1'] = $end_user;
    }
    if($_POST['end_user'] == ""){
        unset($_SESSION['end_user1']);
    }
    if($_POST['date1'] != ""){
        $date1 = $_POST['date1'];
        $_SESSION['date11'] = $date1;
    }
    if($_POST['date1'] == ""){
        unset($_SESSION['date11']);
    }
    if($_POST['date2'] != ""){
        $date2 = $_POST['date2'];
        $_SESSION['date22'] = $date2;
    }
    if($_POST['date2'] == ""){
        unset($_SESSION['date22']);
    }
}
?>

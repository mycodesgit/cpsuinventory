<?php
$servername = "localhost";
$username = "root";
$password = "r@@t";
$dbname = "db_biometric";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
mysqli_set_charset($conn, 'utf8mb4');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "CREATE DATABASE $dbname";
if (mysqli_query($conn, $sql)) {
    echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <title>DLANHS | Biometric Login</title>

            <!-- Google Font: Source Sans Pro -->
            <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback'>
            <!-- Font Awesome -->
            <link rel='stylesheet' href='assets/adminLTE-3/plugins/fontawesome-free/css/all.min.css'>
            <!-- Theme style -->
            <link rel='stylesheet' href='assets/adminLTE-3/dist/css/adminlte.min.css'>
            <!-- Logo -->
            <link rel='shortcut icon' type='' href='assets//img/logo/DLANHS_logo.png'>

        </head>
        <body class='hold-transition login-page'>
            <div class='login-box'>
                <div class='card'>
                    <div class='card-body login-card-body'>
                        <center>
                            <img src='assets/img/logo/server.png' width='103px' height='100px'><br><br>
                            <h4 class='headline text-success'>
                                <i class='fas fa-check'></i> Database Created Successfully
                            </h4>
                            <a href='./login' class='btn btn-success btn-sm'>Done</a>
                        </center>
                    </div>
                </div>
            </div>
            <!-- jQuery -->
            <script src='assets/adminLTE-3/plugins/jquery/jquery.min.js'></script>
            <!-- Bootstrap 4 -->
            <script src='assets/adminLTE-3/plugins/bootstrap/js/bootstrap.bundle.min.js'></script>
            <!-- AdminLTE App -->
            <script src='assets/adminLTE-3/dist/js/adminlte.min.js'></script>
           
        </body>
        </html>
    ";
} else {
    echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <title>DLANHS | Biometric Login</title>

            <!-- Google Font: Source Sans Pro -->
            <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback'>
            <!-- Font Awesome -->
            <link rel='stylesheet' href='assets/adminLTE-3/plugins/fontawesome-free/css/all.min.css'>
            <!-- Theme style -->
            <link rel='stylesheet' href='assets/adminLTE-3/dist/css/adminlte.min.css'>
            <!-- Logo -->
            <link rel='shortcut icon' type='' href='assets//img/logo/DLANHS_logo.png'>

        </head>
        <body class='hold-transition login-page'>
            <div class='login-box'>
                <div class='card'>
                    <div class='card-body login-card-body'>
                        <center>
                            <img src='assets/img/logo/server.png' width='103px' height='100px'><br><br>
                            <h4 class='headline text-danger'>
                                <i class='fas fa-exclamation-triangle'></i> Error Creating Database:
                            </h4>
                        </center>
                        <h6 class='headline'>
                            <center>
                                <a href='./login' class='btn btn-success btn-sm'>Go Back</a>
                            </center>
                        </h6>
                    </div>
                </div>
            </div>
            <!-- jQuery -->
            <script src='assets/adminLTE-3/plugins/jquery/jquery.min.js'></script>
            <!-- Bootstrap 4 -->
            <script src='assets/adminLTE-3/plugins/bootstrap/js/bootstrap.bundle.min.js'></script>
            <!-- AdminLTE App -->
            <script src='assets/adminLTE-3/dist/js/adminlte.min.js'></script>
           
        </body>
        </html>
     " . mysqli_error($conn);
}

// Select the database
mysqli_select_db($conn, $dbname);

$password = mysqli_real_escape_string($conn, '$2y$10$DMeckYrbcEJ40CTac8xHiOMoXhSDUcrLQjjMyqsD.Pb3ExatXyn7q');
// SQL queries to create database, tables and insert data
$sql = "
        CREATE TABLE employee (
            `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `fname` varchar(30) NOT NULL,
            `mname` varchar(30) NOT NULL,
            `lname` varchar(30) NOT NULL,
            `username` varchar(30) NOT NULL,
            `password` char(255) NOT NULL,
            `emp_email` varchar(50) NOT NULL,
            `emp_birthdate` date NOT NULL,
            `emp_age` int(11) NOT NULL,
            `emp_contact` varchar(11) NOT NULL,
            `emp_gender` varchar(30) NOT NULL,
            `civil_status` varchar(30) NOT NULL,
            `emp_id` varchar(30) NOT NULL,
            `usertype` varchar(30) NOT NULL,
            `stat_bio` int(11) NOT NULL DEFAULT '0',
            `emp_address` varchar(200) NOT NULL,
            `token` varchar(200) NOT NULL,
            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` datetime NOT NULL
        );
        INSERT INTO employee (`id`, `fname`, `mname`, `lname`, `username`, `password`, `emp_email`, `emp_birthdate`, `emp_age`, `emp_contact`, `emp_gender`, `civil_status`, `emp_id`, `usertype`, `stat_bio`, `emp_address`, `token`, `created_at`, `updated_at`) 
        VALUES (1, 'JOHN', 'T', 'WICK', 'admin', '$password', 'admin@gmail.com', '1995-01-01', 28, '09123456789', 'Male', 'Single', 'E5031', 'Administrator', 0, 'admin address', 'bc73da01222532f6c7adbc57483200d3', '2023-04-23 15:28:54', '0000-00-00 00:00:00');

        CREATE TABLE users (
            `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `fname` varchar(30) NOT NULL,
            `mname` varchar(30) NOT NULL,
            `lname` varchar(30) NOT NULL,
            `username` varchar(30) NOT NULL,
            `password` char(255) NOT NULL,
            `emp_id` varchar(30) NOT NULL,
            `status` int(11) NOT NULL DEFAULT '1',
            `usertype` varchar(30) NOT NULL,
            `token` varchar(200) NOT NULL,
            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` date NOT NULL
        );
        INSERT INTO users (`id`, `fname`, `mname`, `lname`, `username`, `password`, `emp_id`, `status`, `usertype`, `token`, `created_at`, `updated_at`) 
        VALUES (1, 'JOHN', 'T', 'WICK', 'admin', '$password', 'E5031', 1, 'Administrator', 'bc73da01222532f6c7adbc57483200d3', '2023-04-23 15:28:54', '0000-00-00');

        ";

// Create SQL file
file_put_contents('db_biometric.sql', $sql);

//Execute SQL queries
if (mysqli_multi_query($conn, $sql)) {
    echo "";
} else {
    echo "";
}

// Close connection
mysqli_close($conn);
?>




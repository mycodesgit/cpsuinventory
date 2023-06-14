<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CPSU Supply | Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/adminLTE-3/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="assets/adminLTE-3/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/adminLTE-3/dist/css/adminlte.min.css">
    <!-- Logo -->
    <link rel="shortcut icon" type="" href="assets/adminLTE-3/img/logo.png">

    <style type="text/css">
        .login-box{
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2) !important;
        }
        .login-logo{
            -webkit-animation: showSlowlyElement 700ms !important; 
            animation: showSlowlyElement 700ms !important;
        }
        .input-group{
            -webkit-animation: showSlowlyElement 700ms !important; 
            animation: showSlowlyElement 700ms !important;
        }
        .icheck-primary{
            -webkit-animation: showSlowlyElement 700ms !important; 
            animation: showSlowlyElement 700ms !important;
        }
        .col-4{
            -webkit-animation: showSlowlyElement 700ms !important; 
            animation: showSlowlyElement 700ms !important;
        }
        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            background-color: #b0bbc7;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 50% 50%;
            /*z-index: -1;*/
        }
    </style>

</head>
<body class="hold-transition login-page">
    <div id="particles-js"></div>
    <div class="login-box">
    
        <div class="card">
            <div class="card-body login-card-body">
                <center>
                    <img src="assets/adminLTE-3/img/logo.png" class="img-circle" width="100px" height="100px">
                </center>

                <center style="font-size: 16pt; font-weight: bolder;">
                    <b>CPSU SUPPLY</b>
                </center>
                <p class="login-box-msg">Physical, Plant and Equipment Inventory</p>

                <?= show_message();?>

                <form method="post" id="quickForm">
                    <input type="hidden" name="action" value="validate_user">
                    <div class="input-group mb-3">
                        <input type="text" name="username" value="<?php echo old('username'); ?>" class="form-control" placeholder="Username" autofocus="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="myInput" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-success">
                                <input type="checkbox" id="remember" onclick="myFunction()">
                                <label for="remember">Show Password</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" style="background-color: #1f5036; border: #1f5036;">
                                <i class="fas fa-sign-in-alt"></i> Sign In
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Particles -->
    <script src="assets/particles/particles.js"></script>
    <script src="assets/particles/app.js"></script>
    <!-- jQuery -->
    <script src="assets/adminLTE-3/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/adminLTE-3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/adminLTE-3/dist/js/adminlte.min.js"></script>
    <!-- jquery-validation -->
    <script src="assets/adminLTE-3/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="assets/adminLTE-3/plugins/jquery-validation/additional-methods.min.js"></script>

    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

    <script>
        $(function () {
            $('#quickForm').validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 5
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                },
                messages: {
                    username: {
                        required: "Please enter a username",
                        username: "Please enter a valid username address",
                        minlength: "Your username must be at least 5 characters long"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
            });
        });
    </script>
</body>
</html>



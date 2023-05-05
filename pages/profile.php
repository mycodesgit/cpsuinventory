<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<?php
    $token = $_SESSION[AUTH_TOKEN];
    $stmt = $DB->prepare("SELECT * FROM users WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $emp = $result->fetch_object();
?>


<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-user"></i> Profile Account</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="./dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile Account</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
                <?= show_message(); ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-lock"></i> Change Password
                                </h3>
                            </div>
                            <!-- /.card-header -->
                             
                            <div class="card-body">
                                <form class="form-horizontal" method="post" id="updatePass">  
                                    <input type="hidden" name="action" value="update_password">

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <label for="exampleInputName">New Password:</label>
                                                <input type="text" name="password" placeholder="Enter New Password"class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button type="reset" class="btn btn-danger">
                                                    Clear
                                                </button>
                                                <button type="submit" name="update" class="btn btn-primary">
                                                    <i class="fas fa-save"></i> Update
                                                </button>
                                            </div>
                                        </div>
                                    </div>   
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-exclamation-circle"></i> Employee Information
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            
                            <div class="card-body">                               
                                <form class="form-horizontal" method="post" enctype="multipart/form-data" id="addEmp">  
                                    <input type="hidden" name="action" value="update_profile">

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <label for="exampleInputName">First Name:</label>
                                                <input type="text" name="fname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter First Name" value="<?php echo $emp->fname ?>" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="exampleInputName">Middle Name:</label>
                                                <input type="text" name="mname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Middle Name" value="<?php echo $emp->mname ?>" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="exampleInputName">Last Name:</label>
                                                <input type="text" name="lname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Last Name" value="<?php echo $emp->lname ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <label for="exampleInputName">Username:</label>
                                                <input type="text" name="username" placeholder="Enter Username" value="<?php echo $emp->username ?>" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="exampleInputName">Gender:</label>
                                                <select name="emp_gender" class="form-control">
                                                    <option value=""> --- Select --- </option>
                                                    <option value="Male" <?php echo ($emp->emp_gender == 'Male') ? 'selected="selected"' : '' ?>>Male</option>
                                                    <option value="Female" <?php echo ($emp->emp_gender == 'Female') ? 'selected="selected"' : '' ?>>Female</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="exampleInputName">Usertype:</label>
                                                <select name="usertype" class="form-control">
                                                    <option value=""> --- Select --- </option>
                                                    <option value="Administrator" <?php echo ($emp->usertype == 'Administrator') ? 'selected="selected"' : '' ?>>Administrator</option>
                                                    <option value="Supply Officer" <?php echo ($emp->usertype == 'Supply Officer') ? 'selected="selected"' : '' ?>>Supply Officer</option>
                                                    <option value="Staff" <?php echo ($emp->usertype == 'Staff') ? 'selected="selected"' : '' ?>>Staff</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <a href="./dashboard" class="btn btn-danger">
                                                    Cancel
                                                </a>
                                                <button type="submit" name="btn-update" class="btn btn-primary">
                                                    <i class="fas fa-save"></i> Update
                                                </button>
                                            </div>
                                        </div>
                                    </div>   
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

<script>
    setTimeout(function() {
        $('#alert').delay(2500).fadeOut(5000);
    },);
</script>

<?php include 'pages/script/user.php';?>
<?= element( 'footer' ); ?>
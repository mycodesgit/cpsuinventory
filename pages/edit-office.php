<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<?php
    $token = $_GET['token'];
    $stmt = $DB->prepare("SELECT * FROM offices WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $office = $result->fetch_object();
?>

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fas fa-building"></i> Edit Office</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="./offices">Offices</a></li>
                                <li class="breadcrumb-item active">Edit Office</li>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-pen"></i>
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                
                                <div class="card-body">
                                    <form class="form-horizontal" method="post" id="editOffice" enctype="multipart/form-data">  
                                        <input type="hidden" name="action" value="update_office">

                                        <?= show_message(); ?>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleInputName">Office Name:</label>
                                                    <input type="text" name="office_name" oninput="this.value = this.value.toUpperCase()" placeholder="Office Name" value="<?php echo $office->office_name?>" class="form-control" required>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleInputName">Office Abbreviation:</label>
                                                    <input type="text" name="office_abbr" oninput="this.value = this.value.toUpperCase()" placeholder="Office Abbreviation" value="<?php echo $office->office_abbr?>" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <button type="submit" name="btn-update" class="btn btn-primary btn-sm" style="background-color: #3c8dbc;">
                                                        <i class="fas fa-save"></i> Save
                                                    </button>
                                                    <a href="./offices" class="btn btn-success btn-sm">
                                                        <i class="fas fa-arrow-left"></i> Back
                                                    </a>
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

<?php include 'pages/script/office.php';?>

<?= element( 'footer' ); ?>

<script type="text/javascript">
    setTimeout(function () {
        $( "#alert" ).delay(2500).fadeOut(5000);
    }, );
</script>
<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<?php
    $token = $_GET['token'];
    $stmt = $DB->prepare("SELECT * FROM classification WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $classification = $result->fetch_object();
?>

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fas fa-building"></i> Edit Classification</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="./classification">Classification</a></li>
                                <li class="breadcrumb-item active">Edit Classification</li>
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
                                    <form class="form-horizontal" method="post" id="editClass" enctype="multipart/form-data">  
                                        <input type="hidden" name="action" value="update_classification">

                                        <?= show_message(); ?>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleInputName">Classification Name:</label>
                                                    <input type="text" name="class_name" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" placeholder="Classification Name" value="<?php echo $classification->class_name?>" class="form-control">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleInputName">Classification Code:</label>
                                                    <input type="text" name="class_code" oninput="this.value = this.value.toUpperCase()" placeholder="Office Abbreviation" value="<?php echo $classification->class_code?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <button type="submit" name="btn-update" class="btn btn-primary btn-sm" style="background-color: #3c8dbc;">
                                                        <i class="fas fa-save"></i> Save
                                                    </button>
                                                    <a href="./classification" class="btn btn-success btn-sm">
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

<?php include 'pages/script/class.php';?>

<?= element( 'footer' ); ?>

<script type="text/javascript">
    setTimeout(function () {
        $( "#alert" ).delay(2500).fadeOut(5000);
    }, );
</script>
<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fas fa-clipboard"></i> Logs</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./?page=dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Logs</li>
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
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <?= show_message(); ?>
                                <!-- Modal -->
                                <?php include 'pages/modal/add-user-modal.php';?>
                                <!-- /End Modal -->
                                
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-hover text-sm">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Item</th>
                                                    <th>Remarks</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <?php
                                                        $query = $DB->prepare("SELECT * FROM logs
                                                                            JOIN ppei ON ppei.id = logs.ppei_id
                                                                            JOIN users ON users.id = logs.user_id");
                                                        $query->execute();
                                                        $result = $query->get_result();
                                                        if ($result->num_rows > 0) {
                                                            $count = 1;
                                                            while ($logs = $result->fetch_object()) {
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $count++; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $logs->description; ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    if($logs->action == "in"){
                                                                        echo"Item Inserted By $logs->fname  $logs->lname";
                                                                    }
                                                                    if($logs->action == "upt"){
                                                                        echo"Item Updated By $logs->fname  $logs->lname";
                                                                    }
                                                                    if($logs->action == "del"){
                                                                        echo"Item Deleted By $logs->fname  $logs->lname";
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $logs->created_at; ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        }
                                                    } else {
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
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

<?php include 'pages/script/user.php';?>

<?= element( 'footer' ); ?>


<script src="assets/js/addUserValidation.js"></script>

<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-layer-group"></i> Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Category</li>
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
                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-category" style="background-color: #3c8dbc;">
                                    <i class="fas fa-plus"></i> Add New
                                </button>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <?= show_message(); ?>
                        <!-- Modal -->
                        <?php include 'pages/modal/add-category-modal.php';?>
                        <!-- /End Modal -->
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>ICT Category</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = $DB->prepare( "SELECT * FROM category" );
                                            $query->execute();
                                            $result = $query->get_result();
                                            if ($result->num_rows > 0) {
                                                $cnt = 1;
                                                while ($cat = $result->fetch_object()) { ?>
                                                <tr>
                                                    <td><?php echo $cnt ?></td>
                                                    <td><?php echo $cat->category_name ?></td>
                                                    <td>
                                                        <a href="./edit-category&token=<?php echo $cat->token?>" class="btn btn-info btn-xs" title="Edit">
                                                            <i class="fas fa-info-circle"></i>
                                                        </a>
                                                        <a href="" class="btn btn-danger btn-xs" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                                    $cnt++;
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

<?php include 'pages/script/category.php';?>

<?= element( 'footer' ); ?>

<script type="text/javascript">
    setTimeout(function () {
        $( "#alert" ).delay(2500).fadeOut(5000);
    }, );
</script>


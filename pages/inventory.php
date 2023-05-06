<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fas fa-desktop"></i> Inventory</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Inventory</li>
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
                                        <a href="./add-inventory" class="btn btn-primary btn-xs" style="background-color: #3c8dbc;">
                                            <i class="fas fa-plus"></i> Add New
                                        </a>
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <?= show_message(); ?>
                                <!-- Modal -->
                                <?php include 'pages/modal/add-office-modal.php';?>
                                <!-- /End Modal -->
                                
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-hover text-sm">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Property No.</th>
                                                    <th>Qty</th>
                                                    <th>Category</th>
                                                    <th>Acquisition Date</th>
                                                    <th>Unit</th>
                                                    <th>Unit Value</th>
                                                    <th>Classification</th>
                                                    <th>End User</th>
                                                    <th>Where About</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $query = $DB->prepare( "SELECT ppei.*, category.category_name AS category_name, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr FROM ppei INNER JOIN category ON ppei.category_id = category.id INNER JOIN classification ON classification.id = ppei.classification_id INNER JOIN offices ON offices.id = ppei.where_about" );
                                                    $query->execute();
                                                    $result = $query->get_result();
                                                    if ($result->num_rows > 0) {
                                                        $cnt = 1;
                                                        while ($item = $result->fetch_object()) { ?>
                                                        <tr>
                                                            <td><?php echo $cnt ?></td>
                                                            <td><?php echo $item->property_no ?></td>
                                                            <td><?php echo $item->qty ?></td>
                                                            <td><?php echo $item->category_name ?></td>
                                                            <td><?php $acq = $item->acquisition_date; print date("M d, Y", strtotime($acq)) ?></td>
                                                            <td><?php echo $item->unit ?></td>
                                                            <td><?php echo $item->unit_value ?></td>
                                                            <td><?php echo $item->class_name ?></td>
                                                            <td><?php echo $item->end_user ?></td>
                                                            <td><?php echo $item->office_abbr ?></td>
                                                            <td>
                                                                <a href="./edit-inventory&token=<?php echo $item->token?>" class="btn btn-info btn-xs" title="Edit">
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

<?php include 'pages/script/office.php';?>

<?= element( 'footer' ); ?>

<script type="text/javascript">
    setTimeout(function () {
        $( "#alert" ).delay(2500).fadeOut(5000);
    }, );
</script>


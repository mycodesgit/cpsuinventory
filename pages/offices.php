<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fas fa-building"></i> Offices</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Offices</li>
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
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-office" style="background-color: #3c8dbc;">
                                            <i class="fas fa-plus"></i> Add Office
                                        </button>
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
                                                    <th>Office Name</th>
                                                    <th>Office Abbreviation</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $query = $DB->prepare( "SELECT * FROM offices WHERE offdel= 1" );
                                                    $query->execute();
                                                    $result = $query->get_result();
                                                    if ($result->num_rows > 0) {
                                                        $cnt = 1;
                                                        while ($office = $result->fetch_object()) { ?>
                                                        <tr>
                                                            <td><?php echo $cnt ?></td>
                                                            <td><?php echo $office->office_name ?></td>
                                                            <td><?php echo $office->office_abbr ?></td>
                                                            <td>
                                                                <a href="./edit-office&token=<?php echo $office->token?>" class="btn btn-info btn-xs" title="Edit">
                                                                    <i class="fas fa-info-circle"></i>
                                                                </a>
                                                                <a id="<?php echo $office->id ?>" onclick="deleteItemOffice(this.id)" class="btn btn-danger btn-xs" title="Delete">
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

<script>
    function deleteItemOffice(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "actions/delete_office.php",
                    data: { id },
                    success: function (response) {
                      Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      ).then(() => {
                            location.reload(); // Reload the page after successful deletion
                        });
                    }
                });
            }
        });
    }
</script>

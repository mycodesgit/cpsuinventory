<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fas fa-users"></i> Users</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./?page=dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Users</li>
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
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-user" style="background-color: #3c8dbc;">
                                            <i class="fas fa-user-plus"></i> Add User
                                        </button>
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <?= show_message(); ?>
                                <!-- Modal -->
                                <?php include 'pages/modal/add-user-modal.php';?>
                                <!-- /End Modal -->
                                
                                <div class="card-body">
                                    <?php
                                        $query = $DB->query( "SELECT * FROM users WHERE usertype='User'" );
                                    ?>
                                   
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-hover text-sm">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>First Name</th>
                                                    <th>Middle Name</th>
                                                    <th>Last Name</th>
                                                    <th>Username</th>
                                                    <th>Position</th>
                                                    <th>Log Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $query = $DB->prepare( "SELECT * FROM users" );
                                                    $query->execute();
                                                    $result = $query->get_result();
                                                    if ($result->num_rows > 0) {
                                                        $cnt = 1;
                                                        while ($user = $result->fetch_object()) { ?>
                                                        <tr>
                                                            <td><?php echo $cnt ?></td>
                                                            <td><?php echo $user->fname ?></td>
                                                            <td><?php echo $user->mname ?></td>
                                                            <td><?php echo $user->lname ?></td>
                                                            <td><?php echo $user->username ?></td>
                                                            <td><?php echo $user->usertype ?></td>
                                                            <td id="stat<?php echo $user->id ?>" class="">
                                                                
                                                            </td>
                                                            <td>
                                                                <a href="./edit-user&token=<?php echo $user->token ?>" class="btn btn-primary btn-xs" title="Edit">
                                                                    <i class="fas fa-pen"></i>
                                                                </a>
                                                                <a href="" class="btn btn-danger btn-xs" title="Delete">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <script>
                                                            setInterval(function() {
                                                                stat(<?php echo $user->id ?>);
                                                            }, 1000);
                                                        </script>
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

<?php include 'pages/script/user.php';?>

<?= element( 'footer' ); ?>

<script>
    function stat(id){
        $.ajax({
            type:"GET",
            url:"pages/logstatus.php?id="+id,
            success: function(response){
                // alert(response);
                if(response == "1"){
                    $("#stat" + id).html('<div class="badge badge-success">Login</div>');
                }
                else{
                    $("#stat" + id).html('<div class="badge badge-warning">Logout</div>');
                }
            }
        });
    }
</script>

<script type="text/javascript">
    setTimeout(function () {
        $( "#alert" ).delay(2500).fadeOut(5000);
    }, );
</script>


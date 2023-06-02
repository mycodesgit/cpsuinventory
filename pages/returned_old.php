<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT Select OWED' ); ?>

<?= element( 'header' ); ?>

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fas fa-desktop"></i> Unserviceable</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Unserviceable</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            

            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="container-fluid">
                <!-- SmSelect  boxes (Stat box) -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-1.5">
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col-sm-2">
                                                        <a href="./add-return" class="btn btn-app1">
                                                            <i class="fas fa-plus" style="color: #fff"></i> Add New
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                            if(!isset($_SESSION['category_id1'])){
                                                $category_id = "";
                                            }
                                            if(isset($_SESSION['category_id1'])){
                                                $category_id = $_SESSION['category_id1'];
                                            }
                                            
                                            if(!isset($_SESSION['acquisition_date1'])){
                                                $acquisition_date1 = "";
                                            }
                                            if(isset($_SESSION['acquisition_date1'])){
                                                $acquisition_date1 = $_SESSION['acquisition_date1'];
                                            }

                                            if(!isset($_SESSION['where_about1'])){
                                                $where_about1 = "";
                                            }
                                            if(isset($_SESSION['where_about1'])){
                                                $where_about1 = $_SESSION['where_about1'];
                                            }

                                            if(!isset($_SESSION['end_user1'])){
                                                $end_user1 = "";
                                            }
                                            if(isset($_SESSION['end_user1'])){
                                                $end_user1 = $_SESSION['end_user1'];
                                            }

                                        ?>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <form method="POST">
                                                <input type="hidden" name="action" value="set_session_return">
                                                    <div class="form-row">
                                                        <div class="col-sm-2">
                                                            <?php
                                                                $stmt = $DB->prepare("SELECT id, SUBSTRING(office_abbr, LOCATE('-', office_abbr) + 1) FROM offices ");
                                                                $stmt->execute();
                                                                $stmt->bind_result($id, $where_about);
                                                            ?>
                                                                <select name="where_about" id="where-about" class="form-control select2">
                                                                    <option value="">Select All </option>
                                                                    <?php while ($stmt->fetch()) { ?>
                                                                        <option value="<?php echo $id ?>" <?php if($id == $where_about1){ echo "selected"; }?>><?php echo $where_about ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            <?php  $stmt->close(); ?>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <?php
                                                                $stmt = $DB->prepare("SELECT DISTINCT end_user FROM ppei");
                                                                $stmt->execute();
                                                                $stmt->bind_result($end_user);
                                                            ?>
                                                                <select name="end_user" id="end-user" class="form-control select2">
                                                                    <option value="">Select All </option>
                                                                    <?php while ($stmt->fetch()) { ?>
                                                                        <option value="<?php echo $end_user ?>" <?php if($end_user == $end_user1){ echo "selected"; }?>><?php echo $end_user ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            <?php  $stmt->close(); ?>
                                                        </div>
                                                                    
                                                        <div class="col-sm-2">
                                                            <input type="date" name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : ''; ?>"  class="form-control">
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <input type="date" name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : ''; ?>"  class="form-control">
                                                        </div>

                                                        <div class="col-sm-2 btn-group">
                                                            <button type="submit" name="btn-setsessions" class="btn btn-app1">
                                                                <i class="fas fa-search" style="color: #fff"></i> Search
                                                            </button>
                                                            <a href="./pdf2" target="_blank" class="btn btn-app1">
                                                                <i class="fas fa-print" style="color: #fff"></i> Print
                                                            </a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    
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
                                                    <th>Prop. No.</th>
                                                    <th>Qty</th>
                                                    <th>Description</th>
                                                    <th>Serial</th>
                                                    <th>Acq. Date</th>
                                                    <th>Unit</th>
                                                    <th>Unit Value</th>
                                                    <th>End User</th>
                                                    <th>Where About</th>
                                                    <th>Remarks</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                  
                                                    if(!isset($_SESSION['where_about1'])){
                                                        $where_about = "";
                                                    }
                                                    if(isset($_SESSION['where_about1'])){
                                                        $where_about = $_SESSION['where_about1'];
                                                    }

                                                    if(!isset($_SESSION['end_user1'])){
                                                        $end_user = "";
                                                    }
                                                    if(isset($_SESSION['end_user1'])){
                                                        $end_user = $_SESSION['end_user1'];
                                                        
                                                    }

                                                    if(!isset($_SESSION['date11'])){
                                                        $date1 = "";
                                                    }
                                                    if(isset($_SESSION['date11'])){
                                                        $date1 = $_SESSION['date11'];
                                                    }

                                                    if(!isset($_SESSION['date22'])){
                                                        $date2 = "";
                                                    }
                                                    if(isset($_SESSION['date22'])){
                                                        $date2 = $_SESSION['date22'];
                                                    }
                                                     
                                                if(!isset($_SESSION['where_about']) && !isset($_SESSION['end_user']) && !isset($_SESSION['date1']) && !isset($_SESSION['date2'])){
                                                        $query = $DB->prepare("SELECT ppei.*, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr 
                                                        FROM ppei 
                                                        INNER JOIN classification ON classification.id = ppei.classification_id 
                                                        INNER JOIN offices ON offices.id = ppei.where_about 
                                                        WHERE statdel = 1");
                                                        $query->execute();
                                                }
                                                else{
                                                    if(!isset($_SESSION['date11']) && !isset($_SESSION['date22'])){
                                                        if (isset($_SESSION['where_about1']) || isset($_SESSION['end_user1'])) {
                                                            $query = $DB->prepare("SELECT ppei.*, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr 
                                                            FROM ppei 
                                                            INNER JOIN classification ON classification.id = ppei.classification_id 
                                                            INNER JOIN offices ON offices.id = ppei.where_about 
                                                            WHERE statdel = 1
                                                            AND ppei.where_about LIKE ? 
                                                            OR ppei.end_user LIKE ?");
                                                            
                                                            $query->bind_param('ss', $where_about, $end_user);
                                                            $query->execute();
                                                        }
                                                        if (!isset($_SESSION['where_about1']) && !isset($_SESSION['end_user1'])) {
                                                            $query = $DB->prepare("SELECT ppei.*, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr 
                                                            FROM ppei 
                                                            INNER JOIN classification ON classification.id = ppei.classification_id 
                                                            INNER JOIN offices ON offices.id = ppei.where_about 
                                                            WHERE statdel = 1");
                                                            $query->execute();
                                                        }
                                                    }

                                                    if (isset($_SESSION['date11']) && isset($_SESSION['date22'])) {
                                                        if (isset($_SESSION['where_about1']) || isset($_SESSION['end_user1'])) {
                                                            $query = $DB->prepare("SELECT ppei.*, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr 
                                                            FROM ppei 
                                                            INNER JOIN classification ON classification.id = ppei.classification_id 
                                                            INNER JOIN offices ON offices.id = ppei.where_about 
                                                            WHERE statdel = 1 
                                                            AND ppei.where_about LIKE ? 
                                                            OR ppei.end_user LIKE ? 
                                                            AND ppei.created_at BETWEEN ? AND ?");
                                    
                                                            $where_about = '%' . $where_about . '%';
                                                            $end_user = '%' . $end_user . '%';
                                                            
                                                            $query->bind_param('ssss', $where_about, $end_user, $date1, $date2);
                                                            $query->execute();
                                                        }
                                                        if (!isset($_SESSION['where_about1']) && !isset($_SESSION['end_user1'])) {
                                                            $query = $DB->prepare("SELECT ppei.*, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr 
                                                            FROM ppei 
                                                            INNER JOIN classification ON classification.id = ppei.classification_id 
                                                            INNER JOIN offices ON offices.id = ppei.where_about 
                                                            WHERE statdel = 1 
                                                            AND ppei.created_at BETWEEN ? AND ?");
                                    
                                                            $end_user = '%' . $end_user . '%';
                                                            
                                                            $query->bind_param('ss', $date1, $date2);
                                                            $query->execute();
                                                        }
                                                    }
                                                }


                                                    $query->execute();
                                                    $result = $query->get_result();
                                                    if ($result->num_rows > 0) {
                                                        $cnt = 1;
                                                        while ($item = $result->fetch_object()) { ?>
                                                        <tr>
                                                            <td><?php echo $cnt ?></td>
                                                            <td><?php echo $item->property_no ?></td>
                                                            <td><?php echo $item->qty ?></td>
                                                            <td><?php echo $item->description ?></td>
                                                            <td><?php echo $item->serial_no ?></td>
                                                            <td><?php $acq = $item->acquisition_date; print date("M d, Y", strtotime($acq)) ?></td>
                                                            <td><?php echo $item->unit ?></td>
                                                            <td><?php echo $item->unit_value ?></td>
                                                            <td><?php echo $item->end_user ?></td>
                                                            <td><?php echo $item->office_abbr ?></td>
                                                            <td>
                                                                <?php if($item->remarks == "Good"){  ?>
                                                                <span class="badge badge-success"><?php echo $item->remarks ?></span>
                                                                <?php }else{ ?>
                                                                <span class="badge badge-warning"><?php echo $item->remarks ?></span>
                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                <a data-toggle="modal" data-target="#release<?php echo $item->token ?>" class="btn btn-secondary btn-xs" title="release">
                                                                    <i class="fas fa-arrow-right"></i>
                                                                </a>
                                                                <a id="<?php echo $item->id ?>" onclick="deleteItem(this.id)" class="btn btn-danger btn-xs" title="Delete">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <div class="modal fade" id="return<?php echo $item->token ?>">
                                                            <div class="modal-dialog modal-md">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            <i class="fas fa-plus"></i> Unserviceable Remarks
                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    
                                                                    <div class="modal-body">
                                                                    <form class="form-horizontal" method="post" id="" enctype="multipart/form-data">  
                                                                            <input type="hidden" name="action" value="update_remarks"> 
                                                                            <input type="hidden" name="token" value="<?php echo $item->token ?>"> 
                                                                            <div class="form-group">
                                                                                <div class="form-row">
                                                                                    <div class="col-md-12">
                                                                                        <label for="exampleInputName">Reason:</label>
                                                                                        <textarea type="text" name="reason" oninput="this.value = this.value.toUpperCase()" placeholder="Reason..." class="form-control"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div class="form-row">
                                                                                    <div class="col-md-12">
                                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                                                            Close
                                                                                        </button>
                                                                                        <button type="submit" name="btn-remarks" class="btn btn-primary">
                                                                                            <i class="fas fa-save"></i> Save
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>   
                                                                        </form>
                                                                    </div>
                                                                    
                                                                    <div class="modal-footer justify-content-between">
                                                                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        <button type="button" class="btn btn-primary">Save changes</button> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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

    function deleteItem(id){
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
                    url: "actions/delete_inventory.php?id="+id,
                    data: {id},
                    success: function (response) {
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                    }
                });
                
            setTimeout(function() {
                location.reload();
                }, 2000);
            }
        })
    }
</script>


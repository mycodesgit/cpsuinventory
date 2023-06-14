<?php 
    if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 
    error_reporting(0);
    ini_set('display_errors', 0);
?>

<?= element( 'header' ); ?>
<link rel="stylesheet" href="AjaxDatatables/datatables.min.css">
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
                                                        <a href="./add-inventory" class="btn btn-app1">
                                                            <i class="fas fa-plus" style="color: #fff"></i> Add New
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                        
                                        if(!isset($_SESSION['acquisition_date'])){
                                            $acquisition_date1 = "";
                                        }
                                        if(isset($_SESSION['acquisition_date'])){
                                            $acquisition_date1 = $_SESSION['acquisition_date'];
                                        }

                                        if(!isset($_SESSION['end_user'])){
                                            $end_user1 = "";
                                        }
                                        if(isset($_SESSION['end_user'])){
                                            $end_user1 = $_SESSION['end_user'];
                                        }

                                        ?>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <form method="POST">
                                                <input type="hidden" name="action" value="set_session">
                                                    <div class="form-row">

                                                        <div class="col-sm-2" hidden>
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
                                                                <select name="end_user" id="end-user" class="form-control select2" onchange="endUser(this.value)">
                                                                    <option value="">Select All </option>
                                                                    <?php while ($stmt->fetch()) { ?>
                                                                        <option value="<?php echo $end_user ?>" <?php if($end_user == $end_user1){ echo "selected"; }?>><?php echo $end_user ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            <?php  $stmt->close(); ?>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <input type="date" name="date1" id="date1"  onchange="dateOne(this.value)"  value="<?php echo isset($_SESSION['date1']) ? $_POST['date1'] : ''; ?>"class="form-control">
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <input type="date" name="date2" id="date2" onchange="dateTwo(this.value)"  value="<?php echo isset($_SESSION['date2']) ? $_POST['date2'] : ''; ?>"  class="form-control">
                                                        </div>

                                                        <div class="col-sm-2 btn-group">
                                                            <button type="submit" name="btn-setsessions" class="btn btn-app1">
                                                                <i class="fas fa-search" style="color: #fff"></i> Search
                                                            </button>
                                                            <a href="./pdf1" target="_blank" class="btn btn-app1" id="print-link" style="pointer-events: <?php echo isset($_SESSION['end_user']) ? 'auto' : 'none'; ?>;">
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
                                        <table id="example" class="table table-hover text-sm">
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
                                                    <th width="120">Actions</th>
                                                </tr>
                                            </thead>
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
<div class="modal fade" id="return">
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
                    <input type="hidden" id="remarks-token" name="token"> 
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-12">
                                <label for="exampleInputName">Remarks:</label>
                                <select onchange="thisRemark(this.value)" id="remarks" name="remarks" class="form-control">
                                <option value="">--- Select ---</option>
                                <option>Unserviceable</option>
                                <option>Destroyed</option>
                                <option>Damaged</option>
                                <option>Lost</option>
                                <option value="0">Others</option>
                                </select>
                            </div>
                            <div class="col-12 pt-2">
                                <input type="text" name="other_remarks" id="other-remarks" class="form-control" placeholder="Other Remarks" autocomplete="off">
                            </div>
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
<div class="modal fade" id="release">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus"></i> Release Item
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
            <form class="form-horizontal" method="post" id="" enctype="multipart/form-data">  
                    <input type="hidden" name="action" value="update_enduser"> 
                    <input type="hidden" id="enduser-token"  name="token" id="ednuser"> 

                    <div class="form-group">
                        <div class="form-now">
                            <div class="col-sm-12">
                                <?php
                                    $stmt = $DB->prepare("SELECT DISTINCT end_user FROM ppei");
                                    $stmt->execute();
                                    $stmt->bind_result($end_user);
                                ?>
                                    <select name="end_user" id="end-user" onchange="thisRelease(this.value)" class="form-control select2">
                                        <option value="">--- Select ---</option>
                                        <?php while ($stmt->fetch()) { ?>
                                            <option><?php echo $end_user ?></option>
                                        <?php } ?>
                                        <option value="0">Others</option>
                                    </select>
                                <?php  $stmt->close(); ?>
                            </div>
                            <div class="col-12 pt-2">
                                <input type="text" name="other_enduser" id="other-enduser" class="form-control" placeholder="End User" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" name="btn-enduser" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Submit
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

<script src="AjaxDatatables/jquery.min.js"></script>
<script src="AjaxDatatables/datatables.min.js"></script>

<?= element( 'footer' ); ?>
<script>  
    function dateOne(val){
        document.getElementById("date2").value=val;
        var date2 = document.getElementById("date2");
        date2.min = val;
    }

    function dateTwo(val){
        var date1 = document.getElementById("date1").value;
        if(date1 == ""){
            document.getElementById("date1").value=val;
        }
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var dataTable = $('#example').DataTable({
            ajax: {
                url: 'pages/AjaxDatatables/inventory_data.php',
                dataSrc: 'data'
            },
            columns: [
                { data: 'no' },
                { data: 'property_no'},
                { data: 'qty' },
                { data: 'description'},
                { data: 'serial_no' },
                { data: 'acquisition_date'},
                { data: 'unit'},
                { data: 'unit_value'},
                { data: 'end_user'},
                { data: 'where_about'},
                { data: 'remarks'},
                { data: 'action'}
            ],
            responsive: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            paging: true
        });

        // Refresh the DataTable every 5 seconds
        setInterval(function() {
            dataTable.ajax.reload(null, false);
        }, 2000);
    });


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
    
    function modalRelease(id){
        document.getElementById("enduser-token").value=id;
    }
    
    $(function() {
        $("#other-enduser").hide();
    });
    
    function thisRelease(val){
        if(val == 0){
            $("#other-enduser").show();
            $("#other-enduser").val("");
        }
        else{
            $("#other-enduser").hide();
            $("#other-enduser").val("");
        }
    }

    function modalReturn(id){
        document.getElementById("remarks-token").value=id;
    }

    $(function() {
        $("#other-remarks").hide();
    });

    function thisRemark(val){
        if(val == 0){
            $("#other-remarks").show();
            $("#other-remarks").val("");
        }
        else{
            $("#other-remarks").hide();
            $("#other-remarks").val("");
        }
    }

</script>

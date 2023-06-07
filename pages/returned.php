<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT Select OWED' ); ?>

<?= element( 'header' ); ?>
<link rel="stylesheet" href="AjaxDatatables/datatables.min.css">
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
                                                    <th>Actions</th>
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
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        
<script src="AjaxDatatables/jquery.min.js"></script>
<script src="AjaxDatatables/datatables.min.js"></script>

<?= element( 'footer' ); ?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable({
            ajax: {
                url: 'pages/AjaxDatatables/returned_data.php', // Replace with the endpoint URL to fetch data from the database
                dataSrc: 'data' // Property name in the response object that contains the data array
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
            // Customizing the DataTables appearance
            responsive: true, // Enable responsive design
            lengthChange: true, // Disable the ability to change the number of entries shown
            searching: true, // Enable search functionality
            ordering: true, // Enable column sorting
            paging: true // Enable pagination
        });
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


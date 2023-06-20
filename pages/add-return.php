<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-desktop"></i> Add Anserviceable</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="./dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Anserviceable</li>
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
                <?= show_message(); ?>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-exclamation-circle"></i> Anserviceable
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            
                            <div class="card-body">                               
                                <form class="form-horizontal" method="post" enctype="multipart/form-data" id="addInventory">  
                                    <input type="hidden" name="action" value="add_ppei">

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <label for="exampleInputName">Property Number:</label>
                                                <input type="text" name="property_no" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Property Number" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="exampleInputName">Quantity:</label>
                                                <input type="number" name="qty" placeholder="Enter Quantity" class="form-control"y>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="exampleInputName">Serial No:</label>
                                                <input type="text" name="serial_no" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Serial No" class="form-control">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <label for="exampleInputName">Acquisition Date:</label>
                                                <input type="date" name="acquisition_date" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="exampleInputName">Unit:</label>
                                                <select class="form-control" name="unit">
                                                    <option value="">--- Select ---</option>
                                                    <option value="Unit">Unit</option>
                                                    <option value="pcs">Pcs</option>
                                                    <option value="box">Box</option>
                                                    <option value="PC">PC</option>
                                                    <option value="set">Set</option>
                                                    <option value="roll">Roll</option>
                                                    <option value="meter">Meter</option>
                                                    <option value="copy">Copy</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="exampleInputName">Unit Value:</label>
                                                <input type="number" name="unit_value" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <?php
                                                $stmt = $DB->prepare("SELECT id, class_name FROM classification");
                                                $stmt->execute();
                                                $stmt->bind_result($id, $class_name);
                                                    echo '<div class="col-md-4">';
                                                    echo '<label>Classification:</label>';
                                                    echo '<select name="classification_id" class="form-control select2">';
                                                    echo '<option value="">--- Select ---</option>';
                                                while ($stmt->fetch()) {
                                                    echo '<option value="' . $id . '">' . $class_name . '</option>';
                                                }
                                                    echo '</select>';
                                                    echo '</div>';
                                                $stmt->close();
                                            ?>

                                            <div class="col-md-4">
                                            <label for="exampleInputName">End User:</label>
                                            <input type="text" name="end_user" class="form-control" placeholder="Enter End" list="endUserOptions" oninput="filterEndUserOptions(this)">
                                            <datalist id="endUserOptions">
                                            <?php
                                                $stmt = $DB->prepare("SELECT DISTINCT end_user FROM ppei");
                                                $stmt->execute();
                                                $stmt->bind_result($end_user);
                                                while ($stmt->fetch()) {
                                                    echo "<option value='$end_user'></option>";
                                                }
                                                $stmt->close();
                                            ?>
                                            </datalist>
                                            </div>

                                            <?php
                                                $stmt = $DB->prepare("SELECT id, office_abbr FROM offices");
                                                $stmt->execute();
                                                $stmt->bind_result($id, $office_abbr);
                                                    echo '<div class="col-md-4">';
                                                    echo '<label>Where About:</label>';
                                                    echo '<select name="where_about" class="form-control select2">';
                                                    echo '<option value="">--- Select ---</option>';
                                                while ($stmt->fetch()) {
                                                    echo '<option value="' . $id . '">' . $office_abbr . '</option>';
                                                }
                                                    echo '</select>';
                                                    echo '</div>';
                                                $stmt->close();
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <label for="exampleInputName">Specification:</label>
                                                <textarea name="specification" rows="3" class="form-control"></textarea>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="exampleInputName">Description:</label>
                                                <textarea name="description" rows="3" class="form-control"></textarea>
                                            </div>

                                            <div class="col-md-4">
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
                                                    <input type="text" name="other_remarks" id="other-remarks" class="form-control" placeholder="Remarks" autocomplete="off" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <a href="./inventory" class="btn btn-danger">
                                                    Cancel
                                                </a>
                                                <button type="submit" name="btn-submit" class="btn btn-primary">
                                                    <i class="fas fa-save"></i> Save
                                                </button>
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

<script>
    setTimeout(function() {
        $('#alert').delay(2500).fadeOut(5000);
    },);
    
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

<?php include 'pages/script/inventory.php';?>

<?= element( 'footer' ); ?>
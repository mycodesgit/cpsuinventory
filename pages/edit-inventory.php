<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<?php
    $token = $_GET['token'];
    $stmt = $DB->prepare("SELECT * FROM ppei WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_object();
?>

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-desktop"></i> Edit Inventory</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="./dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="./inventory">Inventory</a></li>
                            <li class="breadcrumb-item active">Edit Inventory</li>
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
                                    <i class="fas fa-exclamation-circle"></i> Inventory
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            
                            <div class="card-body">        
                                <form class="form-horizontal" method="post" enctype="multipart/form-data" id="addInventory">  
                                    <input type="hidden" name="action" value="update_ppei">
                                    <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                                    <div class="form-group">
                                        <div class="form-row">
                                            <input type="hidden" name="remarks" value="Good">
                                            <div class="col-md-4">
                                                <label for="exampleInputName">Property Number:</label>
                                                <input type="text" name="property_no" oninput="this.value = this.value.toUpperCase()" value="<?php echo $item->property_no ?>" placeholder="Enter Property Number" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="exampleInputName">Quantity:</label>
                                                <input type="number" name="qty" placeholder="Enter Quantity" value="<?php echo $item->qty ?>" class="form-control"y>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="exampleInputName">Serial No:</label>
                                                <input type="text" name="serial_no" oninput="this.value = this.value.toUpperCase()" value="<?php echo $item->serial_no ?>" placeholder="Enter Serial No" class="form-control">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <label for="exampleInputName">Acquisition Date:</label>
                                                <input type="date"  class="form-control" onchange="acquis(this.value)" value="<?php echo $item->acquisition_date ?>">
                                                <input type="hidden" name="acquisition_date" id="acq-date" class="form-control" value="<?php echo $item->acquisition_date ?>">
                                                <script>
                                                    function acquis(val){
                                                        document.getElementById("acq-date").value=val;
                                                    }
                                                </script>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="exampleInputName">Unit:</label>
                                                <select class="form-control" name="unit">
                                                    <option value="">--- Select ---</option>
                                                    <option value="unit" <?php if($item->unit == "Unit" || $item->unit == "unit") { echo "selected"; }?>>Unit</option>
                                                    <option value="pcs" <?php if($item->unit == "Pcs") { echo "selected"; }?>>Pcs</option>
                                                    <option value="box" <?php if($item->unit == "Box") { echo "selected"; }?>>Box</option>
                                                    <option value="PC" <?php if($item->unit == "PC") { echo "selected"; }?>>PC</option>
                                                    <option value="set" <?php if($item->unit == "Set") { echo "selected"; }?>>Set</option>
                                                    <option value="roll" <?php if($item->unit == "Roll") { echo "selected"; }?>>Roll</option>
                                                    <option value="meter" <?php if($item->unit == "Meter") { echo "selected"; }?>>Meter</option>
                                                    <option value="copy" <?php if($item->unit == "Copy") { echo "selected"; }?>>Copy</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="exampleInputName">Unit Value:</label>
                                                <input type="number" name="unit_value" placeholder="Unit Value" value="<?php echo $item->unit_value ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                        <?php
                                                // Get the list of offices
                                                $stmt = $DB->prepare("SELECT id, class_name FROM classification");
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                $stmt->close();
                                                // Output the select box
                                                echo '<div class="col-sm-4">';
                                                echo '<label>Classification:</label>';
                                                echo '<select name="classification_id" class="form-control select2">';
                                                echo '<option value="">--- Select ---</option>';
                                                while ($row = $result->fetch_object()) {
                                                    $selected = ($row->id == $item->classification_id) ? 'selected' : '';
                                                    echo '<option value="' . $row->id . '" ' . $selected . '>' . $row->class_name . '</option>';
                                                }
                                                echo '</select>';
                                                echo '</div>';
                                            ?>

                                            <div class="col-md-4">
                                                <label for="exampleInputName">End User:</label>
                                                <input type="text" name="end_user" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" class="form-control" placeholder="Enter End" value="<?php echo $item->end_user ?>">
                                            </div>

                                            <?php
                                                // Get the list of offices
                                                $stmt = $DB->prepare("SELECT id, office_abbr FROM offices");
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                $stmt->close();
                                                // Output the select box
                                                echo '<div class="col-sm-4">';
                                                echo '<label>Where About:</label>';
                                                echo '<select name="where_about" class="form-control select2">';
                                                echo '<option value="">--- Select ---</option>';
                                                while ($row = $result->fetch_object()) {
                                                    $selected = ($row->id == $item->where_about) ? 'selected' : '';
                                                    echo '<option value="' . $row->id . '" ' . $selected . '>' . $row->office_abbr . '</option>';
                                                }
                                                echo '</select>';
                                                echo '</div>';
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <label for="exampleInputName">Specification:</label>
                                                <textarea name="specification" rows="2" class="form-control"><?php echo $item->specification ?></textarea>
                                            </div>

                                            <div class="col-md-8">
                                                <label for="exampleInputName">Description:</label>
                                                <textarea name="description" rows="2" class="form-control"><?php echo $item->description ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <a href="./inventory" class="btn btn-danger">
                                                    Cancel
                                                </a>
                                                <button type="submit" name="btn-update-ppei" class="btn btn-primary">
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
</script>



<?= element( 'footer' ); ?>
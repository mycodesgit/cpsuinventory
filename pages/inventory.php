<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT Select OWED' ); ?>

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
                                        if(!isset($_SESSION['category_id'])){
                                            $category_id = "";
                                        }
                                        if(isset($_SESSION['category_id'])){
                                            $category_id = $_SESSION['category_id'];
                                        }
                                        
                                        if(!isset($_SESSION['acquisition_date'])){
                                            $acquisition_date1 = "";
                                        }
                                        if(isset($_SESSION['acquisition_date'])){
                                            $acquisition_date1 = $_SESSION['acquisition_date'];
                                        }

                                        if(!isset($_SESSION['where_about'])){
                                            $where_about1 = "";
                                        }
                                        if(isset($_SESSION['where_about'])){
                                            $where_about1 = $_SESSION['where_about'];
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
                                                        <div class="col-sm-2">
                                                            <?php
                                                                $stmt = $DB->prepare("SELECT id, category_name FROM category");
                                                                $stmt->execute();
                                                                $stmt->bind_result($id, $category_name);
                                                            ?>
                                                                <select name="category_id" id="category-id" class="form-control select2">
                                                                    <option value="">Select All </option>
                                                                    <?php while ($stmt->fetch()) { ?>
                                                                        <option value="<?php echo $id ?>" <?php if($id == $category_id){ echo "selected"; }?>><?php echo $category_name ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            <?php  $stmt->close(); ?>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <?php
                                                                $stmt = $DB->prepare("SELECT DISTINCT acquisition_date FROM ppei");
                                                                $stmt->execute();
                                                                $stmt->bind_result($acquisition_date);
                                                            ?>
                                                                <select name="acquisition_date" id="acquisition-date" class="form-control select2">
                                                                    <option value="">Select All </option>
                                                                    <?php while ($stmt->fetch()) { $formatted_date = date("M d, Y", strtotime($acquisition_date)); ?>
                                                                        <option value="<?php echo $acquisition_date ?>" <?php if($acquisition_date == $acquisition_date1){ echo "selected"; }?>><?php echo $formatted_date ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            <?php  $stmt->close(); ?>
                                                        </div>

                                                        <div class="col-sm-3">
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

                                                        <div class="col-sm-3">
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

                                                        <div class="col-sm-2 btn-group">
                                                            <button type="submit" name="btn-setsessions" class="btn btn-app1">
                                                                <i class="fas fa-search" style="color: #fff"></i> Search
                                                            </button>
                                                            <a href="./pdf1" class="btn btn-app1">
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
                                                    if(!isset($_SESSION['category_id'])){
                                                        $category_id = "";
                                                    }
                                                    if(isset($_SESSION['category_id'])){
                                                        $category_id = $_SESSION['category_id'];
                                                    }
                                                    
                                                    if(!isset($_SESSION['acquisition_date'])){
                                                        $acquisition_date = "";
                                                    }
                                                    if(isset($_SESSION['acquisition_date'])){
                                                        $acquisition_date = $_SESSION['acquisition_date'];
                                                    }
            
                                                    if(!isset($_SESSION['where_about'])){
                                                        $where_about = "";
                                                    }
                                                    if(isset($_SESSION['where_about'])){
                                                        $where_about = $_SESSION['where_about'];
                                                    }
            
                                                    if(!isset($_SESSION['end_user'])){
                                                        $end_user = "";
                                                    }
                                                    if(isset($_SESSION['end_user'])){
                                                        $end_user = $_SESSION['end_user'];
                                                    }
                                                    if(!isset($_SESSION['category_id']) && !isset($_SESSION['acquisition_date']) && !isset($_SESSION['where_about']) && !isset($_SESSION['end_user'])){
                                                        $query = $DB->prepare( "SELECT ppei.*, category.category_name AS category_name, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr FROM ppei INNER JOIN category ON ppei.category_id = category.id INNER JOIN classification ON classification.id = ppei.classification_id INNER JOIN offices ON offices.id = ppei.where_about" );
                                                    }
                                                    if(isset($_SESSION['category_id']) || isset($_SESSION['acquisition_date']) || isset($_SESSION['where_about']) || isset($_SESSION['end_user'])){
                                                        $query = $DB->prepare( "SELECT ppei.*, category.category_name AS category_name, classification.class_name AS class_name, SUBSTRING(offices.office_abbr, LOCATE('-', offices.office_abbr) + 1) AS office_abbr FROM ppei INNER JOIN category ON ppei.category_id = category.id INNER JOIN classification ON classification.id = ppei.classification_id INNER JOIN offices ON offices.id = ppei.where_about WHERE ppei.category_id LIKE '%$category_id%' AND ppei.acquisition_date LIKE '%$acquisition_date%' AND ppei.where_about LIKE '%$where_about%' AND ppei.end_user LIKE '%$end_user%'");
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


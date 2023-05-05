<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fa fa-grip-horizontal"></i> Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            

            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="container-fluid">
                    <?= show_message(); ?>
                <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                        <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <?php
                                        $result = $DB->query("SELECT COUNT(*) AS cat_count FROM category")->fetch_array();
                                    ?>
                                    <h3><?php echo ($result['cat_count']);?></h3>
                                    <p>ICT Category</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-layer-group"></i>
                                </div>
                                <a href="./?page=ict-category" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                        <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <?php
                                        $result = $DB->query("SELECT COUNT(*) AS class_count FROM classification")->fetch_array();
                                    ?>
                                    <h3><?php echo ($result['class_count']);?></h3>
                                    <p>Classification</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-list-alt"></i>
                                </div>
                                <a href="./?page=offices" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                        <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <?php
                                        $result = $DB->query("SELECT COUNT(*) AS item_count FROM ppei")->fetch_array();
                                    ?>
                                    <h3><?php echo ($result['item_count']);?></h3>
                                    <p>PPEI</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-desktop"></i>
                                </div>
                                <a href="./?page=ict-equip-monitoring" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                        <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <?php
                                        $result = $DB->query("SELECT COUNT(*) AS user_count FROM users")->fetch_array();
                                    ?>
                                    <h3><?php echo ($result['user_count']);?></h3>
                                    <p>Users</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="./?page=users" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

<?= element( 'footer' ); ?>
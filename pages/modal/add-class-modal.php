<div class="modal fade" id="modal-equip">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus"></i> Add ICT Equipment Tracking & Monitoring
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
               <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">  
                    <input type="hidden" name="action" value="add_new_ict_equip_monitoring"> 

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label for="exampleInputName">ICT Equipment:</label>
                                <input type="text" name="ict_equip_item" oninput="this.value = this.value.toUpperCase()" placeholder="Enter ICT Equipment" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label for="exampleInputName">Serial No.:</label>
                                <input type="text" name="serial_no" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Serial No." class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label for="exampleInputName">Category:</label>
                                <?php
                                    $query = $DB->query( "SELECT * FROM tbl_category" );
                                ?> 
                                <select name="cat_id" class="form-control" required="">
                                    <option>--- Select ---</option>
                                        <?php if( $query->num_rows > 0 ) { 
                                        while( $row = $query->fetch_assoc() ) { ?>
                                            <option value="<?php echo $row['category_name'] ?>">
                                                <?php echo $row['category_name'] ?>
                                                    
                                            </option>
                                         <?php }
                                            }else { ?>
                                                
                                        <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label for="exampleInputName">Date Entry:</label>
                                <input type="datetime-local" name="incoming_date" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label for="exampleInputName">Process Owner:</label>
                                <input type="text" name="process_owner" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Process Owner" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label for="exampleInputName">Office:</label>
                                <?php
                                    $query = $DB->query( "SELECT * FROM tbl_offices" );
                                ?> 
                                <select name="office_id" class="form-control" required="">
                                    <option>--- Select ---</option>
                                        <?php if( $query->num_rows > 0 ) { 
                                        while( $row = $query->fetch_assoc() ) { ?>
                                            <option value="<?php echo $row['f_id'] ?>">
                                                <?php echo $row['office_name'] ?>
                                                    
                                            </option>
                                         <?php }
                                            }else { ?>
                                                
                                        <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <?php
                        $results = $DB->query("SELECT * FROM tbl_admin WHERE id=".$_SESSION[AUTH_ID]);
                        $user = $results->fetch_object();
                    ?>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label for="exampleInputName">Repaired By:</label>
                                <input type="text" name="repair_by" value="<?php echo $user->fname;?> <?php echo $user->lname;?>" class="form-control" required readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" name="btn-submit" class="btn btn-primary">
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
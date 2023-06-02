<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fas fa-file-import"></i> Import</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Import</li>
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
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <?= show_message(); ?>
                                
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="action" value="importcsv">
                                        <div>
                                            <label>Import CSV/Excel File:</label>
                                            <input type="file" multiple name="filename" id="filename">
                                            <button type="submit" id="submit" name="submit" data-loading-text="Loading...">Upload</button>
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

<?php include 'pages/script/office.php';?>

<script>
 
 $(document).ready(function(){

  var clear_timer;

  $('#sample_form').on('submit', function(event){
   $('#message').html('');
   event.preventDefault();
   $.ajax({
    url:"upload.php",
    method:"POST",
    data: new FormData(this),
    dataType:"json",
    contentType:false,
    cache:false,
    processData:false,
    beforeSend:function(){
     $('#import').attr('disabled','disabled');
     $('#import').val('Importing');
    },
    success:function(data)
    {
     if(data.success)
     {
      $('#total_data').text(data.total_line);

      $('#message').html('<div class="alert alert-success">CSV File Uploaded</div>');
     }
     if(data.error)
     {
      $('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
      $('#import').attr('disabled',false);
      $('#import').val('Import');
     }
    }
   })
  });

 });
</script>

<?= element( 'footer' ); ?>

<script type="text/javascript">
    setTimeout(function () {
        $( "#alert" ).delay(2500).fadeOut(5000);
    }, );
</script>


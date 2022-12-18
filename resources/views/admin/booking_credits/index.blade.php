<?php $b_credits_page='active';
include(app_path().'/admin/common/header.php'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <?php include(app_path().'/admin/common/left_menu.php'); ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Booking credits
        <small><?php echo count($credits); ?> total package</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/booking-credits'); ?>">Booking credits</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!--<div class="box-header">
              <h3 class="box-title"></h3>
            </div>-->
            <!-- /.box-header -->
              <button class="btn btn-success" style="float:right;" onclick="add_new()">+ Add New</button>

          <form role="form" action="" method="post" enctype="multipart/form-data" style="margin-top:27px; display:none;" id="add_new">
              <?php echo csrf_field(); ?>
              <div class="box-body">
                  
                  <div class="col-md-6">
                  <div class="form-group">
                  <label>Buy credits <font style="color:red;">*</font></label>
                      <input type="number" class="form-control" name="credits_buy" required min="1">
                  </div>
                  </div>
                  
                  <div class="col-md-6">
                  <div class="form-group">
                  <label>Get credits <font style="color:red;">*</font></label>
                      <input type="number" class="form-control" name="credits_get" required min="1">
                  </div>
                  </div>
                  
                  <div class="col-md-12">
                  <div class="form-group">
                  <label>Price <font style="color:red;">*</font></label>
                      <input type="number" class="form-control" name="credits_price" required min="1" step="any">
                  </div>
                  </div>
                  
              </div>

              <div class="box-footer">
                  <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Add</button>
                  </div>
              </div>
              <hr>
          </form>
              
              <script>
                  function add_new(){
                      $("#add_new").slideToggle();
                  }
              </script>

            <div class="box-body" style="margin-top:30px;">
                <?php if(isset($error) AND !empty($error)) echo $error.'<br><br>'; ?>
              <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Buy credits</th>
                <th>Get credits</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(!empty($credits)) {
                foreach($credits as $credit) {
            ?>
            <tr>
                <td><?php echo $credit['credit']->credits_buy; ?></td>
                <td><?php echo $credit['credit']->credits_get; ?></td>
                <td>$<?php echo $credit['credit']->credits_price; ?> CAD</td>
                <td>
                    <form action="" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="delete_id" value="<?php echo $credit['credit']->id ?>">
                        <button class="btn btn-danger" onclick="return confirm('Do you really want to delete this package?');"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            <?php } } ?>
        </tbody>
    </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
    if(!empty($users)) {
        foreach($users as $row) {
            $u_id=$row['user']->id;
?>
<div class="modal fade" id="details-<?php echo $row['user']->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="update" value="<?php echo $row['user']->id; ?>">
              <div class="modal-header">
                  <h5 class="modal-title"><i class="fa fa-building"></i> <b><?php echo $row['user']->first_name.' '.$row['user']->last_name; ?> Details</b></h5>
              </div>
              <div class="modal-body">
                  <h4><i class="fa fa-info-circle"></i> About</h4><hr>
                  <table class="table table-striped">
                <tbody>
                    <tr>
                        <td><b>Gender:</b></td><td><?php echo $row['user']->gender; ?></td>
                    </tr>
                    <tr>
                        <td><b>Email:</b></td><td><?php echo $row['user']->email; ?></td>
                    </tr>
                    <tr>
                        <td><b>Phone:</b></td><td><?php echo $row['user']->phone; ?></td>
                    </tr>
                    <tr>
                        <td><b>Country:</b></td><td><?php echo $row['user']->country; ?></td>
                    </tr>
                    <tr>
                        <td><b>City:</b></td><td><?php echo $row['user']->city; ?></td>
                    </tr>

                    </tbody>
                <tfoot>

                </tfoot>
              </table>
                  
                  <h4><i class="fa fa-file"></i> Documents</h4><hr>
                  <table class="table table-striped">
                <tbody>
                    <?php if($row['user']->type=='Driver') { ?>
                    <tr>
                        <td><b>Driver License:</b></td><td><a href="<?php echo url('users_files/'.$row['user']->driver_license); ?>" target="_blank"><?php echo $row['user']->driver_license; ?></a></td>
                    </tr>
                    <?php } ?>
                    
                    <?php if($row['user']->type=='Student') { ?>
                    <tr>
                        <td><b>Student Card:</b></td><td><a href="<?php echo url('users_files/'.$row['user']->student_card); ?>" target="_blank"><?php echo $row['user']->student_card; ?></a></td>
                    </tr>
                    <tr>
                        <td><b>School Name:</b></td><td><?php echo $row['user']->school_name; ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                <tfoot>

                </tfoot>
              </table>
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
              </div>
                  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
<?php } } ?>

<script>
    function show_levels(id) {
        $('#levels-'+id).show();
    }
</script>
<?php include(app_path().'/admin/common/footer.php'); 
?>

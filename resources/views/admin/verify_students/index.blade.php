<?php
$pstudent_page='active';
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
        Verify students
        <small><?php echo count($users); ?> total verifications</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/verify-students'); ?>">Verify students</a></li>
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
              
              <!--<button class="btn btn-success" style="float:right;" onclick="add_new()">+ Add New</button>-->

          <form role="form" action="" method="post" style="display:none;" id="add_new">
              {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Username<font style="color:red;">*</font></label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" required name="username">
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Password<font style="color:red;">*</font></label>
                  <input type="password" class="form-control" id="exampleInputEmail1" placeholder="" required name="pass">
                </div>
                  
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add</button>
              </div>
              <hr>
          </form>
              <script>
                  function add_new(){
                      $("#add_new").slideToggle();
                  }
              </script>

            <div class="box-body" style="margin-top:30px;">
                <?php if(Session::has('success')) { ?>
                    <p class="alert alert-success"><?php echo Session::get('success'); ?></p>
                <?php } ?>
                <?php if(Session::has('error')) { ?>
                    <p class="alert alert-success"><?php echo Session::get('error'); ?></p>
                <?php } ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Student card</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    if(!empty($users)) { $ids=array(); $i=0;
                        foreach($users as $row) {
                        $r_id=$row['user']->id;
                   ?>
                <tr>
                  <td><?php echo $row['user']->id; ?></td>
                  <td><?php echo $row['user']->first_name.' '.$row['user']->last_name; ?></td>
                  <td><?php echo $row['user']->email; ?>
                      <p style="color: #777;"><?php echo $row['user']->created_on; ?></p>
                    </td>
                    <td><?php echo $row['user']->phone; ?></td>
                    <td><a href="<?php echo url('student_cards/'.$row['user']->student_card); ?>" target="_blank"><?php echo $row['user']->student_card; ?></a></td>
                    <td><?php 
                            if($row['user']->student=='0') echo 'Information not provided';
                            else if($row['user']->student=='1') echo 'Accepted';
                            else if($row['user']->student=='3') echo 'Rejected';
                            else if($row['user']->student=='2') echo 'Under Review';
                        ?></td>
                  <td>
                      <form action="" method="post" style="display:inline;">
                        {{ csrf_field() }}
                    <input type="hidden" name="approve" value="<?php echo $row['user']->id; ?>">
                    <button type="submit" class="btn btn-success" style="margin-bottom:6px;">Approve</button>
                  </form>
                      
                      <?php if($row['user']->status!='3') { ?>
                      <form action="" method="post" style="display:inline;">
                        {{ csrf_field() }}
                    <input type="hidden" name="reject" value="<?php echo $row['user']->id; ?>">
                    <button type="submit" class="btn btn-danger" style="margin-bottom:6px;">Reject</button>
                  </form>
                      <?php } ?>
                      <br>
                      
                      <button class="btn btn-success" data-toggle="modal" data-target="#details-<?php echo $r_id; ?>" title="User Details"><i class="fa fa-list"></i></button>
                    <form action="" method="post" style="display:inline;">
                        {{ csrf_field() }}
                    <input type="hidden" name="delete_id" value="<?php echo $row['user']->id; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this user?');"><i class="fa fa-trash"></i></button>
                  </form>
                  </td>
                </tr>
                    
                <?php } } ?>
                    
                </tbody>
                <tfoot>

                </tfoot>
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
$user2=$users;
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
                    <tr>
                        <td><b>Free rides:</b></td><td><?php echo $row['user']->free_rides; ?></td>
                    </tr>
                    <tr>
                        <td><b>Referral:</b></td><td><?php echo $row['referral']; ?></td>
                    </tr>

                    </tbody>
                <tfoot>

                </tfoot>
              </table>
                  
                  <h4><i class="fa fa-file"></i> Documents</h4><hr>
                  <table class="table table-striped">
                <tbody>
                    <?php if($row['user']->driver_license!='') { ?>
                    <tr>
                        <td><b>Driver License:</b></td><td><a href="<?php echo url('driver_license/'.$row['user']->driver_license); ?>" target="_blank"><?php echo $row['user']->driver_license; ?></a></td>
                    </tr>
                    <?php } ?>
                    
                    <?php if($row['user']->student_card!='') { ?>
                    <tr>
                        <td><b>Student Card:</b></td><td><a href="<?php echo url('student_cards/'.$row['user']->student_card); ?>" target="_blank"><?php echo $row['user']->student_card; ?></a></td>
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

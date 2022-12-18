<?php
$user_page='active';
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
        All users
        <small><?php echo count($users); ?> total users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/users'); ?>">All users</a></li>
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
                <?php if(isset($error) AND !empty($error)) echo $error.'<br><br>'; ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Driver</th>
                  <th>Student</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    if(!empty($users)) { $ids=array(); $i=0;
                        foreach($users as $row) {
                            if($row['user']->driver == 1){
                        $r_id=$row['user']->id;
                        
                   ?>
                <tr>
                  <td><?php echo $row['user']->id; ?></td>
                  <td><?php echo $row['user']->first_name.' '.$row['user']->last_name; ?></td>
                  <td><?php echo $row['user']->email; ?>
                      <p style="color: #777;"><?php echo $row['user']->created_on; ?></p>
                    </td>
                    <td><?php echo $row['user']->phone; ?></td>
                    <td><?php if($row['user']->driver=='1') echo 'Yes'; else echo 'No'; ?></td>
                    <td><?php if($row['user']->student=='1') echo 'Yes'; else echo 'No'; ?></td>
                  <td>
                      <a href="<?php echo url('admin/access-portal/'.$r_id); ?>" target="_blank"><button class="btn btn-primary" style="margin-bottom:5px;">Access portal</button></a>
                      
                      <button class="btn btn-success" data-toggle="modal" data-target="#details-<?php echo $r_id; ?>" title="User Details" style="margin-bottom:5px;"><i class="fa fa-list"></i></button><br>
                      
                      <form action="" method="post" style="display:inline;">
                        {{ csrf_field() }}
                    <input type="hidden" name="suspend_id" value="<?php echo $row['user']->id; ?>">
                    <input type="hidden" name="suspend" value="<?php echo $row['user']->suspend; ?>">
                    <button type="submit" class="btn <?php if($row['user']->suspend=='0') echo 'btn-default'; else echo 'btn-danger'; ?>"><?php if($row['user']->suspend=='0') echo 'Suspend'; else echo 'Suspended'; ?></button>
                  </form>
                      
                    <form action="" method="post" style="display:inline;">
                        {{ csrf_field() }}
                    <input type="hidden" name="delete_id" value="<?php echo $row['user']->id; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this user?');"><i class="fa fa-trash"></i></button>
                  </form>
                  </td>
                </tr>
                    
                <?php } } } ?>
                    
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
                  <h4><i class="fa fa-credit-card"></i> Booking Fee</h4><hr style="margin-top:10px; margin-bottom:10px;">
                  <div class="row" style="margin-top:0px; margin-bottom:20px;">
                  <div class="form-group">


                  <div class="col-sm-6 form-group">
                    <select class="form-control bookingOption" data-id="<?=$row['user']->id; ?>">
                      <option value="0">Booking Fee By Cash</option>
                       <option value="1">Booking Fee By Percentage</option>
                    </select>
                  </div>




                  <div class="col-sm-6" id="booking_cash_<?=$row['user']->id; ?>">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                        <input type="number" class="form-control" name="booking_price" value="<?php echo $row['user']->booking_price; ?>" step="any" min="0">
                    </div>
                  </div>
                      
                      <div class="col-sm-6 d-none" id="booking_per_<?=$row['user']->id; ?>" style="display: none;">
                          <div class="input-group">
                        <input type="number" class="form-control" name="booking_per" value="<?php echo $row['user']->booking_per; ?>" step="any" min="0">
                        <span class="input-group-addon" style="font-weight:bold;">%</span>
                    </div>
                  </div>
                      
                      <div class="col-sm-12">
                          <div class="form-group" style="margin-bottom:0px; margin-top:10px;">
                              <label>Charge booking fee:</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="charge_booking" value="1" <?php if($row['user']->charge_booking=='1') echo 'checked'; ?> > Yes &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="charge_booking" value="0" <?php if($row['user']->charge_booking=='0') echo 'checked'; ?> > No
                    </div>
                  </div>
                      
                      <div class="col-sm-12">
                          <div class="form-group" style="margin-bottom:0px; margin-top:10px;">
                              <label>Email verified:</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="verify" value="1" <?php if($row['user']->verify=='1') echo 'checked'; ?> > Yes &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="verify" value="0" <?php if($row['user']->verify=='0') echo 'checked'; ?> > No
                    </div>
                  </div>
                      
                      <div class="col-sm-12">
                          <div class="form-group" style="margin-bottom:0px; margin-top:10px;">
                              <label>Phone verified:</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="phone_verified" value="1" <?php if($row['user']->phone_verified=='1') echo 'checked'; ?> > Yes &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="phone_verified" value="0" <?php if($row['user']->phone_verified=='0') echo 'checked'; ?> > No
                            </div>
                      </div>
                      
                      <div class="col-sm-12">
                          <div class="form-group" style="margin-bottom:0px; margin-top:10px;">
                              <label>Driver's license verified:</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="driver_verified" value="1" <?php if($row['user']->driver=='1') echo 'checked'; ?> > Yes &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="driver_verified" value="0" <?php if($row['user']->driver!='1') echo 'checked'; ?> > No
                            </div>
                      </div>
                      
                      <div class="col-sm-12 d-none">
                          <div class="form-group" style="margin-bottom:0px; margin-top:10px;">
                              <label>Student card verified:</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="student_verified" value="1" <?php if($row['user']->student=='1') echo 'checked'; ?> > Yes &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="student_verified" value="0" <?php if($row['user']->student!='1') echo 'checked'; ?> > No
                            </div>
                      </div>
                </div>
                  </div>
                  
                  <h4><i class="fa fa-info-circle"></i> About</h4><hr style="margin-top:10px;">
                  <table class="table table-striped">
                <tbody>
                    <tr>
                        <td><b>Gender:</b></td><td><?php echo $row['user']->gender; ?></td>
                    </tr>
                    <tr>
                        <td><b>Email:</b></td><td><?php echo $row['user']->email; if($row['user']->verify=='1') echo ' (verified)'; ?></td>
                    </tr>
                    <tr>
                        <td><b>Phone:</b></td><td><?php echo $row['user']->phone; if($row['user']->phone!='' AND $row['user']->phone_verified=='1') echo ' (verified)'; ?></td>
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
                  
                  <h4><i class="fa fa-file"></i> Documents</h4><hr style="margin-top:10px;">
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
                <button type="submit" class="btn btn-primary pull-right">Update</button>
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal" style="margin-right:10px;">Close</button>
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
<script type="text/javascript">
  $(".bookingOption").change(function(){

    var id = $(this).attr('data-id');

    var value = $(this).val();

    if (value == "0") {

      $("#booking_cash_"+id).show();

      $("#booking_per_"+id).hide();

    }else{

      $("#booking_cash_"+id).hide();
      $("#booking_per_"+id).show();
     

    }

  });
</script>
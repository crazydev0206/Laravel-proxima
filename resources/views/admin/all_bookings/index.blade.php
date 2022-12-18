<?php $bookings_page='active';
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
        All Bookings
        <small><?php echo count($bookings); ?> total bookings</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/bookings'); ?>">All Bookings</a></li>
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

            <div class="box-body" style="margin-top:30px;">
                <?php if(isset($error) AND !empty($error)) echo $error.'<br><br>'; ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Ride</th>
                  <th>Driver</th>
                  <th>Passenger</th>
                  <th>Payment</th>
                  <th>Status</th>
                  <th>Booked on</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    if(!empty($bookings)) { $ids=array(); $i=0;
                        foreach($bookings as $row) {
                        $r_id=$row['booking']->id;
                            
                        $from=$row['ride']->departure_city;
                        $to=$row['ride']->destination_city;
                    
                        $place_from=$row['ride']->departure_place;
                        $place_to=$row['ride']->destination_place;
                    
                        if($from=='') $from=$row['ride']->departure_place;
                        if($to=='') $to=$row['ride']->destination_place;
                    
                        if($from=='') $from=$row['ride']->departure_state;
                        if($to=='') $to=$row['ride']->destination_state;

                        if($from=='') $from=$row['ride']->departure;
                        if($to=='') $to=$row['ride']->destination;
                   ?>
                <tr>
                  <td><?php echo $row['booking']->id; ?></td>
                  <td><?php  echo '#'.$row['ride']->id.' - '.$from.' to '.$to; ?></td>
                    <td><?php if($row['driver']!='NA') { echo $row['driver']->first_name.' '.$row['driver']->last_name; ?>
                    <p style="color: #777;"><?php echo $row['driver']->email; ?></p>
                        <?php } else echo 'User deleted.'; ?>
                    </td>
                    <td><?php if($row['passenger']!='NA') { echo $row['passenger']->first_name.' '.$row['passenger']->last_name; ?>
                    <p style="color: #777;"><?php echo $row['passenger']->email; ?></p>
                        <?php } else echo 'User deleted.'; ?>
                    </td>
                    <td>
                        Price/Seat: $<?php echo $row['ride']->price; ?> CAD<br>
                        Seats booked: <?php echo $row['booking']->seats; ?><br>
                        Booking fee: $<?php echo $row['booking']->booking_price; ?> CAD<br>
                        Total cost: $<?php echo ($row['ride']->price*$row['booking']->seats)+$row['booking']->booking_price; ?> CAD<br><br>
                        
                        Payment method: <?php echo $row['ride']->payment_method; ?><br>
                    </td>
                    <td><?php 
                            if($row['booking']->status=='0') echo 'Under review';
                            if($row['booking']->status=='1') echo 'Ride booked';
                            if($row['booking']->status=='2') echo 'Ride completed';
                            if($row['booking']->status=='3') echo 'Ride rejected';
                        ?></td>
                    <td><?php echo date_format(new DateTime($row['booking']->booked_on),'d-m-Y'); ?>
                      <p style="color: #777;"><?php echo date_format(new DateTime($row['booking']->booked_on),'h:i a'); ?></p>
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

<?php include(app_path().'/admin/common/header.php'); ?>
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
        Rides
        <small><?php echo count($rides); ?> total rides</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/rides'); ?>">Rides</a></li>
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
                  <th>Ride</th>
                  <th>Driver</th>
                  <th>Leaving on</th>
                  <th>Price/Seat</th>
                  <th style="min-width:40px;">Seats</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    if(!empty($rides)) { $ids=array(); $i=0;
                        foreach($rides as $row) {
                        $r_id=$row['ride']->id;
                            
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
                  <td><?php echo $row['ride']->id; ?></td>
                  <td><?php  echo $from.' to '.$to; ?></td>
                    <td><?php echo $row['driver']->first_name.' '.$row['driver']->last_name; ?>
                    <p style="color: #777;"><?php echo $row['driver']->email; ?></p>
                    </td>
                  <td><?php echo date_format(new DateTime($row['ride']->date),'d-m-Y'); ?>
                      <p style="color: #777;"><?php echo date_format(new DateTime($row['ride']->time),'h:i a'); ?></p>
                    </td>
                    <td>
                        $<?php echo $row['ride']->price; ?> CAD
                        <p style="color:#777;"><?php echo $row['ride']->payment_method; ?></p>
                    </td>
                    <td><?php echo $row['ride']->seats; ?>
                    <p style="color: #777;"><?php echo $row['seats_left']; ?> seats left</p>
                    </td>
                    <td><?php 
                        if($row['ride']->status=='0') echo 'Active'; 
                        else if($row['ride']->status=='1') echo 'Completed';
                        else if($row['ride']->status=='2') echo 'Cancelled';
                        ?></td>
                    <!--<td><?php echo date_format(new DateTime($row['ride']->added_on),'d-m-Y'); ?>
                      <p style="color: #777;"><?php echo date_format(new DateTime($row['ride']->added_on),'h:i a'); ?></p>
                    </td>-->
                  <td>
                      <button class="btn btn-success" data-toggle="modal" data-target="#details-<?php echo $r_id; ?>" title="Ride Details"><i class="fa fa-list"></i></button>
                      
                      <?php if($row['ride']->status=='0') { ?><br>
                      <form action="" method="post" style="display:inline;">
                        {{ csrf_field() }}
                    <input type="hidden" name="cancel_id" value="<?php echo $row['ride']->id; ?>">
                    <button type="submit" class="btn <?php if($row['ride']->status=='0') echo 'btn-default'; else echo 'btn-danger'; ?>" style="margin-top:5px;" onclick="return confirm('Are you sure you want to cancel this ride?');"><?php if($row['ride']->status=='0') echo 'Cancel'; else echo 'Cancelled'; ?></button>
                  </form>
                      <?php } ?>


                      <?php 

                      if ($row['ride']->suspend == '0') {
                        // code...
                        ?>
                        <button class="btn btn-md btn-danger suspendRide" data-id="<?=$row['ride']->id; ?>">Suspend</button>
                        <?php 
                      }else{

                        ?>
                          <button class="btn btn-md btn-danger suspendRide" data-id="<?=$row['ride']->id; ?>">Suspended</button>
                        <?php 
                      }

                      ?>


                    <!--<form action="" method="post" style="display:inline;">
                        {{ csrf_field() }}
                    <input type="hidden" name="delete_id" value="<?php echo $row['ride']->id; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this ride?');"><i class="fa fa-trash"></i></button>
                  </form>-->
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
    if(!empty($rides)) {
        foreach($rides as $row) {
            $u_id=$row['ride']->id;
            
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
<div class="modal fade" id="details-<?php echo $row['ride']->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="update" value="<?php echo $row['ride']->id; ?>">
              <div class="modal-header">
                  <h5 class="modal-title"><b> #<?php echo $r_id; ?> - <?php echo $from.' to '.$to; ?></b></h5>
              </div>
              <div class="modal-body" style="padding-top:0px;">
                  <h4><i class="fa fa-info-circle"></i> Details</h4><hr style="margin-top:0px;">
                  <table class="table table-striped">
                <tbody>
                    <tr>
                        <td><b>Details:</b></td><td><?php echo $row['ride']->details; ?></td>
                    </tr>
                    <tr>
                        <td><b>Vehicle:</b></td><td><?php 
            echo 'Model - '.$row['ride']->details;
            echo '<br>Vehicle type - '.$row['ride']->vehicle_type;
            echo ', Other - '.$row['ride']->other;
            echo '<br>Year - '.$row['ride']->year;
            echo ', Color - '.$row['ride']->color;
            echo '<br>License No. - '.$row['ride']->license_no;
            echo '<br>Car type - '.$row['ride']->car_type;
                        ?></td>
                    </tr>
                    <tr>
                        <td><b>Features:</b></td><td><?php 
            if(!empty($row['ride']->features)) {
                $features=explode(';', $row['ride']->features);
                $i=0;
                foreach($features as $f)
                {
                    if($i++==0) echo $f;
                    else echo ', '.$f;
                }
            }
                        ?></td>
                    </tr>
                    <tr>
                        <td><b>Luggage:</b></td><td><?php echo $row['ride']->luggage; ?></td>
                    </tr>
                    <tr>
                        <td><b>Smoke:</b></td><td><?php echo $row['ride']->smoke; ?></td>
                    </tr>
                    <tr>
                        <td style="min-width:130px;"><b>Animal friendly:</b></td><td><?php echo $row['ride']->animal_friendly; ?></td>
                    </tr>
                    <tr>
                        <td><b>Booking method:</b></td><td><?php echo $row['ride']->booking_method; ?></td>
                    </tr>
                    <tr>
                        <td><b>Notes:</b></td><td><?php echo $row['ride']->notes; ?></td>
                    </tr>

                    </tbody>
                <tfoot>

                </tfoot>
              </table>
                  
                  <h4 style="margin-top:20px;"><i class="fa fa-credit-card"></i> Bookings</h4><hr style="margin-top:0px;">
                  
                  <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Passenger</th>
                  <th>Payment</th>
                  <th>Status</th>
                  <th>Booked On</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    if(!empty($row['bookings'])) {
                        foreach($row['bookings'] as $row2) {
                        $r_id=$row2['booking']->id;
                   ?>
                <tr>
                  <td><?php echo $row2['booking']->id; ?></td>
                    <td><?php if($row2['passenger']!='NA') { echo $row2['passenger']->first_name.' '.$row2['passenger']->last_name; ?>
                    <p style="color: #777;"><?php echo $row2['passenger']->email; ?></p>
                        <?php } else echo 'User deleted.'; ?>
                    </td>
                    <td>
                        Price/Seat: $<?php echo $row2['ride']->price; ?> CAD<br>
                        Seats booked: <?php echo $row2['booking']->seats; ?><br>
                        Booking price: $<?php echo $row2['booking']->booking_price; ?> CAD<br>
                        Total cost: $<?php echo ($row2['ride']->price*$row2['booking']->seats)+$row2['booking']->booking_price; ?> CAD<br><br>
                        
                        Payment method: <?php echo $row2['ride']->payment_method; ?><br>
                    </td>
                    <td><?php 
                            if($row2['booking']->status=='0') echo 'Under review';
                            if($row2['booking']->status=='1') echo 'Ride booked';
                            if($row2['booking']->status=='2') echo 'Ride completed';
                            if($row2['booking']->status=='3') echo 'Ride rejected';
                        ?></td>
                    <td><?php echo date_format(new DateTime($row2['booking']->booked_on),'d-m-Y'); ?>
                      <p style="color: #777;"><?php echo date_format(new DateTime($row2['booking']->booked_on),'h:i a'); ?></p>
                    </td>
                </tr>
                    
                <?php } } ?>
                    
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

<script type="text/javascript">
  $(".suspendRide").click(function(){

    var id = $(this).attr('data-id');

    var txt = $(this).html();

    var suspendValue = 0;

    if (txt == 'Suspend') {

        $(this).html('Suspended');

        suspendValue = 1;

    }else{

      $(this).html('Suspend');

      suspendValue = 0;
    }

    var url = '<?=url('api'); ?>';

    $.get(url + "/suspend_ride",{id:id, status:suspendValue}, function(data){

      if (suspendValue == "1") {

        alert("Ride Suspended");
      
      }

    });

    

  });
</script>
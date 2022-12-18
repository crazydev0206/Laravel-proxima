<?php $reviews_page='active';
include(app_path().'/admin/common/header.php'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css" rel="stylesheet" type="text/css" />
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
        All reviews
        <small><?php echo count($reviews); ?> total reviews</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/reviews'); ?>">All reviews</a></li>
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
                  <th>Review</th>
                  <th>Ride</th>
                  <th>Driver</th>
                  <th>Passenger</th>
                  <th>Private rating</th>
                  <th>On date</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    if(!empty($reviews)) { $ids=array(); $i=0;
                        foreach($reviews as $row) {
                        $r_id=$row['rating']->id;
                            
                        $from='';
                        $to='';
                        $place_from='';
                        $place_to='';
                        
                        if($row['ride']!='NA') 
                        {
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
                        }
                   ?>
                <tr>
                  <td><?php echo $row['rating']->id; ?></td>
                  <td>
                      <p style="color:#777;"><?php 
                            if($row['rating']->type=='1') echo 'Driver review';
                            if($row['rating']->type=='2') echo 'Passenger review';
                        ?></p>
                      
                      <div class='r-rateing' style="padding-left:0px; maring-left:0px; margin-bottom:5px;">
<div class='profile-rating' data-background='#808080' data-readonly='true' data-rating='<?php echo $row['avg_rating']; ?>' data-size='20px'></div>
</div>
                      
                      <?php  echo $row['rating']->review; ?>
                    </td>
                  <td><?php if($row['ride']!='NA') { echo '#'.$row['ride']->id.'<br> <a href="'.url('ride/'.$row['ride']->url).'" target="_blank">'.$from.' to '.$to.'</a>'; } else echo 'Ride deleted.'; ?></td>
                    <td><?php if($row['driver']!='NA') { echo $row['driver']->first_name.' '.$row['driver']->last_name; ?>
                    <p style="color: #777;"><?php echo $row['driver']->email; ?></p>
                        <?php } else echo 'User deleted.'; ?>
                    </td>
                    <td><?php if($row['passenger']!='NA') { echo $row['passenger']->first_name.' '.$row['passenger']->last_name; ?>
                    <p style="color: #777;"><?php echo $row['passenger']->email; ?></p>
                        <?php } else echo 'User deleted.'; ?>
                    </td>
                    <td>
                        <b>Recommend:</b> <?php if($row['rating']->recommend=='') echo 'NA'; else echo $row['rating']->recommend; ?><br>
                        <b>Note:</b> <?php echo $row['rating']->note; ?>
                    </td>
                    <td><?php echo date_format(new DateTime($row['rating']->added_on),'d-m-Y'); ?>
                      <p style="color: #777;"><?php echo date_format(new DateTime($row['rating']->added_on),'h:i a'); ?></p>
                    </td>
                    <td>
                    <form action="" method="post" style="display:inline;">
                        {{ csrf_field() }}
                    <input type="hidden" name="feature_id" value="<?php echo $row['rating']->id; ?>">
                        <?php if($row['rating']->feature=='0') { ?>
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Do you really want to mark this review as featured?');"><i class="fa fa-star"></i></button>
                        <?php } ?>
                        <?php if($row['rating']->feature=='1') { ?>
                            <button type="submit" class="btn btn-success" onclick="return confirm('Do you really want to remove this review from feature list?');"><i class="fa fa-star"></i></button>
                        <?php } ?>
                  </form>
                        
                    <form action="" method="post" style="display:inline;">
                        {{ csrf_field() }}
                    <input type="hidden" name="delete_id" value="<?php echo $row['rating']->id; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this review?');"><i class="fa fa-trash"></i></button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js" type="text/javascript"></script>
<script src="<?php echo url('javascripts/common.js'); ?>"></script>
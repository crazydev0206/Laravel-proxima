<?php $transactions_page='active';
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
        All Transactions
        <small><?php echo count($transactions); ?> total transactions</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/transactions'); ?>">All Transactions</a></li>
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
                <th>From user</th>
                <th>To user</th>
                <th>Transaction details</th>
                <th>Amount</th>
                <th>On date</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(!empty($transactions)) {
                foreach($transactions as $transaction) {
                    $type=$transaction['transaction']->type;
                    
                    $url='';
                    if($transaction['link']!='NA' AND ($type=='1' OR $type=='2'))
                    $url='<br><a href="'.url('ride/'.$transaction['link']->url).'" target="_blank">View Ride</a>';
                    
                    $details='';
                    if($type=='1') $details='Debited for booking a ride'.$url;
                    else if($type=='2') $details='Credited on ride completion'.$url;
                    else if($type=='3') $details='Amount refunded on ride cancellation'.$url;
                    else if($type=='4') $details='Debited booking price for the ride'.$url;
                    else if($type=='5') $details='Amount refunded on ride completion'.$url;
                    else if($type=='6') $details='Amount refunded on seat(s) cancelled'.$url;
                    else if($type=='7') $details='Credited on seat(s) cancelled by passenger <br>(late notice)'.$url;
            ?>
            <tr>
                <td><?php echo $transaction['transaction']->id; ?></td>
                <td><?php 
                    if($transaction['user']!='NA') {
                        echo $transaction['user']->first_name.' '.$transaction['user']->last_name.'<p style="color: #777;">'.$transaction['user']->email.'</p>';
                    }
                    else echo 'User deleted.';
                    ?></td>
                <td><?php 
                    if($transaction['for_user']!='NA') {
                        if($type=='1') echo 'NA';
                        else
                        echo $transaction['for_user']->first_name.' '.$transaction['for_user']->last_name.'<p style="color: #777;">'.$transaction['for_user']->email.'</p>';
                    }
                    else echo 'User deleted.';
                    ?></td>
                <td><?php echo $details; ?></td>
                <td style="<?php if($type=='2') echo 'color:green'; ?>"><?php if($type=='1' OR $type=='4') echo '- '; ?>$<?php echo $transaction['transaction']->price; ?> CAD</td>
                <td>
                    <?php echo date_format(new DateTime($transaction['transaction']->on_date),'d-m-Y'); ?>
                    <p style="color: #777;"><?php echo date_format(new DateTime($transaction['transaction']->on_date),'H:i'); ?></p>
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

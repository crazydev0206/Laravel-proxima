<?php $withdrawal_page='active';
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
        Withdrawal requests
        <small><?php echo count($requests); ?> total requests</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/withdrawal-requests'); ?>">Withdrawal requests</a></li>
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

            <div class="box-body" style="margin-top:0px;">
                <?php if(Session::has('success')) { ?>
    <p class="alert alert-success"><?php echo Session::get('success'); ?></p>
    <?php } ?>
    <?php if(Session::has('error')) { ?>
    <p class="alert alert-danger"><?php echo Session::get('error'); ?></p>
    <?php } ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Requested by</th>
                <th>Amount requested</th>
                <th>Status</th>
                <th>Requested on</th>
                <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(!empty($requests)) { $i=1; $ids=array();
                    foreach($requests as $row) {
                        $r_id=$row['request']->id;
                        if(!in_array($r_id,$ids)) $ids[]=$r_id;
                        
                if($row['request']->status=='0') $status='<font style="color:blue;"><b>Under Review</b></font>';
                else if($row['request']->status=='1') $status='<font style="color:green;"><b>✓</b> Released</font>';
                else if($row['request']->status=='2') $status='<font style="color:red;"><b>X</b> Cancelled</font>';
                   ?>
                <tr>
                  <td><?php echo $row['request']->id; ?></td>
                  <td><?php echo $row['user']->first_name.' '.$row['user']->last_name; ?>
                    <p style="color:#777;"><?php echo $row['user']->email; ?></p>
                    </td>
                    <td>$<?php echo $row['request']->amount; ?> CAD
                        <p style="color:#777;"><u>Method:</u> <b><?php echo $row['request']->method; ?></b></p>
                        <p style="color:#777;"><u>Current Balance:</u> <b>$<?php echo $row['user']->balance; ?> CAD</b></p>
                    </td>
                    <td><?php echo $status;
                        if($row['request']->status=='2') echo '<p style="color:#777;"><u>Reason:</u> '.$row['request']->reason.'</p>';
                        ?></td>
                  <td>
                    <?php echo date_format(new DateTime($row['request']->on_date),'d-m-Y'); ?>
                    <p style="color: #777;"><?php echo date_format(new DateTime($row['request']->on_date),'H:i'); ?></p>
                </td>
                  <td>
                      <?php if($row['request']->status=='0') { ?>
                      <form action="" method="post" style="display:inline;">
                          {{ csrf_field() }}
                    <input type="hidden" name="accept" value="<?php echo $row['request']->id; ?>">
                    <button type="submit" class="btn btn-success" onclick="return confirm('Do you really want to accept this request?');" style="margin-bottom:5px;">Accept</button>
                  </form>
                      
                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $r_id; ?>" style="margin-bottom:5px;">Reject</button><br>
                      <?php } ?>
                      
                      <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#details-<?php echo $r_id; ?>"><i class="fa fa-list"></i> Details</button>
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
<?php foreach($requests as $row) {
    $r_id=$row['request']->id;
?>
      <div class="modal fade" id="details-<?php echo $r_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="update" value="<?php echo $r_id; ?>">
              <div class="modal-header">
                  <h3 class="modal-title"><?php echo $row['user']->first_name.' '.$row['user']->last_name; ?></h3>
              </div>
              <div class="modal-body">
                  <table class="table table-striped">
                <tbody>
                    <tr><td><b>Payout method:</b></td><td>
                        <?php echo $row['request']->method; ?>
                        </td></tr>
                    </tbody>
                <tfoot>

                </tfoot>
              </table>
                  
                  <h4 style="margin-top:30px;"><i class="fa fa-paypal"></i> PayPal Details</h4><hr style="margin-top:0px;">
                  
                  <table class="table table-striped">
                <tbody>
                    <tr><td><b>PayPal email:</b></td><td>
                        <?php echo $row['request']->paypal_email; ?>
                        </td></tr>
                    </tbody>
                <tfoot>

                </tfoot>
              </table>
                  
                  <h4 style="margin-top:30px;"><i class="fa fa-bank"></i> Bank Details</h4><hr style="margin-top:0px;">
                  
                  <table class="table table-striped">
                <tbody>
                    <tr><td><b>Account Number:</b></td><td>
                        <?php echo $row['request']->account_no; ?>
                        </td></tr>
                    
                    <tr><td><b>Bank Name:</b></td><td>
                        <?php echo $row['request']->bank_name; ?>
                        </td></tr>
                    
                    <tr><td><b>IFSC:</b></td><td>
                        <?php echo $row['request']->ifsc_code; ?>
                        </td></tr>
                    
                    <tr><td><b>Country:</b></td><td>
                        <?php echo $row['request']->country; ?>
                        </td></tr>
                    </tbody>
                <tfoot>

                </tfoot>
              </table>
                  
                  <h4 style="margin-top:30px;"><i class="fa fa-info-circle"></i> Basic Details</h4><hr style="margin-top:0px;">
                  
                  <table class="table table-striped">
                <tbody>
                  <tr><td><b>Email:</b></td><td>
                        <?php echo $row['user']->email; ?>
                        </td></tr>
                    
                    <tr><td><b>Phone:</b></td><td>
                        <?php echo $row['user']->phone; ?>
                        </td></tr>
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
<?php } ?>

<?php
    if(!empty($ids)) {
        foreach($ids as $id) {
?>
        <div class="modal fade" id="myModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="reject" value="<?php echo $id; ?>">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Enter Reason</h4>
              </div>
              <div class="modal-body">
                    <div class="form-group">
                      <textarea class="form-control" rows="4" placeholder="Reason for Rejecting.." name="reason" required></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Reject</button>
              </div>
                  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

    <div class="modal fade" id="myModal2<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    <input type="hidden" name="more" value="<?php echo $id; ?>">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">More Information</h4>
              </div>
              <div class="modal-body">
                  <style>
                      td.bold{
                          font-weight: bold;
                      }
                  </style>
                  <h4 style="font-weight:bold; color:#3c8dbc;">Personal Details: </h4>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <?php 
                              $q="SELECT * FROM users WHERE id='$id' LIMIT 1";
                              $r=@mysqli_query($dbc,$q);
                              $row=@mysqli_fetch_assoc($r);
                            ?>
                            <tr><td class="bold">Name:</td><td><?php echo $row['name']; ?></td></tr>
                            <tr><td class="bold">Email:</td><td><?php echo $row['email']; ?></td></tr>
                            <tr><td class="bold">Phone:</td><td><?php echo $row['number']; ?></td></tr>
                            <tr><td class="bold">City:</td><td><?php echo $row['city']; ?></td></tr>
                            <tr><td class="bold">Specialities:</td><td><?php echo $row['skills']; ?></td></tr>
                            <tr><td class="bold">Registration Number:</td><td><?php echo $row['registration_no']; ?></td></tr>
                            <tr><td class="bold">Registration Year:</td><td><?php echo $row['reg_year']; ?></td></tr>
                            <tr><td class="bold">Council:</td><td><?php echo $row['council']; ?></td></tr>
                        </tbody>
                  </table>
                  
                  <h4 style="font-weight:bold; color:#3c8dbc;">Education: </h4>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <?php 
                              $q="SELECT * FROM education WHERE user_id='$id' LIMIT 1";
                              $r=@mysqli_query($dbc,$q);
                              $row=@mysqli_fetch_assoc($r);
                            ?>
                            <tr><td class="bold">Institute Name:</td><td><?php echo $row['institute']; ?></td></tr>
                            <tr><td class="bold">Degree:</td><td><?php echo $row['degree']; ?></td></tr>
                            <tr><td class="bold">Field:</td><td><?php echo $row['field']; ?></td></tr>
                            <tr><td class="bold">Education Year:</td><td><?php echo $row['edu_year']; ?></td></tr>
                        </tbody>
                  </table>
                  
                  <h4 style="font-weight:bold; color:#3c8dbc;">Employment: </h4>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <?php 
                              $q="SELECT * FROM experience WHERE user_id='$id' LIMIT 1";
                              $r=@mysqli_query($dbc,$q);
                              $row=@mysqli_fetch_assoc($r);
                            ?>
                            <tr><td class="bold">Designation:</td><td><?php echo $row['designation']; ?></td></tr>
                            <tr><td class="bold">Organisation:</td><td><?php echo $row['organisation']; ?></td></tr>
                            <tr><td class="bold">City:</td><td><?php echo $row['work_city']; ?></td></tr>
                            <tr><td class="bold">Joining Date:</td><td><?php echo $row['join_month'].', '.$row['join_year']; ?></td></tr>
                        </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              </div>
                  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
<?php 
        }
    } ?>
        <!-- /.modal -->
<?php include(app_path().'/admin/common/footer.php'); 
?>

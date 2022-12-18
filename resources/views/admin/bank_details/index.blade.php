<?php 
$app_with='active';
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
        Bank Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/withdrawal'); ?>">Withdrawal Requests</a></li>
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
                  <th>Bank Name</th>
                <th>IFSC</th>
                <th>Branch Name</th>
                <th>Status</th>
                <th>Requested On</th>
                <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(!empty($requests)) { $i=1; $ids=array();
                    foreach($requests as $row) {
                        $r_id=$row['id'];
                        if(!in_array($r_id,$ids)) $ids[]=$r_id;
                        
                if($row['status']=='1') $status='<font style="color:blue;"><b>Under Review</b></font>';
                else if($row['status']=='2') $status='<font style="color:green;"><b>✓</b> Released</font>';
                else if($row['status']=='3') $status='<font style="color:red;"><b>X</b> Cancelled</font>';
                   ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $row['user']->name.' <br>('.$row['user']->email.')'; ?></td>
                  <td><?php echo $row['method']; ?></td>
                    <td>$<?php echo $row['amount']; ?> CAD</td>
                    <td><?php echo $status; ?></td>
                  <td><?php echo $row['req_on']; ?></td>
                  <td>
                      <?php if($row['status']=='1') { ?>
                      <form action="" method="post" style="display:inline;">
                          {{ csrf_field() }}
                    <input type="hidden" name="accept" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-success" onclick="return confirm('Do you really want to mark this as transferred?');">Transferred</button>
                  </form><br>
                      
                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $r_id; ?>">Reject</button>
                      <?php } ?>
                      <form action="" method="post" style="display:inline;">
                          {{ csrf_field() }}
                    <input type="hidden" name="delete" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this application?');"><i class="fa fa-trash"></i></button>
                  </form><br><br>
                      
                      <a href="<?php echo url('admin/account_details/'.$row['user_id']); ?>" target="_blank"><button type="submit" class="btn btn-success"><i class="fa fa-list"></i> Details</button></a>
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

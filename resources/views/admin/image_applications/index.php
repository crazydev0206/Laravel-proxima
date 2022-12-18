<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');
    $app_image='active';

if($_SERVER['REQUEST_METHOD']=='POST') {
    
    if(isset($_POST['reject'])) {
        $reject=test_input($_POST['reject']);
        $reason=test_input($_POST['reason']);
        
        $q="SELECT email FROM users WHERE id='$reject' LIMIT 1";
        $r=@mysqli_query($dbc,$q);
        $row=@mysqli_fetch_assoc($r);
        $email=$row['email'];
        
        $q="UPDATE users SET new_image='', image_reason='$reason' WHERE id='$reject'";
        $r=@mysqli_query($dbc,$q);
        if($r) {
        }
    }
    
    if(isset($_POST['accept'])) {
        $accept=test_input($_POST['accept']);
        
        $q="SELECT email, new_image FROM users WHERE id='$accept' LIMIT 1";
        $r=@mysqli_query($dbc,$q);
        $row=@mysqli_fetch_assoc($r);
        $email=$row['email'];
        $new_image=$row['new_image'];
        
        $q="UPDATE users SET image='$new_image', new_image='' WHERE id='$accept'";
        $r=@mysqli_query($dbc,$q);
        if($r) {
        }
    }
}

$q="SELECT * FROM users WHERE new_image!='' ORDER BY id DESC";
$r=@mysqli_query($dbc,$q);

include('../common/header.php'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <?php include('../common/left_menu.php'); ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Image Applications
        <small><?php echo @mysqli_num_rows($r); ?> total applications</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../image_applications/">Image Applications</a></li>
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

          <form role="form" action="" method="post" style="margin-top:5px; display:none;" id="add_new">
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
                  <th>Old Avatar</th>
                  <th>New Avatar</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(@mysqli_num_rows($r)!=0) { $i=1; $ids=array();
                    while($row=@mysqli_fetch_assoc($r)) {
                        $r_id=$row['id'];
                        if(!in_array($r_id,$ids)) $ids[]=$r_id;
                   ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><img src="../../profile_images/<?php echo $row['image']; ?>" style="max-width:100px;">
                    </td>
                    <td><img src="../../profile_images/<?php echo $row['new_image']; ?>" style="max-width:100px;">
                    </td>
                  <td>
                      <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="accept" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-success" onclick="return confirm('Do you really want to accept this application?');">Accept</button>
                  </form>
                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $r_id; ?>">Reject</button>
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
                    <div class="form-group">
                      <textarea class="form-control" rows="4" placeholder="Mention required Files.." name="more_text" required></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send</button>
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
<?php include('../common/footer.php'); }
?>

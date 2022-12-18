<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');
    $ref='active';

if($_SERVER['REQUEST_METHOD']=='POST') {
    if(isset($_POST['suspend'])) {
  $suspend=test_input($_POST['suspend']);
  $suspend_status=test_input($_POST['suspend_status']);
        
        if($suspend_status=='1') $suspend_status='0';
        else  $suspend_status='1';
      
  $q="UPDATE users SET suspend='$suspend_status' WHERE id='$suspend'";
  $r=@mysqli_query($dbc,$q);
      
  }
    
  if(isset($_POST['delete_id'])) {
  $cat_id=test_input($_POST['delete_id']);
      
  $q="DELETE FROM users WHERE id='$cat_id'";
  $r=@mysqli_query($dbc,$q);
      
  }
}

$q="SELECT * FROM users WHERE approve='1' AND referral!='0' ORDER BY id DESC";
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
        All Referrals
        <small><?php echo @mysqli_num_rows($r); ?> total referrals</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../users/">All Users</a></li>
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
                  <th>User</th>
                  <th>Referred By</th>
                  <th>Registered On</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(@mysqli_num_rows($r)!=0) { $i=1;
                    while($row=@mysqli_fetch_assoc($r)) {
                        $r_id=$row['id'];
                        
                        $referral=$row['referral'];
                        $q2="SELECT name, email FROM users WHERE referral_link='$referral' LIMIT 1";
                        $r2=@mysqli_query($dbc,$q2);
                        $row2=@mysqli_fetch_assoc($r2);
                   ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $row['name'].'<br>('.$row['email'].')'; ?></td>
                  <td><?php echo $row2['name'].'<br>('.$row2['email'].')'; ?></td>
                  <td><?php echo $row['reg_on']; ?></td>
                  <td>
                      <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="suspend" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="suspend_status" value="<?php echo $row['suspend']; ?>">
                    <button type="submit" class="btn <?php if($row['suspend']=='1') echo 'btn-danger'; else echo 'btn-primary'; ?>" <?php if($row['suspend']=='0') { ?> onclick="return confirm('Do you really want to Suspend this user?');" <?php } else { ?> onclick="return confirm('Do you really want to Un-Suspend this user?');" <?php } ?> ><?php if($row['suspend']=='1') echo 'Suspended'; else echo 'Suspend'; ?></button>
                  </form>
                    <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
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
<?php include('../common/footer.php'); }
?>

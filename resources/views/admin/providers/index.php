<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');
$qn="UPDATE admin_notify SET seen='1' WHERE type='1'";
$rn=@mysqli_query($dbc,$qn);

if($_SERVER['REQUEST_METHOD']=='POST') {
  if(isset($_POST['user_id'])) {
    $user_id=test_input($_POST['user_id']);

    $q="DELETE FROM providers WHERE id='$user_id'";
    $r=@mysqli_query($dbc,$q);
  }

  if(isset($_POST['s_id'])) {
    $s_id=test_input($_POST['s_id']);

    $q="UPDATE users SET suspend='1' WHERE id='$s_id'";
    $r=@mysqli_query($dbc,$q);
  }
}

$q="SELECT * FROM providers";
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
        All Users
        <small><?php echo @mysqli_num_rows($r); ?> total users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../users">All Users</a></li>
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
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Business Name</th>
                  <th>Manager Name</th>
                  <th>Email</th>
                    <th>Phone</th>
                  <th>Activity</th>
                    <th>Website</th>
                    <th>Location</th>
                    <th>Reg On</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(@mysqli_num_rows($r)!=0) {
                    while($row=@mysqli_fetch_assoc($r)) {
                   ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['business_name']; ?></td>
                    <td><?php echo $row['manager_name']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['activity']; ?></td>
                    <td><?php echo $row['website']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                  <td><?php echo $row['reg_on']; ?></td>
                  <td>
                    <!--<form action="" method="post">
                    <input type="hidden" name="s_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to suspend this user?');"><?php //if($row['suspend']=='1') echo 'Suspended'; else echo 'Suspend'; ?></button>
                  </form>-->
                    <form action="" method="post">
                    <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this provider?');">Delete</button>
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

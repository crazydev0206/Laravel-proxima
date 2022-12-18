<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
  if(isset($_POST['team_id'])) {
    $qa_id=test_input($_POST['team_id']);

    $q="DELETE FROM teams WHERE id='$qa_id'";
    $r=@mysqli_query($dbc,$q);
  }
}

$q="SELECT * FROM jobs";
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
        All Jobs
        <small><?php echo @mysqli_num_rows($r); ?> total jobs</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../teams">All Teams</a></li>
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
                  <th>Title</th>
                  <th>Description</th>
                  <th>Created By</th>
                  <th>Applicants</th>
                  <th>Posted On</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(@mysqli_num_rows($r)!=0) {
                    while($row=@mysqli_fetch_assoc($r)) {
                      $user=$row['user_id'];
                      $t_id=$row['id'];

                      $q2="SELECT name,email FROM users WHERE id='$user' LIMIT 1";
                      $r2=@mysqli_query($dbc,$q2);
                      if(@mysqli_num_rows($r2)==0) continue;
                      $row2=@mysqli_fetch_assoc($r2);

                      $q3="SELECT id FROM applicants WHERE job_id='$t_id'";
                      $r3=@mysqli_query($dbc,$q3);
                   ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['title']; ?></td>
                  <td><?php echo $row['description']; ?></td>
                  <td><?php echo $row2['name'].'<br> ('.$row2['email'].')'; ?></td>
                    <td><b><?php echo @mysqli_num_rows($r3); ?></b> &nbsp;&nbsp;<a href="../applicants/?id=<?php echo $row['id']; ?>" target="_blank"><i class="fa fa-external-link"></i></a></td>
                  <td><?php echo $row['posted_on']; ?></td>
                  <td>
                    <form action="" method="post">
                    <input type="hidden" name="team_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this team?');">Delete</button>
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

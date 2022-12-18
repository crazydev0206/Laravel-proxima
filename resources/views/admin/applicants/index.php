<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');

if(!isset($_GET['id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else $id=test_input($_GET['id']);

if($_SERVER['REQUEST_METHOD']=='POST') {
  if(isset($_POST['m_id'])) {
    $m_id=test_input($_POST['m_id']);

    $q="DELETE FROM applicants WHERE id='$m_id'";
    $r=@mysqli_query($dbc,$q);
  }
}

$q="SELECT * FROM applicants WHERE job_id='$id'";
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
        #<?php echo $id;  ?> Job Applicants
        <small><?php echo @mysqli_num_rows($r); ?> total applicants</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../applicants/?id=<?php echo $id; ?>">#<?php echo $id;  ?> Applicants</a></li>
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
                  <th>Applicant Details</th>
                  <th>Phone</th>
                  <th>Resume</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(@mysqli_num_rows($r)!=0) {
                    while($row=@mysqli_fetch_assoc($r)) {
                      $app=$row['user_id'];

                      $q2="SELECT name,email FROM users WHERE id='$app' LIMIT 1";
                      $r2=@mysqli_query($dbc,$q2);
                      if(@mysqli_num_rows($r2)==0) continue;
                      $rows=@mysqli_fetch_assoc($r2);
                   ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $rows['name'].'<br> ('.$rows['email'].')'; ?></td>
                  <td><?php echo $row['phone']; ?></td>
                  <td><a href="../../resumes/<?php echo $row['resume']; ?>"><?php echo $row['resume']; ?></a></td>
                  <td>
                    <form action="" method="post">
                    <input type="hidden" name="m_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this applicant?');">Delete</button>
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

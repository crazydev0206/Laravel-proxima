<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
  if(isset($_POST['rew_id'])) {
  $id=test_input($_POST['rew_id']);

  $q="DELETE FROM media WHERE id='$id'";
  $r=@mysqli_query($dbc,$q);
  }

  }

$q="SELECT * FROM media ORDER BY id DESC";
$r=@mysqli_query($dbc,$q);

    $med='active';
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
        All Messages
        <small><?php echo @mysqli_num_rows($r); ?> total messages</small>
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../media/">All medeia</a></li>
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Posted By</th>
                  <th>Title</th>
                  <th>Image</th>
                  <th>Tags</th>
                  <th>Posted On</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(@mysqli_num_rows($r)!=0) {
                    while($row=@mysqli_fetch_assoc($r)) {
                        $user=$row['user_id'];
                        
                        $qp="SELECT username,email FROM users WHERE id='$user' LIMIT 1";
                        $rp=@mysqli_query($dbc,$qp);
                        $rowp=@mysqli_fetch_assoc($rp);
                   ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $rowp['username'].'<br>('.$rowp['email'].')'; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><img src="../../media_images/<?php echo $row['image']; ?>" style="max-width:200px; max-height:200px;"></td>
                    <td><?php echo $row['tags']; ?></td>
                    <td><?php echo $row['posted_on']; ?></td>
                  <td>
                    <form action="" method="post">
                    <input type="hidden" name="rew_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this post?');"><i class="fa fa-trash"></i></button>
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

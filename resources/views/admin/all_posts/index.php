<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include(APPPATH.'views/admin/common/connect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
  if(isset($_POST['rew_id'])) {
  $id=test_input($_POST['rew_id']);

  $q="DELETE FROM posts WHERE id='$id'";
  $r=@mysqli_query($dbc,$q);
  }

  }

$q="SELECT * FROM posts ORDER BY id DESC";
$r=@mysqli_query($dbc,$q);

    $posts='active';
include(APPPATH.'views/admin/common/header.php'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <?php include(APPPATH.'views/admin/common/left_menu.php'); ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All Posts
        <small><?php echo @mysqli_num_rows($r); ?> total posts</small>
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../all_posts/">All Posts</a></li>
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
                  <th>Post</th>
                  <th>Comments</th>
                  <th>Posted By</th>
                  <th>Posted On</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(@mysqli_num_rows($r)!=0) {
                    while($row=@mysqli_fetch_assoc($r)) {
                        $user=$row['user_id'];
                        $p_id=$row['id'];
                        
                        $qp="SELECT name,email FROM users WHERE id='$user' LIMIT 1";
                        $rp=@mysqli_query($dbc,$qp);
                        $rowp=@mysqli_fetch_assoc($rp);
                        
                        $qp="SELECT id FROM comments WHERE p_id='$p_id' AND type='1' LIMIT 1";
                        $rp=@mysqli_query($dbc,$qp);
                   ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['post']; ?></td>
                    <td><?php echo @mysqli_num_rows($rp); ?></td>
                  <td><?php echo $rowp['name'].'<br>('.$rowp['email'].')'; ?></td>
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
<?php include(APPPATH.'views/admin/common/footer.php'); }
?>

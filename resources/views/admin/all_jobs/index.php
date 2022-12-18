<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
    
  if(isset($_POST['p_id'])) {
  $id=test_input($_POST['p_id']);
      
  $q="DELETE FROM jobs WHERE id='$id'";
  $r=@mysqli_query($dbc,$q);
  }
    
    if(isset($_POST['f_id'])) {
  $id=test_input($_POST['f_id']);
        
        $q="SELECT feature FROM jobs WHERE id='$id' LIMIT 1";
        $r=@mysqli_query($dbc,$q);
        $row=@mysqli_fetch_assoc($r);
        $feature=$row['feature'];
        if($feature=='0') $feature='1';
        else $feature='0';
      
  $q="UPDATE jobs SET feature='$feature' WHERE id='$id'";
  $r=@mysqli_query($dbc,$q);
  }
    
  }

$q="SELECT * FROM jobs ORDER BY id DESC";
$r=@mysqli_query($dbc,$q);

    $job='active';
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
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../all_jobs/">All Jobs</a></li>
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
                  <th>Title</th>
                  <th>Description</th>
                  <th>Category</th>
                  <th>Posted By</th>
                  <th>Posted On</th>
                  <th>Views</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(@mysqli_num_rows($r)!=0) {
                    while($row=@mysqli_fetch_assoc($r)) {
                        $p_id=$row['id'];
                        $user=$row['user_id'];
                        
                        $q2="SELECT name, email FROM users WHERE id='$user' LIMIT 1";
                        $r2=@mysqli_query($dbc,$q2);
                        $row2=@mysqli_fetch_assoc($r2);
                   ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['title']; ?></td>
                  <td><?php echo substr($row['description'],0,100).'...'; ?></td>
                  <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row2['name'].' <br>('.$row2['email'].')'; ?></td>
                  <td><?php echo $row['on_date'] ?></td>
                    <td><?php echo $row['views'] ?></td>
                  <td>
                      <a href="../edit_job/?id=<?php echo $row['id']; ?>"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a>
                    <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="f_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn <?php if($row['feature']=='0') echo 'btn-danger'; else echo 'btn-success'; ?>"><i class="fa fa-star"></i></button>
                  </form>  
                    <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="p_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this job?');"><i class="fa fa-trash"></i></button>
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

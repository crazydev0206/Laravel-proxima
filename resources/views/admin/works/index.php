<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');

    
    if($_SERVER['REQUEST_METHOD']=='POST') {
  if(isset($_POST['w_id'])) {
  $id=test_input($_POST['w_id']);

  $q="DELETE FROM works WHERE id='$id'";
  $r=@mysqli_query($dbc,$q);
  }
    if(isset($_POST['img_id'])) {
  $id=test_input($_POST['img_id']);

  $q="DELETE FROM work_images WHERE id='$id'";
  $r=@mysqli_query($dbc,$q);
  }

  }

$q="SELECT * FROM works ORDER BY id DESC";
$r=@mysqli_query($dbc,$q);

    $work='active';
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
        All Works
        <small><?php echo @mysqli_num_rows($r); ?> total works</small>
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../works/">All Works</a></li>
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
                  <th>Images</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(@mysqli_num_rows($r)!=0) {
                    while($row=@mysqli_fetch_assoc($r)) {
                        $w_id=$row['id'];
                   ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo substr($row['description'],0,100).'...'; ?></td>
                  <td>
                      <?php 
    $qi="SELECT name,id FROM work_images WHERE w_id='$w_id'";
    $ri=@mysqli_query($dbc,$qi);
    if(@mysqli_num_rows($ri)!=0) {
        while($rowi=@mysqli_fetch_assoc($ri)) {
            $p_img='../../work_images/'.$rowi['name'];
    ?>
                        <a href="<?php echo $p_img; ?>" target="_blank"><?php echo $rowi['name']; ?></a>
                        
                      <form action="" method="post" style="display:inline;">
                          <input type="hidden" name="img_id" value="<?php echo $rowi['id']; ?>">
                        &nbsp;<button class="btn btn-danger" style="padding:0px; background-color:transparent; border:0px;" onclick="return confirm('Do you really want to delete this image?');"><i class="fa fa-trash" style="color:red;"></i></button>
                          </form><br>
                      <?php } } else echo 'No image uploaded.'; ?>
                  </td>
                  <td>
                      <a href="../testimonials/?id=<?php echo $row['id']; ?>"><button class="btn btn-success">Testimonials</button></a>
                      
                      <br><br>
                      <a href="../edit_work/?id=<?php echo $row['id']; ?>"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a>
                    <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="p_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this work?');"><i class="fa fa-trash"></i></button>
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

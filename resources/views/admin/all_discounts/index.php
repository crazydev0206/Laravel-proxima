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
      
  $q="DELETE FROM discounts WHERE id='$id'";
  $r=@mysqli_query($dbc,$q);
  }
    
  }

$q="SELECT * FROM discounts ORDER BY id DESC";
$r=@mysqli_query($dbc,$q);

    $disc='active';
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
        All Discounts
        <small><?php echo @mysqli_num_rows($r); ?> total discounts</small>
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../add_discount/">Add New</a></li>
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
                  <th>Logo</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Category</th>
                  <th>Link</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(@mysqli_num_rows($r)!=0) {
                    while($row=@mysqli_fetch_assoc($r)) {
                        $p_id=$row['id'];
                   ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                    <td><img src="../../discount_logos/<?php echo $row['logo']; ?>" width="60"></td>
                  <td><?php echo $row['title']; ?></td>
                  <td><?php echo substr($row['description'],0,100).'...'; ?></td>
                  <td><?php echo $row['category']; ?></td>
                  <td><?php echo $row['link'] ?></td>
                  <td>
                    <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="p_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this discount?');"><i class="fa fa-trash"></i></button>
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

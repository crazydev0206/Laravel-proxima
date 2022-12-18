<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
    if(isset($_POST['img_id'])) {
  $id=test_input($_POST['img_id']);

  $q="DELETE FROM images WHERE id='$id'";
  $r=@mysqli_query($dbc,$q);
  }
    
  if(isset($_POST['p_id'])) {
  $id=test_input($_POST['p_id']);
      
  $q="DELETE FROM reviews WHERE p_id='$id'";
  $r=@mysqli_query($dbc,$q);

  $q="DELETE FROM products WHERE id='$id'";
  $r=@mysqli_query($dbc,$q);
  }
  }

$q="SELECT * FROM products ORDER BY id DESC";
$r=@mysqli_query($dbc,$q);

    $pro='active';
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
        All Products
        <small><?php echo @mysqli_num_rows($r); ?> total products</small>
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../products/">All products</a></li>
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
                  <th>Product Name</th>
                  <th>Description</th>
                  <th>Category</th>
                  <th>Thumbnail</th>
                  <th>Order</th>
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
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo substr($row['description'],0,100).'...'; ?></td>
                  <td><?php echo $row['category']; ?></td>
                  <td>
                        <a href="../../thumbnails/<?php echo $row['thumbnail']; ?>" target="_blank"><img src="../../thumbnails/<?php echo $row['thumbnail']; ?>" width="200"></a>
                  </td>
                    <td><center><?php echo $row['ordering']; ?></center></td>
                  <td>
                      <a href="../edit/?id=<?php echo $row['id']; ?>"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a>
                    <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="p_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this product?');"><i class="fa fa-trash"></i></button>
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

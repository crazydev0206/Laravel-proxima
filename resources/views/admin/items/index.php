<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');
    $item='active';

if($_SERVER['REQUEST_METHOD']=='POST') {
  if(isset($_POST['email_id'])) {
  $email_id=test_input($_POST['email_id']);

  //$q="DELETE FROM emails WHERE id='$email_id'";
  //$r=@mysqli_query($dbc,$q);
  }

  if(isset($_POST['raw_material_name'])) {
    $raw_material_name=test_input($_POST['raw_material_name']);

    if(!empty($raw_material_name)) {
      $q="INSERT INTO raw_materials (name,created_on) VALUES ('$raw_material_name',NOW())";
      $r=@mysqli_query($dbc,$q);

      if($r) {
          $error='<font style="color:green;">Added successfully</font>';
      }
    }
  }
}

$q="SELECT * FROM items ORDER BY id DESC";
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
        All Items
        <small><?php echo @mysqli_num_rows($r); ?> total items</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../items">All Items</a></li>
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
                  <th>Item Name</th>
                    <th>Type</th>
                    <th>Price (INR/KG)</th>
                  <th>For Raw Material</th>
                  <th>Added On</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(@mysqli_num_rows($r)!=0) { $i=1;
                    while($row=@mysqli_fetch_assoc($r)) {
                        $r_id=$row['raw_material_id'];
                        $q2="SELECT name FROM raw_materials WHERE id='$r_id'";
                        $r2=@mysqli_query($dbc,$q2);
                        $row2=@mysqli_fetch_assoc($r2);
                   ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['type']; ?></td>
                    <td>Rs. <?php echo $row['price']; ?></td>
                  <td><?php echo $row2['name']; ?></td>
                  <td><?php echo $row['added_on'] ?></td>
                  <td>
                      <a href="../add_items/?id=<?php echo $row['raw_material_id']; ?>"><button class="btn btn-success">View All</button></a>
                    <form action="" method="post">
                    <input type="hidden" name="email_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item ? ?');">Delete</button>
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

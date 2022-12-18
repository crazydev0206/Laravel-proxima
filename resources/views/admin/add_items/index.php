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
    <script> window.location="../raw_materials"; </script>
    <?php
    }
    
    else $id=test_input($_GET['id']);

if($_SERVER['REQUEST_METHOD']=='POST') {
  if(isset($_POST['email_id'])) {
  $email_id=test_input($_POST['email_id']);

  //$q="DELETE FROM emails WHERE id='$email_id'";
  //$r=@mysqli_query($dbc,$q);
  }

  if(isset($_POST['item_name'])) {
    $item_name=test_input($_POST['item_name']);
    $type=test_input($_POST['type']);
    $price=test_input($_POST['price']);

    if(!empty($item_name)) {
      $q="INSERT INTO items (name,type,price,added_on,raw_material_id) VALUES ('$item_name','$type','$price',NOW(),'$id')";
      $r=@mysqli_query($dbc,$q);

      if($r) {
          $error='<font style="color:green;">Added successfully</font>';
      }
    }
  }
}

$q="SELECT * FROM items WHERE raw_material_id='$id' ORDER BY id DESC";
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
        "<?php $q2="SELECT name FROM raw_materials WHERE id='$id' LIMIT 1";
          $r2=@mysqli_query($dbc,$q2);
          $row2=@mysqli_fetch_array($r2);
          echo $row2[0]; ?>" Items
        <small><?php echo @mysqli_num_rows($r); ?> total items</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../add_items/?id=<?php echo $id; ?>">Add Items</a></li>
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

          <form role="form" action="" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Item Name<font style="color:red;">*</font></label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" required name="item_name">
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Type<font style="color:red;">*</font></label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" required name="type">
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Price<font style="color:red;">*</font></label>
                  <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter name" required name="price">
                </div>

                <!--<div class="form-group">
                  <label>Message</label>
                  <textarea class="form-control" rows="5" placeholder="Enter Message..." name="message" required></textarea>
                </div>-->
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add</button>
              </div>
          </form><hr>

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Item Name</th>
                  <th>Type</th>
                    <th>Price</th>
                  <th>Added On</th>
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
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['type']; ?></td>
                    <td>Rs. <?php echo $row['price']; ?></td>
                  <td><?php echo $row['added_on'] ?></td>
                  <td>
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

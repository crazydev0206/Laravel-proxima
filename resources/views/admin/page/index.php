<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');
    $pages='active';

if($_SERVER['REQUEST_METHOD']=='POST') {
  if(isset($_POST['delete_cat_id'])) {
  $cat_id=test_input($_POST['delete_cat_id']);

  $q="DELETE FROM raw_materials WHERE category_id='$cat_id'";
  $r=@mysqli_query($dbc,$q);
      
  $q="DELETE FROM categories WHERE id='$cat_id'";
  $r=@mysqli_query($dbc,$q);
  }

  if(isset($_POST['name'])) {
    $name=test_input($_POST['name']);
    $alias=test_input($_POST['alias']);
      $unit=test_input($_POST['unit']);

    if(!empty($name)) {
      $q="INSERT INTO categories (name,alias,unit) VALUES ('$name','$alias','$unit')";
      $r=@mysqli_query($dbc,$q);

      if($r) {
          $error='<font style="color:green;">Added successfully</font>';
      }
    }
  }
}

$q="SELECT * FROM categories ORDER BY id DESC";
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
        Pages
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../page/">Pages</a></li>
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
              
              <!--<button class="btn btn-success" style="float:right;" onclick="add_new()">+ Add New</button>-->

          <form role="form" action="" method="post" style="margin-top:5px; display:none;" id="add_new">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Title<font style="color:red;">*</font></label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" required name="name">
                </div>

                  <div class="form-group">
                  <label>Content</label>
                  <textarea class="form-control" rows="5" name="message" required></textarea>
                </div>
                  
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add</button>
              </div>
              <hr>
          </form>
              <script>
                  function add_new(){
                      $("#add_new").slideToggle();
                  }
              </script>

            <div class="box-body" style="margin-top:30px;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Page</th>
                    <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(@mysqli_num_rows($r)!=0) { $i=1;
                    while($row=@mysqli_fetch_assoc($r)) {
                        $r_id=$row['id'];
                   ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['alias']; ?></td>
                  <td><?php echo $row['unit'] ?></td>
                  <td>
                      <a href="../edit_cat/?id=<?php echo $row['id']; ?>" target="_blank"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                    <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="delete_cat_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Deleting this category will also delete all items in it. Proceed ?');"><i class="fa fa-trash"></i></button>
                  </form>
                  </td>
                </tr>
                <?php } } ?>
                    
                    <tr>
                  <td>1</td>
                  <td>About Us</td>
                        <td>Enable</td>
                  <td>
                      <a href="../edit_page/" target="_blank"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                  </td>
                </tr>
                    
                    <tr>
                  <td>2</td>
                  <td>Contact Us</td>
                        <td>Enable</td>
                  <td>
                      <a href="../edit_page/" target="_blank"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                  </td>
                </tr>
                    
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

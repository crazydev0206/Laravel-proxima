<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
    
    
    if(isset($_POST['name'])) {
        $name=test_input($_POST['name']);
        $tagline='';
        
        $q="SELECT id FROM categories WHERE name='$name' LIMIT 1";
        $r=@mysqli_query($dbc,$q);
    
    if(@mysqli_num_rows($r)=='1') {
        $error2='<font style="color:red; font-weight:bold;">"'.$name.'" category already exists.</font>';
    }
    else {
    $q="INSERT INTO categories (name, tagline) VALUES ('$name', '$tagline')";
    $r=@mysqli_query($dbc,$q) or die(mysqli_error($dbc));
        if($r) $error2='<font style="color:green; font-weight:bold;">Added successfully.</font>';
    }
    }

  }
    
$q="SELECT * FROM categories";
$r=@mysqli_query($dbc,$q);

    $add_cat='active';
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
        Add New Category
        <small><?php echo @mysqli_num_rows($r); ?> total categories</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../categories/">All Categories</a></li>
      </ol>
        <?php if(isset($error2)) echo $error2; ?>
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

          <form role="form" action="" method="post" enctype="multipart/form-data" style="margin-top:5px; " id="add_new">
              <div class="box-body">
                  
                  <div class="form-group">
                  <label>Category Name</label>
                      <input type="text" class="form-control" name="name" required>
                </div>
                  
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add</button>
              </div>
              <hr>
          </form>
              
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

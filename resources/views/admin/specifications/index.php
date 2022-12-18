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
<script> window.location="../products/"; </script>
<?php
}
    else $id=test_input($_GET['id']);

if($_SERVER['REQUEST_METHOD']=='POST') {
  if(isset($_POST['item_id'])) {
  $v_id=test_input($_POST['item_id']);

  $q="DELETE FROM specifications WHERE id='$v_id'";
  $r=@mysqli_query($dbc,$q);
  }
    
    if(isset($_POST['name'])) {
      $title=test_input($_POST['name']);
      $value=test_input($_POST['value']);
      
      $q="INSERT INTO specifications (title,value,p_id) VALUES ('$title','$value', '$id')";
      $r=@mysqli_query($dbc,$q) or die();
    }

  if(isset($_POST['title'])) {
      
                          //**********PROFILE PICTURE UPLOAD CODE***********
  if(!empty($_FILES["thumbnail"]["name"])) { //echo $_FILES["profile"]["name"];
  $target_dir = "../../pdfs/";
  $target_file = $target_dir . basename($_FILES["thumbnail"]["name"]);
  $name_image=basename($_FILES["thumbnail"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["thumbnail"]["tmp_name"]);
  if($check !== false) {
  echo "File is an image - " . $check["mime"] . ".";
  $uploadOk = 1;
  } else {
  $error2= "File is not an image.";
  $uploadOk = 0;
  }
  }

  // Check file size
  if ($_FILES["thumbnail"]["size"] > 100000000) {
  $error2= '<font style="color:red; font-weight:bold;">Sorry, your file is too large.</font>';
  $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "pdf" && $imageFileType != "PDF") { 
  $error2= '<font style="color:red; font-weight:bold;">Sorry, only PDF files are allowed.</font>';
  $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
  //$error2= '<font style="color:red; font-weight:bold;">Sorry, your file was not uploaded.</font>';
  // if everything is ok, try to upload file
  } else {
  if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file)) {

  } else {
  $error2= '<font style="color:red; font-weight:bold;">Sorry, there was an error uploading your file.</font>';
  }
  }
//echo $error2;
  if(empty($error2)) { //echo 'in';
      
      $name_image=test_input($name_image);
      
      
}
  }
  //**********PROFILE PICTURE UPLOAD CODE END***********

  }
  }

$q="SELECT * FROM specifications WHERE p_id='$id'";
$r=@mysqli_query($dbc,$q);
    
    $q2="SELECT * FROM products WHERE id='$id' LIMIT 1";
$r2=@mysqli_query($dbc,$q2);
        if(@mysqli_num_rows($r2)==0) {
?>
<script> window.location="../products/"; </script>
<?php
}
    $row2=@mysqli_fetch_assoc($r2);

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
        Specifications for "<?php echo $row2['name']; ?>"
        <small><?php echo @mysqli_num_rows($r); ?> total items</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../products/">All Products</a></li>
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
              
              <button class="btn btn-success" style="float:right;" onclick="add_new()">+ Add New</button>

          <form role="form" action="" method="post" enctype="multipart/form-data" style="margin-top:5px; display:none;" id="add_new">
              <div class="box-body">
                  
                  <div class="form-group">
                  <label>Title</label>
                      <input type="text" class="form-control" name="name" required>
                </div>
                  
                  <div class="form-group">
                  <label>Property</label>
                      <input type="text" class="form-control" name="value" required>
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
                  <th>Title</th>
                  <th>Property</th>
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
                  <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['value']; ?></td>
                  <td>
                    <form action="" method="post">
                    <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this specification?');">Delete</button>
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

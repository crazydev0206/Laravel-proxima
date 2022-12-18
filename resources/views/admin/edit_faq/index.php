<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include(APPPATH.'views/admin/common/connect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
  if(isset($_POST['delete_cat_id'])) {
  $cat_id=test_input($_POST['delete_cat_id']);
  $q="DELETE FROM faq WHERE id='$cat_id'";
  $r=@mysqli_query($dbc,$q);
  }
    
    if(isset($_POST['name'])) {
    $name=test_input($_POST['name']);
      
      $q="INSERT INTO faq (name) VALUES ('$name')";
      $r=@mysqli_query($dbc,$q) or die(mysqli_error($dbc));
      if($r) {
          $p_id=mysqli_insert_id($dbc);
          $error2= '<font style="color:green; font-weight:bold;">Topic added successfully.</font>';
      }
    }
    
                //**********PROFILE PICTURE UPLOAD CODE***********
if(!empty($_FILES["profile"]["name"])) {
$target_dir = "../../art_categories/";
$target_file = $target_dir . basename($_FILES["profile"]["name"]);
$name_image=basename($_FILES["profile"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
$check = getimagesize($_FILES["profile"]["tmp_name"]);
if($check !== false) {
echo "File is an image - " . $check["mime"] . ".";
$uploadOk = 1;
} else {
$error2= "File is not an image.";
$uploadOk = 0;
}
}

// Check file size
if ($_FILES["profile"]["size"] > 90000000) {
$error2= '<font style="color:red; font-weight:bold;">Sorry, your file is too large.</font>';
$uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
  && $imageFileType != "GIF") {
$error2= '<font style="color:red; font-weight:bold;">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</font>';
$uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
//$error2= '<font style="color:red; font-weight:bold;">Sorry, your file was not uploaded.</font>';
// if everything is ok, try to upload file
} else {
if (move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)) {

} else {
$error2= '<font style="color:red; font-weight:bold;">Sorry, there was an error uploading your file.</font>';
}
}

if(empty($error2)) {
    
    
      $name=test_input($_POST['name']);
      $description=test_input($_POST['description']);
      
      $q="INSERT INTO art_categories (name, description, image) VALUES ('$name', '$description', '$name_image')";
      $r=@mysqli_query($dbc,$q) or die(mysqli_error($dbc));
      if($r) {
          $p_id=mysqli_insert_id($dbc);
          $error2= '<font style="color:green; font-weight:bold;">Category added successfully.</font>';
      }

if($r) {
}

else
$error2='There is an error. Try Later.<br>';
}
}
    // END
    
}

$q="SELECT * FROM faq ORDER BY id ASC";
$r=@mysqli_query($dbc,$q);

$faq='active';
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
        Edit FAQ
        <small><?php echo @mysqli_num_rows($r); ?> total topics</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../edit_faq/">Edit FAQ</a></li>
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
              
              <button class="btn btn-success" style="float:right;" onclick="add_new()">+ New Topic</button>

          <form role="form" action="" method="post" enctype="multipart/form-data" style="margin-top:5px; display:none;" id="add_new">
              <div class="box-body">
                  
                  <div class="form-group">
                  <label>Topic Name <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="name" required>
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

            <div class="box-body">
                <?php if(isset($error)) echo $error.'<br><br>'; ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Topic</th>
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
                  <td>
                      <a href="<?php echo base_url(); ?>admin/faq/?id=<?php echo $row['id']; ?>"><button class="btn btn-success">Manage Questions</button></a>
                      
                    <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="delete_cat_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this topic?');"><i class="fa fa-trash"></i></button>
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

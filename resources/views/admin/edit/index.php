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
  if(isset($_POST['resto_id'])) {
  $id=test_input($_POST['resto_id']);

  $q="DELETE FROM products WHERE id='$id'";
  $r=@mysqli_query($dbc,$q);
  }

  if(isset($_POST['name'])) {
      
      $name=test_input($_POST['name']);
      $order=test_input($_POST['order']);
      $description=test_input2($_POST['description']);
      $condition=test_input2($_POST['condition']);
      $category=test_input($_POST['category']);
      $price=test_input($_POST['price']);
      $sku_number=test_input($_POST['sku_number']);
      
      $q="UPDATE products SET name='$name', description='$description', category='$category', price='$price', conditions='$condition', sku_number='$sku_number', ordering='$order' WHERE id='$id'";
      $r=@mysqli_query($dbc,$q) or die(mysqli_error($dbc));
      if($r) $error2= '<font style="color:green; font-weight:bold;">Product details updated successfully.</font>';
    
          if(!empty($_FILES["profile"]["name"])) { $error2="";
$target_dir = "../../thumbnails/";
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
      
      $q="UPDATE products SET thumbnail='$name_image' WHERE id='$id'";
      $r=@mysqli_query($dbc,$q) or die(mysqli_error($dbc));
      if($r) { 
          $p_id=mysqli_insert_id($dbc);
          $error2= '<font style="color:green; font-weight:bold;">Product details and image updated successfully.</font>';
      }

if($r) {
}

else
$error2='There is an error. Try Later.<br>';
}
}
         
}

  }
    
    $q="SELECT * FROM products WHERE id='$id' LIMIT 1";
    $r=@mysqli_query($dbc,$q);
        if(@mysqli_num_rows($r)==0) {
?>
<script> window.location="../products/"; </script>
<?php
}
    
    else $row=@mysqli_fetch_assoc($r);

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
        Edit Product
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

          <form role="form" action="" method="post" enctype="multipart/form-data" style="margin-top:5px;" id="add_new">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Select Category <font style="color:red;">*</font></label>
                  <select name="category" class="form-control" required>
                      <option value="">Please Select</option>
                    <?php 
    $qc="SELECT * FROM categories";
    $rc=@mysqli_query($dbc,$qc);
    if(@mysqli_num_rows($rc)!=0) {
        while($rowc=@mysqli_fetch_assoc($rc)) {
                      ?>
                      <option value="<?php echo $rowc['name']; ?>" <?php if($rowc['name']==$row['category']) echo 'selected'; ?> ><?php echo $rowc['name']; ?></option>
                      <?php 
            
        }
    }
                      ?>
                  </select>
                </div>
                  
                  <div class="form-group">
                  <label>Product Name <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="name" required value="<?php echo $row['name']; ?>">
                </div>
                  
                  <div class="form-group">
                  <label>SKU Number <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="sku_number" required value="<?php echo $row['sku_number']; ?>">
                </div>
                  
                  <div class="form-group">
                  <label>Price <font style="color:red;">*</font></label>
                      <input type="number" class="form-control" name="price" required value="<?php echo $row['price']; ?>" min="1" step="any">
                </div>
                  
                  <div class="form-group">
                  <label>Description <font style="color:red;">*</font></label>
                      <textarea class="form-control" rows="6" name="description" required><?php echo $row['description']; ?></textarea>
                </div>
                  
                  <div class="form-group">
                  <label>Condition <font style="color:red;">*</font></label>
                      <textarea class="form-control" rows="6" name="condition" required><?php echo $row['conditions']; ?></textarea>
                </div>
                  
                  <div class="form-group">
                  <label>Update Thumbnail </label>
                      <input type="file" class="form-control" name="profile">
                </div>
                  
                  <div class="form-group">
                  <label>Order <font style="color:red;">*</font></label>
                      <input type="number" class="form-control" name="order" required min="0" value="<?php echo $row['ordering']; ?>">
                </div>
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
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

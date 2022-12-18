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
<script> window.location="../all_offers/"; </script>
<?php
}
    else $id=test_input($_GET['id']);
    
 

if($_SERVER['REQUEST_METHOD']=='POST') {
                      //**********PROFILE PICTURE UPLOAD CODE***********
if(!empty($_FILES["profile"]["name"])) {
$target_dir = "../../offer_images/";
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
      
      $q="UPDATE offers SET image='$name_image' WHERE id='$id'";
      $r=@mysqli_query($dbc,$q) or die(mysqli_error($dbc));
      if($r) {
          $error2= '<font style="color:green; font-weight:bold;">Offer updated successfully.</font>';
      }

if($r) {
}

else
$error2='There is an error. Try Later.<br>';
}
}
    // END

        if(isset($_POST['name'])) {
      $category=test_input($_POST['category']);
      $title=test_input($_POST['name']);
      $description=test_input($_POST['description']);
      
      $q="UPDATE offers SET category='$category', title='$title', description='$description' WHERE id='$id'";
      $r=@mysqli_query($dbc,$q) or die(mysqli_error($dbc));
      if($r) {
          $error2= '<font style="color:green; font-weight:bold;">Offer updated successfully.</font>';
      } 
        }
  }
    
    $q="SELECT * FROM offers WHERE id='$id' LIMIT 1";
    $r=@mysqli_query($dbc,$q);
        if(@mysqli_num_rows($r)==0) {
?>
<script> window.location="../all_offers/"; </script>
<?php
}
    
    else $row=@mysqli_fetch_assoc($r);

    $off='active';
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
        Edit Offer
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../all_offers/">All Offers</a></li>
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
                            <label for="exampleSelect1">Select Category <font style="color:red;">*</font></label>
                            <select class="form-control" id="exampleSelect1" required name="category">
                                <option value=""></option>
                              <?php 
                                $q="SELECT name, id FROM offers_cat";
                                $r=@mysqli_query($dbc,$q);
                                if(@mysqli_num_rows($r)!=0) {
                                    while($row2=@mysqli_fetch_assoc($r)) {
                                ?>
                                <option value="<?php echo $row2['name']; ?>" <?php if($row['category']==$row2['name']) echo 'selected'; ?> ><?php echo $row2['name']; ?></option>
                                <?php } } ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Title <font style="color:red;">*</font></label>
                            <input class="form-control" aria-describedby="emailHelp" type="text" required name="name" value="<?php echo $row['title']; ?>">
                            <small class="form-text text-muted">Be specific with the title.</small>
                          </div>
                          <div class="form-group">
                            <label for="exampleTextarea">Description <font style="color:red;">*</font></label>
                            <textarea class="form-control" id="words_count" rows="5" required name="description"><?php echo $row['description']; ?></textarea>
                                <p style="color:red; display:none;" id="words_error">* Maximum 250 words are allowed.</p>
                          </div>
                            <div class="form-group">
                            <label for="exampleInputFile">Update Image </label>
                            <input class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" type="file" accept="image/*" name="profile">
                            <small class="form-text text-muted" id="fileHelp">Set a picture to your listing. Only images are allowed!</small>
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

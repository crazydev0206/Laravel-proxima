<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include(APPPATH.'views/admin/common/connect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
    if(isset($_POST['email_signup'])) {
        $text=test_input($_POST['email_signup']);
        
        $q="UPDATE emails SET email_request='$text' WHERE id='1'";
        $r=@mysqli_query($dbc,$q);
    }
    
            //**********PROFILE PICTURE UPLOAD CODE***********
if(!empty($_FILES["profile"]["name"])) {
$target_dir = base_url()."assets/article_images/";
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
    
    
      $title=test_input($_POST['title']);
      $article=test_input2($_POST['article']);
      $categories=test_input2($_POST['categories']);
      
      $q="INSERT INTO articles (title, description, image, posted_on, categories, user_id) VALUES ('$title','$article', '$name_image', NOW(), '$categories', '0')";
      $r=@mysqli_query($dbc,$q) or die(mysqli_error($dbc));
      if($r) {
          $p_id=mysqli_insert_id($dbc);
          $error2= '<font style="color:green; font-weight:bold;">Posted successfully.</font>';
      }

if($r) {
}

else
$error2='There is an error. Try Later.<br>';
}
}
    // END
    
          if(!empty($_FILES["image"]["name"][0])) { //echo 'gg';
        $size=count($_FILES['image']['name']);
        for($i=0;$i<$size;$i++) {
        $target_dir = "../../product_images/";
      $name_image=basename($_FILES["image"]["name"][$i]);
            $temp = explode(".", $_FILES["image"]["name"][$i]);
$last2=rand(pow(10, 4-1), pow(10, 4)-1);
                      $name_image = round(microtime(true)).$last2. '.' . end($temp); 
      $target_file = $target_dir . $name_image;
      $uploadOk = 1;
      $imageFileType = $_FILES["image"]["type"][$i];
      // Check if image file is a actual image or fake image
      if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["image"]["tmp_name"][$i]);
      if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
      } else {
      $error2= "File is not an image.";
      $uploadOk = 0;
      }
      }

      // Check file size
      if ($_FILES["image"]["size"][$i] > 180000000) {
      $error2= '<font style="color:red; font-weight:bold;">Sorry, your file is too large.</font>';
      $uploadOk = 0;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" && $imageFileType != "image/gif" && $imageFileType != "image/png" && $imageFileType != "image/PNG" && $imageFileType != "image/jpeg" && $imageFileType != "image/jpg" && $imageFileType != "image/JPG") {
      $error2= '<font style="color:red; font-weight:bold;">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</font>';
      $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
      //$error2= '<font style="color:red; font-weight:bold;">Sorry, your file was not uploaded.</font>';
      // if everything is ok, try to upload file
      } else {
      if (move_uploaded_file($_FILES["image"]["tmp_name"][$i], $target_file)) {

      } else {
      $error2= '<font style="color:red; font-weight:bold;">Sorry, there was an error uploading your file.</font>';
      }
      }

      if(empty($error2)) {
          
        $q="INSERT INTO images (name,p_id) VALUES ('$name_image','$p_id')";
        $r=@mysqli_query($dbc,$q) or die(mysqli_error($dbc));

        if($r) {
$flag=1;
      }

        else
        $error2='There is an error. Try Later.<br>';
      } else { 
    $flag=0; }
      }
    }

  }
    
    $q="SELECT * FROM emails WHERE id='1' LIMIT 1";
    $r=@mysqli_query($dbc,$q);
    $row=@mysqli_fetch_assoc($r);

    $email_request='active';
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
        Email Request
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../site_settings/">Site Settings</a></li>
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

          <form role="form" action="" method="post" enctype="multipart/form-data" style="margin-top:0px;" id="add_new">
              <div class="box-body">
                  
                  <div class="form-group">
                  <label>Email Text <font style="color:red;">*</font></label>
                      <textarea class="form-control" name="email_signup" required><?php echo $row['email_request']; ?></textarea>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/src/jquery.tokeninput.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/token-input.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/token-input-facebook.css" type="text/css" />
<?php include(APPPATH.'views/admin/common/footer.php'); }
?>

<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
  if(isset($_POST['video_id'])) {
  $id=test_input($_POST['video_id']);

  $q="DELETE FROM videos WHERE id='$id'";
  $r=@mysqli_query($dbc,$q);
  }

  if(isset($_POST['title'])) {
      
      //**********PROFILE PICTURE UPLOAD CODE***********
  if(!empty($_FILES["profile"]["name"])) { //echo $_FILES["profile"]["name"];
  $target_dir = "../../videos/";
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
  if ($_FILES["profile"]["size"] > 200000000) {
  $error2= '<font style="color:red; font-weight:bold;">Sorry, your file is too large.</font>';
  $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "mp4" && $imageFileType != "3gp" && $imageFileType != "flv"
  && $imageFileType != "avi" && $imageFileType != "3gpp" && $imageFileType != "webm" && $imageFileType != "ogv" ) { 
  $error2= '<font style="color:red; font-weight:bold;">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</font>';
  $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
  //$error2= '<font style="color:red; font-weight:bold;">Sorry, your file was not uploaded.</font>';
  // if everything is ok, try to upload file
  } else {
  if (move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)) {
       $nn=$_FILES["profile"]["name"];
      
      include_once('../getid3/getid3.php');
$getID3 = new getID3;
$file = $getID3->analyze($target_file);
      $duration=$file['playtime_string'];
      
  } else {
  $error2= '<font style="color:red; font-weight:bold;">Sorry, there was an error uploading your file.</font>';
  }
  }
//echo $error2;
  if(empty($error2)) { //echo 'in';
      
      $name_image2=$name_image;
      
                //**********PROFILE PICTURE UPLOAD CODE***********
  if(!empty($_FILES["thumbnail"]["name"])) { //echo $_FILES["profile"]["name"];
  $target_dir = "../../thumbnails/";
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
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
&& $imageFileType != "GIF") { 
  $error2= '<font style="color:red; font-weight:bold;">Sorry, only JPG, JPEG, PNG & GIF files are allowed for thumbnail.</font>';
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
      $name_image2=test_input($name_image2);
      
      $title=test_input($_POST['title']);
      $description=test_input($_POST['description']);
      $category=test_input($_POST['category']);
      
      $q="INSERT INTO videos (title,description,category,video,posted_on,thumbnail,duration) VALUES ('$title','$description','$category','$name_image2',NOW(),'$name_image','$duration')";
      $r=@mysqli_query($dbc,$q) or die();
}
  }
  //**********PROFILE PICTURE UPLOAD CODE END***********
      
}
  }
  //**********PROFILE PICTURE UPLOAD CODE END***********
      
      else if(isset($_POST['youtube'])){
                          //**********PROFILE PICTURE UPLOAD CODE***********
  if(!empty($_FILES["thumbnail"]["name"])) { //echo $_FILES["profile"]["name"];
  $target_dir = "../../thumbnails/";
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
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
&& $imageFileType != "GIF") { 
  $error2= '<font style="color:red; font-weight:bold;">Sorry, only JPG, JPEG, PNG & GIF files are allowed for thumbnail.</font>';
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
      
      $title=test_input($_POST['title']);
      $url=test_input($_POST['youtube']);
      
      $regex_pattern = "/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/";
$match;


if(preg_match($regex_pattern, $url, $match)){
    $youtube_id=$match[4];
$contents=$url;
}
      
      $description=test_input($_POST['description']);
      $category=test_input($_POST['category']);
      
      $q="INSERT INTO videos (title,description,category,posted_on,thumbnail,duration,youtube,youtube_id) VALUES ('$title','$description','$category',NOW(),'$name_image','N/A','$url','$youtube_id')";
      $r=@mysqli_query($dbc,$q) or die();
}
  }
  //**********PROFILE PICTURE UPLOAD CODE END***********
      }

  }
  }

$q="SELECT * FROM videos ORDER BY id DESC";
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
        All Videos
        <small><?php echo @mysqli_num_rows($r); ?> total videos</small>
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../videos">All Videos</a></li>
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
              
              <button class="btn btn-success" style="float:right;" onclick="add_new()">+ Add New</button>

          <form role="form" action="" method="post" enctype="multipart/form-data" style="margin-top:5px; display:none;" id="add_new">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Category</label>
                  <select name="category" class="form-control" required>
                      <option value="">Please Select</option>
                    <option value="SAMHÄLLSKUNSKAP">SAMHÄLLSKUNSKAP</option>
                    <option value="HISTORIA">HISTORIA</option>
                    <option value="RELIGION">RELIGION</option>
                    <option value="GEOGRAFI">GEOGRAFI</option>
                  </select>
                </div>
                  
                  <div class="form-group">
                  <label>Title</label>
                      <input type="text" class="form-control" name="title" required>
                </div>
                  
                  <div class="form-group">
                  <label>Description</label>
                      <textarea class="form-control" rows="6" name="description"></textarea>
                </div>
                  
                  <div class="form-group">
                  <label>Thumbnail</label>
                      <input type="file" class="form-control" name="thumbnail" required>
                </div>
                  
                  <div class="form-group">
                  <label>Video</label>
                      <!--<input type="file" class="form-control" name="profile" />-->
                      
                      <select name="video_name" required class="form-control" >
                          <option value="">Please Select</option>
                          <?php 
    $log_directory='../../videos';
    foreach(glob($log_directory.'/*.*') as $file) {
    $file=str_replace("../../videos/","",$file);
                          ?>
                          <option><?php echo $file; ?></option>
                          <?php } ?>
                      </select>
                  </div>
                  
              <div class="form-group">
                  <label>Youtube Link</label>
                      <input type="text" class="form-control" name="youtube">
                </div>
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Upload Video</button>
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
                  <th>Description</th>
                  <th>Video</th>
                  <th>Category</th>
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
                  <td><?php echo $row['description']; ?></td>
                    <td>
                        <?php if(!empty($row['video'])) { ?>
                        <a href="../../videos/<?php echo $row['video']; ?>" target="_blank"><?php echo $row['video']; ?></a>
                        <?php } else { ?>
                        <a href="<?php echo $row['youtube']; ?>" target="_blank"><?php echo $row['youtube']; ?></a>
                        <?php } ?>
                        <br><br>
                        Thumbnail: <a href="../../thumbnails/<?php echo $row['thumbnail']; ?>" target="_blank"><?php echo $row['thumbnail']; ?></a>
                    </td>
                    <td><?php echo $row['category']; ?></td>
                  <td>
                      <a href="../trailers/?id=<?php echo $row['id']; ?>" target="_blank"><button type="submit" class="btn btn-success" title="Trailers"><i class="fa fa-tv"></i></button></a>
                      <a href="../pdfs/?id=<?php echo $row['id']; ?>" target="_blank"><button type="submit" class="btn btn-success" title="PDFs"><i class="fa fa-file"></i></button></a>
                      <a href="../links/?id=<?php echo $row['id']; ?>" target="_blank"><button type="submit" class="btn btn-success" title="Links"><i class="fa fa-link"></i></button></a>
                      <br><br>
                      <a href="../subtitles/?id=<?php echo $row['id']; ?>" target="_blank"><button type="submit" class="btn btn-success" title="Links">Subtitles</button></a>
                    <form action="" method="post">
                    <input type="hidden" name="video_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this video?');">Delete</button>
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

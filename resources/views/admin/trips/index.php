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
  $v_id=test_input($_POST['video_id']);

  $q="DELETE FROM offers WHERE id='$v_id'";
  $r=@mysqli_query($dbc,$q);
  }

  if(isset($_POST['title'])) {
      
      //**********PROFILE PICTURE UPLOAD CODE***********
  if(!empty($_FILES["profile"]["name"])) { //echo $_FILES["profile"]["name"];
  $target_dir = "../../trailers/";
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

  } else {
  $error2= '<font style="color:red; font-weight:bold;">Sorry, there was an error uploading your file.</font>';
  }
  }
//echo $error2;
  if(empty($error2)) { //echo 'in';
      
      $title="";
      $description=test_input($_POST['description']);
      
      $q="INSERT INTO trailers (title,description,video,video_id) VALUES ('$title','$description','$name_image','$id')";
      $r=@mysqli_query($dbc,$q) or die();
      
}
  }
  //**********PROFILE PICTURE UPLOAD CODE END***********

  }
  }

$q="SELECT * FROM offers";
$r=@mysqli_query($dbc,$q);
    
//$q2="SELECT * FROM videos WHERE id='$id' LIMIT 1";
//$r2=@mysqli_query($dbc,$q2);
  //      if(@mysqli_num_rows($r2)==0) {
?>
<script> //window.location="../videos"; </script>
<?php
//}
    //$row2=@mysqli_fetch_assoc($r2);

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
        Trips
        <small><?php echo @mysqli_num_rows($r); ?> total trips</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../trips/">All Trips</a></li>
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
                  
                  <!--<div class="form-group">
                  <label>Title</label>
                      <input type="text" class="form-control" name="title" required>
                </div>-->
                  
                  <div class="form-group">
                  <label>Short Description</label>
                      <textarea class="form-control" rows="6" name="description"></textarea>
                </div>
                  
                  <div class="form-group">
                  <label>Video</label>
                      <input type="file" class="form-control" name="profile" required>
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
                  <th>By User</th>
                  <th>From - To</th>
                  <th>Checkin - Checkout</th>
                  <th>Persons</th>
                    <th>Accomodation</th>
                    <th>Services</th>
                    <th>Extra Info</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(@mysqli_num_rows($r)!=0) {
                    while($row=@mysqli_fetch_assoc($r)) {
                        $user=$row['user_id'];
                        $id=$row['id'];
                        
                        $q2="SELECT * FROM users WHERE id='$user' LIMIT 1";
                        $r2=@mysqli_query($dbc,$q2);
                        $row2=@mysqli_fetch_assoc($r2);
                   ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row2['first_name'].' '.$row2['last_name'].' ('.$row2['email'].')'; ?></td>
                  <td><?php echo $row['from_location'].' - '.$row['to_location']; ?></td>
                  <td><?php echo $row['checkin'].' - '.$row['checkout']; ?></td>  
                  <td><?php echo $row['adults']+$row['childrens']; ?></td>
                  <td><?php echo $row['accomodation']; ?></td>
                    <td><?php echo $row['service']; ?></td>
                    <td><?php echo $row['extra_information']; ?></td>
                  <td>
                      <a href="../offers/?id=<?php echo $id; ?>" target="_blank"><button class="btn btn-success">Offers</button></a>
                    <form action="" method="post">
                    <input type="hidden" name="video_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this trip?');">Delete</button>
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

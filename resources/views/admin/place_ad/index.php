<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');
    $ad='active';

if($_SERVER['REQUEST_METHOD']=='POST') {
  if(isset($_POST['delete_cat_id'])) {
  $cat_id=test_input($_POST['delete_cat_id']);
  $q="DELETE FROM ads WHERE id='$cat_id'";
  $r=@mysqli_query($dbc,$q);
  }

    if(isset($_POST['for'])) {
        $for=test_input($_POST['for']);
        $url=test_input($_POST['url']);
    
            //**********PROFILE PICTURE UPLOAD CODE***********
if(!empty($_FILES["image"]["name"])) {
$target_dir = "../ad_images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$name_image=basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
$check = getimagesize($_FILES["image"]["tmp_name"]);
if($check !== false) {
echo "File is an image - " . $check["mime"] . ".";
$uploadOk = 1;
} else {
$error2= "File is not an image.";
$uploadOk = 0;
}
}

// Check file size
if ($_FILES["image"]["size"] > 90000000) {
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
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

} else {
$error2= '<font style="color:red; font-weight:bold;">Sorry, there was an error uploading your file.</font>';
}
}

if(empty($error2)) {
    $q="SELECT id FROM ads WHERE forr='$for' LIMIT 1";
    $r=@mysqli_query($dbc,$q);
    
    if(@mysqli_num_rows($r)=='1') {
        $row=@mysqli_fetch_assoc($r);
        $id=$row['id'];
        
    $q="UPDATE ads SET image='$name_image', url='$url' WHERE id='$id'";
    $r=@mysqli_query($dbc,$q) or die(mysqli_error($dbc));
    }
    else {
    $q="INSERT INTO ads (image, url, forr) VALUES ('$name_image', '$url', '$for')";
    $r=@mysqli_query($dbc,$q) or die(mysqli_error($dbc));
    }

if($r) {
    
}

else
$error2='There is an error. Try Later.<br>';
} else echo $error2;
}
    }
    
}

$q="SELECT * FROM ads ORDER BY id DESC";
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
        All Ads
        <small><?php echo @mysqli_num_rows($r); ?> total ads</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../place_ad/">All Ads</a></li>
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

          <form role="form" action="" method="post" style="margin-top:5px; display:none;" id="add_new" enctype="multipart/form-data">
              <div class="box-body">
                  <div class="form-group">
                  <label for="exampleInputEmail1">Image<font style="color:red;">*</font></label>
                      
					<div id="img_preview"><img src="" id="current_img" style="max-width:100px;"></div>
					<input type="file" class="lg file" name="image" id="img" required> 
                      
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
                <script>

		  $(document).on('change', '.file', function(e){ 
                      var o=new FileReader;
                      o.readAsDataURL(e.target.files[0]),o.onloadend=function(o){
                          $("#current_img").attr("src",o.target.result); 
                      }
                    //$(this).prev().text($(this).val().replace(/C:\\fakepath\\/i, ''));
                      $("#img_preview").show();
                  });
</script>
                </div>
                  
                <div class="form-group">
                  <label for="exampleInputEmail1">URL<font style="color:red;">*</font></label>
                  <input type="url" class="form-control" id="exampleInputEmail1" placeholder="" required name="url">
                </div>

                  <div class="form-group">
                  <label>For</label>
                      <select name="for" class="form-control" required>
                          <option value="">Please select</option>
                          <option value="1">Shippers Dashboard</option>
                          <option value="0">Transporters Dashboard</option>
                      </select>
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
                  <th>Image</th>
                  <th>URL</th>
                  <th>For</th>
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
                  <td><img src="../ad_images/<?php echo $row['image']; ?>" style="max-width:100px; max-height:100px;"></td>
                  <td><a href="<?php echo $row['url']; ?>"><?php echo $row['url']; ?></a></td>
                  <td><?php if($row['forr']=='1') echo 'Shippers Dashboard'; else echo 'Transporters Dashboard'; ?></td>
                  <td>
                      <!--<a href="../edit_promotion/?id=<?php //echo $row['id']; ?>" target="_blank"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a>-->
                    <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="delete_cat_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this ad?');"><i class="fa fa-trash"></i></button>
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

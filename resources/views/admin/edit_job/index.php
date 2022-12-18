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
<script> window.location="../all_jobs/"; </script>
<?php
}
    else $id=test_input($_GET['id']);
    
 

if($_SERVER['REQUEST_METHOD']=='POST') {
    if(isset($_POST['title'])) {
    $type=test_input($_POST['type']);
    $title=test_input($_POST['title']);
    $description=test_input($_POST['description']);
    $category=test_input($_POST['category']);
    $sub_category=test_input($_POST['sub_category']);
    $institution=test_input($_POST['institution']);
    $employment=test_input($_POST['employment']);
    //$location=test_input($_POST['location']);
    //$country=test_input($_POST['country']);
    //$state=test_input($_POST['state']);
    //$locality=test_input($_POST['locality']);
    //$lat_lng=test_input($_POST['lat_lng']);
    $salary=test_input($_POST['salary']);
    $link=test_input($_POST['link']);
    
    $q="UPDATE jobs SET title='$title', description='$description', category='$category', sub_category='$sub_category', institution='$institution', employment='$employment', salary='$salary', link='$link', type='$type' WHERE id='$id'";
    $r=@mysqli_query($dbc,$q);
    if($r) {
        $error2= '<font style="color:green; font-weight:bold;">Updated successfully.</font>';
    }
    }
    
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
    
    $q="SELECT * FROM jobs WHERE id='$id' LIMIT 1";
    $r=@mysqli_query($dbc,$q);
        if(@mysqli_num_rows($r)==0) {
?>
<script> window.location="../all_jobs/"; </script>
<?php
}
    
    else $row=@mysqli_fetch_assoc($r);

    $job='active';
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
        Edit Job
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../all_jobs/">All Jobs</a></li>
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
                  <label for="exampleInputEmail1">Position Type <font style="color:red;">*</font></label>
                  <select name="type" class="form-control" required>
                      <option value=""></option>
                                <?php 
                                $q="SELECT name, id FROM position_type";
                                $r=@mysqli_query($dbc,$q);
                                if(@mysqli_num_rows($r)!=0) {
                                    while($row2=@mysqli_fetch_assoc($r)) {
                                ?>
                                <option value="<?php echo $row2['name']; ?>" <?php if($row['type']==$row2['name']) echo 'selected'; ?> ><?php echo $row2['name']; ?></option>
                                <?php } } ?>
                  </select>
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Select Position Category <font style="color:red;">*</font></label>
                  <select required name="category" onchange="this.options[this.selectedIndex].onclick()" class="form-control">
                      <option value=""></option>
                              <?php 
                                $q="SELECT name, id FROM position_categories";
                                $r=@mysqli_query($dbc,$q);
                                if(@mysqli_num_rows($r)!=0) {
                                    while($row2=@mysqli_fetch_assoc($r)) {
                                ?>
                                <option value="<?php echo $row2['name']; ?>" onclick="sub_category(<?php echo $row2['id']; ?>)" <?php if($row['category']==$row2['name']) { echo 'selected'; $cat=$row2['id']; } ?> ><?php echo $row2['name']; ?></option>
                                <?php } } ?>
                  </select>
                </div>
                  <script>
                                function sub_category(id) {
                                    var xhttp=new XMLHttpRequest();
                                    xhttp.onreadystatechange=function(){
                                if(xhttp.readyState==4 && xhttp.status == 200) { //alert(xhttp.responseText);
                
                                if(xhttp.responseText!=-1 & xhttp.responseText!='') {
                                    $("#sub_category").empty();
                                    $("#sub_category").html(xhttp.responseText);
                                }
                                    }


                                };  

                                    xhttp.open("POST","../../ajax/sub_category.php",true);
                                    xhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                                    xhttp.send("id="+id);
                                }
                            </script>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Select Sub-Category <font style="color:red;">*</font></label>
                  <select id="sub_category" required name="sub_category" class="form-control">
                      <?php 
                                $q="SELECT name, id FROM position_sub WHERE c_id='$cat'";
                                $r=@mysqli_query($dbc,$q);
                                if(@mysqli_num_rows($r)!=0) {
                                    while($row2=@mysqli_fetch_assoc($r)) {
                                ?>
                                <option value="<?php echo $row2['name']; ?>" <?php if($row['sub_category']==$row2['name']) echo 'selected'; ?> ><?php echo $row2['name']; ?></option>
                                <?php } } ?>
                  </select>
                </div>
                  
                  <div class="form-group">
                  <label>Title <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="title" required value="<?php echo $row['title']; ?>">
                </div>
                  
                  <div class="form-group">
                  <label>Description <font style="color:red;">*</font></label>
                      <textarea class="form-control" rows="6" name="description" required><?php echo $row['description']; ?></textarea>
                </div>
                  
                  <div class="form-group">
                            <label for="exampleInputEmail1">Apply Link <font style="color:red;">*</font></label>
                            <input class="form-control" aria-describedby="emailHelp" type="url" required name="link" value="<?php echo $row['link']; ?>">
                            <small class="form-text text-muted">Link for users to apply to the job.</small>
                          </div>
                  <div class="form-group">
                            <label for="exampleSelect1">Institution Type <font style="color:red;">*</font></label>
                            <select class="form-control" id="sub_category" required name="institution">
                                <option value=""></option>
                                <option value="Primary" <?php if($row['institution']=='Primary') echo 'selected'; ?> >Primary</option>
                                <option value="Secondary"<?php if($row['institution']=='Secondary') echo 'selected'; ?> >Secondary</option>
                                <option value="Technical" <?php if($row['institution']=='Technical') echo 'selected'; ?> >Technical</option>
                                <option value="Higher Ed." <?php if($row['institution']=='Higher Ed.') echo 'selected'; ?> >Higher Ed.</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="exampleSelect1">Employment Type <font style="color:red;">*</font></label>
                            <select class="form-control" id="sub_category" required name="employment">
                                <option value=""></option>
                                <option value="Full-Time" <?php if($row['employment']=='Full-Time') echo 'selected'; ?> >Full-Time</option>
                                <option value="Part-Time" <?php if($row['employment']=='Part-Time') echo 'selected'; ?> >Part-Time</option>
                            </select>
                          </div>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Expected Salary</label>
                            <input class="form-control" aria-describedby="emailHelp" type="text" name="salary" value="<?php echo $row['salary']; ?>">
                            <small class="form-text text-muted">Ex: $1500 - $2500</small>
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

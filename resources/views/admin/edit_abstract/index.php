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
<script> window.location="../all_journals/"; </script>
<?php
}
    else $id=test_input($_GET['id']);
    
 

if($_SERVER['REQUEST_METHOD']=='POST') {
  if(isset($_POST['resto_id'])) {
  $id=test_input($_POST['resto_id']);

  $q="DELETE FROM products WHERE id='$id'";
  $r=@mysqli_query($dbc,$q);
  }
    
    if(isset($_POST['abstract'])) {
        $abstract=test_input($_POST['abstract']);
        $authors=test_input($_POST['authors']);
        $title=test_input($_POST['title']);
        $volume=test_input($_POST['volume']);
        $issue=test_input($_POST['issue']);
        $year=test_input($_POST['year']);
        
        $q="UPDATE abstracts SET abstract='$abstract', authors='$authors', title='$title', volume='$volume', issue='$issue', year='$year' WHERE id='$id'";
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
         
}

  }
    
    $q="SELECT * FROM abstracts WHERE id='$id' LIMIT 1";
    $r=@mysqli_query($dbc,$q);
        if(@mysqli_num_rows($r)==0) {
?>
<script> window.location="../all_journals/"; </script>
<?php
}
    
    else $row=@mysqli_fetch_assoc($r);

    $jou='active';
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
        Edit Abstract
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../abstracts/?id=<?php echo $row['j_id']; ?>">All Abstracts</a></li>
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
                  <label>Authors <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="authors" required value="<?php echo $row['authors']; ?>">
                </div>
                  
                  <div class="form-group">
                  <label>Title <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="title" required value="<?php echo $row['title']; ?>">
                </div>
                  
                  <div class="form-group">
                  <label>Volume No. <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="volume" required value="<?php echo $row['volume']; ?>">
                </div>
                  
                  <div class="form-group">
                  <label>Issue No. <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="issue" required value="<?php echo $row['issue']; ?>">
                </div>
                  
                  <div class="form-group">
                  <label>Year Accepted <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="year" required value="<?php echo $row['year']; ?>">
                </div>
                  
                  <div class="form-group">
                  <label>Abstract <font style="color:red;">*</font></label>
                      <textarea class="form-control" rows="6" name="abstract" required><?php echo $row['abstract']; ?></textarea>
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

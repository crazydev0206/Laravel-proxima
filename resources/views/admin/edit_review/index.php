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
    
    if(isset($_POST['review'])) {
        $review=test_input($_POST['review']);
        $q="UPDATE journal_reviews SET review='$review' WHERE id='$id'";
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
    
    $q="SELECT * FROM journal_reviews WHERE id='$id' LIMIT 1";
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
        Edit Review
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../journal_reviews/?id=<?php echo $row['j_id']; ?>">All Reviews</a></li>
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
                  <label>Review <font style="color:red;">*</font></label>
                      <textarea class="form-control" rows="6" name="review" required><?php echo $row['review']; ?></textarea>
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

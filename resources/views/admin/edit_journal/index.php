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
    if(isset($_POST['title'])) {
    $title=test_input($_POST['title']);
    $issn=test_input($_POST['issn']);
    $categories=test_input($_POST['categories']);
    $sjr=test_input($_POST['sjr']);
    $h_index=test_input($_POST['h_index']);
    $country=test_input($_POST['country']);
    $publisher=test_input($_POST['publisher']);
    $link=test_input($_POST['link']);
    $cite_score=test_input($_POST['cite_score']);
    
    $q="UPDATE journals SET title='$title', issn='$issn', categories='$categories', sjr='$sjr', h_index='$h_index', country='$country', publisher='$publisher', link='$link', cite_score='$cite_score' WHERE id='$id'";
    $r=@mysqli_query($dbc,$q);
    if($r) {
        $error2= '<font style="color:green; font-weight:bold;">Updated successfully.</font>';
    }
    }

  }
    
    $q="SELECT * FROM journals WHERE id='$id' LIMIT 1";
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
        Edit Journal
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../all_journals/">All Journals</a></li>
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
                  <label>Title <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="title" required value="<?php echo $row['title']; ?>">
                </div>
                  
                  <div class="form-group">
                  <label>ISSN <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="issn" required value="<?php echo $row['issn']; ?>">
                </div>
                  
                  <div class="form-group">
                  <label>SJR <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="sjr" required value="<?php echo $row['sjr']; ?>">
                </div>
                  
                  <div class="form-group">
                  <label>H Index <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="h_index" required value="<?php echo $row['h_index']; ?>">
                </div>
                  
                  <div class="form-group">
                  <label>Cite Score <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="cite_score" required value="<?php echo $row['cite_score']; ?>">
                </div>
                  
                  <div class="form-group">
                  <label>Country <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="country" required value="<?php echo $row['country']; ?>">
                </div>
                  
                  <div class="form-group">
                      <?php
                                $category=$row['categories'];
                                $category=str_replace('(Q1)','',$category);
                                $category=str_replace('(Q2)','',$category);
                                $category=str_replace('(Q3)','',$category);
                                $category=str_replace('(Q4)','',$category);
                      ?>
                  <label>Categories <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="categories" required value="<?php echo $category; ?>">
                      <small>*Separate multiple categories by <b>;</b> </small>
                </div>
                  
                  <div class="form-group">
                  <label>Publisher <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="publisher" required value="<?php echo $row['publisher']; ?>">
                </div>
                  
                  <div class="form-group">
                  <label>Link <font style="color:red;">*</font></label>
                      <input type="url" class="form-control" name="link" required value="<?php echo $row['link']; ?>">
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

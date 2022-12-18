<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
    
    
    if(isset($_POST['ques'])) {
        $ques=test_input($_POST['ques']);
        $ans=test_input2($_POST['ans']);
        
    $q="INSERT INTO faqs (ques, ans) VALUES ('$ques', '$ans')";
    $r=@mysqli_query($dbc,$q) or die(mysqli_error($dbc));
        
        if($r) $error2='<font style="color:green; font-weight:bold;">Added successfully.</font>';
    }

  }
    
$q="SELECT * FROM faqs";
$r=@mysqli_query($dbc,$q);

    $add_faq='active';
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
        Add New FAQ
        <small><?php echo @mysqli_num_rows($r); ?> total FAQs</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../faq/">All FAQs</a></li>
      </ol>
        <?php if(isset($error2)) echo $error2; ?>
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

          <form role="form" action="" method="post" enctype="multipart/form-data" style="margin-top:5px; " id="add_new">
              <div class="box-body">
                  
                  <div class="form-group">
                  <label>Question</label>
                      <input type="text" class="form-control" name="ques" required>
                </div>
                  
                  <!-- /.box-header -->
            <div class="form-group">
                  <label>Answer</label>
                <textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="ans" required></textarea>
            </div>
                  
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add</button>
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

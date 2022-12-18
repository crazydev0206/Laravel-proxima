<?php
$comm='active';
include(app_path().'/admin/common/header.php'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <?php include(app_path().'/admin/common/left_menu.php'); ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Set Commissions
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/all-projects') ?>">Set Commissions</a></li>
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
              <?php echo csrf_field() ?>
              <div class="box-body">
                  
                  <div class="form-group">
                  <label>Vendor Gets(%) <font style="color:red;">*</font></label>
                      <input type="number" step="any" class="form-control" name="vendor" required value="<?php echo $commission->vendor; ?>">
                </div>
                  
                  <div class="form-group">
                  <label>Site Gets(%) <font style="color:red;">*</font></label>
                      <input type="number" step="any" class="form-control" name="site" required value="<?php echo $commission->site; ?>">
                </div>
                  
                  <hr style="border:1px solid #999;">
                  
                  <b style="color:green;">Distribute commission to the following from <?php echo $commission->site; ?>%</b>
                  
                  <hr style="border:1px solid #999;">
                  
                  <div class="form-group">
                  <label>Channel Manager(%) <font style="color:red;">*</font></label>
                      <input type="number" step="any" class="form-control" name="cm" required value="<?php echo $commission->cm; ?>">
                </div>
                  
                  <div class="form-group">
                  <label>Regional Manager(%) <font style="color:red;">*</font></label>
                      <input type="number" step="any" class="form-control" name="rm" required value="<?php echo $commission->rm; ?>">
                </div>
                  
                  <div class="form-group">
                  <label>Vendor Referral(%) <font style="color:red;">*</font></label>
                      <input type="number" step="any" class="form-control" name="vr" required value="<?php echo $commission->vr; ?>">
                </div>
                  
                  <div class="form-group">
                  <label>Customer(%) <font style="color:red;">*</font></label>
                      <input type="number" step="any" class="form-control" name="cu" required value="<?php echo $commission->cu; ?>">
                </div>
                  
                  <div class="form-group">
                  <label>Customer Referral(%) <font style="color:red;">*</font></label>
                      <input type="number" step="any" class="form-control" name="cr" required value="<?php echo $commission->cr; ?>">
                </div>
                  
                  <div class="form-group">
                  <label>Sales VP(%) <font style="color:red;">*</font></label>
                      <input type="number" step="any" class="form-control" name="sp" required value="<?php echo $commission->sp; ?>">
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
<script src="<?php echo url('tinymce/tinymce.min.js'); ?>"></script>
  <script>
      tinymce.init({
  selector: '.textarea2',
  theme: 'modern',
  plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools   contextmenu colorpicker textpattern help',
  toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
  image_advtab: true,
  templates: [
    { title: 'Edit Project', content: 'Test 1' },
    { title: 'Edit Project', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });
</script>
<?php include(app_path().'/admin/common/footer.php');
?>

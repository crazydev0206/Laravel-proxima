<?php
$import_page='active';
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
        Import Data
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/import-data'); ?>">Import Data</a></li>
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
              
          <form role="form" action="" method="post" enctype="multipart/form-data" style="margin-top:5px;">
              <?php if(Session::has('error')) { ?>
    <p style="background:red; color:white; padding:5px;"><?php echo Session::get('error'); ?>
        <a href="javascript:void(0)" onclick="this.parentNode.style.display = 'none'"><font style="float:right; color:white; font-weight:bold; padding-right:5px;">X</font></a>
    </p>
    <?php } ?>
    <?php if(Session::has('success')) { ?>
    <p style="background:green; color:white; padding:5px;"><?php echo Session::get('success'); ?>
        <a href="javascript:void(0)" onclick="this.parentNode.style.display = 'none'"><font style="float:right; color:white; font-weight:bold; padding-right:5px;">X</font></a>
    </p>
    <?php } ?>
              <?php echo csrf_field() ?>
              <div class="box-body">
                  
                  <div class="form-group">
                  <label>Update File <font style="color:red;">*</font></label>
                      <input type="file" class="form-control" name="file" accept="application/msexcel" required>
                </div>
                  
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Upload</button>
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
    { title: 'Post Project', content: 'Test 1' },
    { title: 'Post Project', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });
</script>

<?php include(app_path().'/admin/common/footer.php'); 
?>

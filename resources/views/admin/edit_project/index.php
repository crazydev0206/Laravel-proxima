<?php
$projects='active';
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
        Edit Project
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/all-projects') ?>">All Projects</a></li>
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
                  <label>Title <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="title" required value="<?php echo $project->title; ?>">
                </div>
                  
                  <div class='form-group'>
<label>
Deadline <font style="color:red;">*</font>
</label>
<br>
<input class="form-control" type="date" name="deadline" required value="<?php echo $project->deadline; ?>">
</div>
                  
                  <div class="form-group">
                  <label>Description <font style="color:red;">*</font></label>
                      <textarea class="form-control textarea2" rows="10" name="description" required><?php echo $project->description; ?></textarea>
                </div>
                  
                  <div class="form-group">
                  <label>Regular Price <font style="color:red;">*</font></label>
                      <input type="number" class="form-control" name="regular_price" required value="<?php echo $project->regular_price; ?>" min="0" step="any">
                </div>
                  
                  <div class="form-group">
                  <label>Group Price <font style="color:red;">*</font></label>
                      <input type="number" class="form-control" name="price" required value="<?php echo $project->price; ?>" min="0" step="any">
                </div>
                  
                  <div class="form-group">
                  <label>Deposit <font style="color:red;">*</font></label>
                      <input type="number" class="form-control" name="join_price" required value="<?php echo $project->join_price; ?>" min="0" step="any">
                </div>
                  
                  <div class='form-group'>
<label class='control-label' for=''>
<h3>&nbsp;Duration</h3>
</label>
<br>
Start Date: <input class="form-control" type="date" name="start" required style='width: 170px; display:inline-block;' value="<?php echo $project->start; ?>">
&nbsp;&nbsp;&nbsp;End Date: <input class="form-control" type="date" name="end" required style='width: 170px; display:inline-block;' value="<?php echo $project->end; ?>">
</div>
                  
                  <div class='form-group'>
<label class='control-label' for=''>
<h3> &nbsp;Cancellation Policy</h3>
</label>
<textarea class='form-control textarea' cols='30' id='' name='cancel_policy' rows='3'><?php echo $project->cancel_policy; ?></textarea>
</div>
                  
                  <div class='form-group'>
<label class='control-label' for=''>
<h3> Set Member Limit</h3>
</label><br>
    <input type="number" class='form-control' id='' name='min_members' style='width: 120px; display:inline-block;' min="0" placeholder="Min." value="<?php echo $project->min_members; ?>" required>

    <input type="number" class='form-control' id='' name='max_members' style='width: 120px; display:inline-block;' min="0" placeholder="Max." value="<?php echo $project->max_members; ?>" required>
</div>
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Category <font style="color:red;">*</font></label>
                  <select name="category" class="form-control" required>
                      <option value="">Please Select</option>
                      <?php
            if(!empty($categories)) {
                foreach($categories as $cat) {
            ?>
                      <option value="<?php echo $cat->name; ?>" <?php if($project->category==$cat->name) echo 'selected'; ?> ><?php echo $cat->name; ?></option>
            <?php } } ?>
                  </select>
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

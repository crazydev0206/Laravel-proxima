<?php
$blogs_page='active';
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
        Manage Blogs
        <small><?php echo count($blogs); ?> total posts</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/manage-blogs'); ?>">Manage Blogs</a></li>
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
              
              <button class="btn btn-success" style="float:right;" onclick="add_new()">+ New Post</button>

          <form role="form" action="" method="post" enctype="multipart/form-data" style="margin-top:5px; display:none;" id="add_new">
              <?php echo csrf_field() ?>
              <div class="box-body">
                  
                  <div class="form-group">
                  <label>Image <font style="color:red;">*</font></label>
                      <input type="file" class="form-control" name="image" required accept="image/*">
                </div>
                  
                  <div class="form-group">
                  <label>Title <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="title" required>
                </div>
                  
                  <div class="form-group">
                  <label>Description <font style="color:red;">*</font></label>
                      <textarea class="form-control textarea2" name="description" required rows="6"></textarea>
                </div>
                  
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Post Blog</button>
              </div>
              <hr>
          </form>
              
              <script>
                  function add_new(){
                      $("#add_new").slideToggle();
                  }
              </script>

            <div class="box-body">
                <?php if(isset($error)) echo $error.'<br><br>'; ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(!empty($blogs)) { $i=1;
                    foreach($blogs as $blog) {
                        $r_id=$blog->id;
                   ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $blog->title; ?></td>
                  <td><?php echo substr(trim(strip_tags($blog->description)),0,200); ?></td>
                    <td><img src="<?php echo url('blog_images/'.$blog->image); ?>" style="max-width:200px;"></td>
                  <td>
                      <a href="<?php echo url('admin/edit-blog/'.$blog->id); ?>"><button type="submit" class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                      
                    <form action="" method="post" style="display:inline;">
                        <?php echo csrf_field() ?>
                    <input type="hidden" name="delete_id" value="<?php echo $blog->id; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?');"><i class="fa fa-trash"></i></button>
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

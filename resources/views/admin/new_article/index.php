<?php $new_article='active';
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
        New article
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/change-password'); ?>">New article</a></li>
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
              <?php echo csrf_field() ?>
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
                  
                  <div class="col-12 col-md-6">
                  <div class="form-group">
                  <label>News agency <font style="color:red;">*</font></label>
                      <select class="form-control" name="agency" required>
                          <option value="">Please select</option>
                          <option value="CBC">CBC</option>
                          <option value="CNN">CNN</option>
                          <option value="CNBC">CNBC</option>
                          <option value="Global News">Global news</option>
                      </select>
                    </div>
                    </div>
                  
                  <div class="col-12 col-md-6">
                  <div class="form-group">
                  <label>Title <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="title" required>
                </div>
                  </div>
                  
                  <div class="col-12 col-md-6">
                  <div class="form-group">
                  <label>Image <font style="color:red;">*</font></label>
                      <input type="file" class="form-control" name="file" required>
                </div>
                  </div>


                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label>By <font style="color:red">*</font></label>
                      <input type="text" name="by" class="form-control" required>
                    </div>
                  </div>

                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label>Date</label>
                      <input type="date" name="date" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label>Time</label>
                      <input type="time" name="time" class="form-control" required>
                    </div>
                  </div>

                  <div class="col-12 col-md-12">
                    <div class="form-group">
                      <label>Writers Photo</label>
                      <input type="file" name="writers_photo" class="form-control" required>
                    </div>
                  </div>

                  
                  <div class="col-12 col-md-12">
                  <div class="form-group">
                  <label>Description <font style="color:red;">*</font></label>
                      <textarea class="form-control" name="description" id="editor"></textarea>
                </div>
                  </div>
                  
              </div>

              <div class="box-footer">
                  <div class="col-12 col-md-12">
                <button type="submit" class="btn btn-primary">Post article</button>
                  </div>
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
<?php include(app_path().'/admin/common/footer.php');
?>
  <script src="https://cdn.tiny.cloud/1/p3jdu0aksye5em4qk7qb01n7x6zelav2jeiq8jnznd0cmq0a/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

   <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
  </script>
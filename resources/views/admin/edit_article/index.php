<?php $all_articles='active';
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
        Edit Article
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/edit-article/'.$article->id); ?>">Edit Article</a></li>
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
                  <label>News Agency <font style="color:red;">*</font></label>
                      <select class="form-control" name="agency" required>
                          <option value="">Please select</option>
                          <option value="CBC" <?php if($article->agency=='CBC') echo 'selected'; ?> >CBC</option>
                          <option value="CNN" <?php if($article->agency=='CNN') echo 'selected'; ?> >CNN</option>
                          <option value="CNBC" <?php if($article->agency=='CNBC') echo 'selected'; ?> >CNBC</option>
                          <option value="Global News" <?php if($article->agency=='Global News') echo 'selected'; ?> >Global News</option>
                      </select>
                    </div>
                    </div>
                  
                  <div class="col-12 col-md-6">
                  <div class="form-group">
                  <label>Title <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="title" required value="<?php echo $article->title; ?>">
                </div>
                  </div>
                  
                  <div class="col-12 col-md-12">
                  <div class="form-group">
                  <label>Update Image</label>
                      <input type="file" class="form-control" name="file">
                </div>
                  </div>
                  
                  <div class="col-12 col-md-12">
                  <div class="form-group">
                  <label>Description <font style="color:red;">*</font></label>
                      <textarea class="form-control" name="description" id="editor"><?php echo $article->description; ?></textarea>
                </div>
                  </div>
                  
              </div>

              <div class="box-footer">
                  <div class="col-12 col-md-12">
                <button type="submit" class="btn btn-primary">Update article</button>
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
<script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>
<script>
    var editor = null;
    ClassicEditor.create(document.querySelector("#editor"), {
        toolbar: [
            "bold",
            "italic",
            "link",
            "bulletedList",
            "numberedList",
            "blockQuote",
            "undo",
            "redo"
        ]
    })
            .then(editor => {
        //debugger;
        window.editor = editor;
    })
    .catch(error => {
        console.error(error);
    });
</script>
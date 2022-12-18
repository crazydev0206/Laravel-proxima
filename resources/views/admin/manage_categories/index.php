<?php
$cat='active';
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
        Manage Categories
        <small><?php echo count($categories); ?> total categories</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('manage-categories'); ?>">Manage Categories</a></li>
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
              
              <button class="btn btn-success" style="float:right;" onclick="add_new()">+ New Category</button>

          <form role="form" action="" method="post" enctype="multipart/form-data" style="margin-top:5px; display:none;" id="add_new">
              <?php echo csrf_field() ?>
              <div class="box-body">
                  
                  <div class="form-group">
                  <label>Category Name <font style="color:red;">*</font></label>
                      <input type="text" class="form-control" name="name" required>
                </div>
                  
                  <div class="form-group">
                  <label>Category Icon <font style="color:red;">*</font></label>
                      <input type="file" class="form-control" name="icon" required accept="image/*">
                </div>
                  
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add</button>
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
                  <th>Category Name</th>
                    <th>Category Icon</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(!empty($categories)) { $i=1;
                    foreach($categories as $cat) {
                        $r_id=$cat->id;
                   ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $cat->name; ?></td>
                  <td><img src="<?php echo url('images/icons/'.$cat->icon); ?>" width="50"></td>
                  <td>
                      <a href="<?php echo url('admin/edit-category/'.$cat->id); ?>"><button type="submit" class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                      
                    <form action="" method="post" style="display:inline;">
                        <?php echo csrf_field() ?>
                    <input type="hidden" name="delete_id" value="<?php echo $cat->id; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?');"><i class="fa fa-trash"></i></button>
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
<?php include(app_path().'/admin/common/footer.php'); 
?>

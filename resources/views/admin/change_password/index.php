<?php
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
        Change Password
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/change-password'); ?>">Change Password</a></li>
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
                  
                  <div class="form-group">
                  <label>Current Password <font style="color:red;">*</font></label>
                      <input type="password" class="form-control" name="pass" required>
                </div>
                  
                  <div class="form-group">
                  <label>New Password <font style="color:red;">*</font></label>
                      <input type="password" class="form-control" name="pass1" required>
                </div>
                  
                  <div class="form-group">
                  <label>Repeat Password <font style="color:red;">*</font></label>
                      <input type="password" class="form-control" name="pass2" required>
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
<?php include(app_path().'/admin/common/footer.php');
?>

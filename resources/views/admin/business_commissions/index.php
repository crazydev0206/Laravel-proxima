<?php
$b_comm='active';
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
        Business Commissions
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/business-commissions'); ?>">Business Commissions</a></li>
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
              
              <button class="btn btn-success" style="float:right;" onclick="add_new()">+ Add Commissions</button>

          <form role="form" action="" method="post" enctype="multipart/form-data" style="margin-top:5px; display:none;" id="add_new">
              <?php echo csrf_field() ?>
              <div class="box-body">
                  
                  <div class="form-group">
                  <label>Select Business User <font style="color:red;">*</font></label>
                      <select class="form-control" name="user_id" required>
                          <option value="">Please select user</option>
                          <?php foreach($b_users as $b_user) { ?>
                          <option value="<?php echo $b_user->id; ?>"><?php echo $b_user->name.' ('.$b_user->email.')'; ?></option>
                          <?php } ?>
                      </select>
                </div>
                  
                  <div class="form-group" id="commissions">
                      <label class="form-control-label" style="width:100%;"><b>Set Commissions:</b>
                          <a class="float-right" href="javascript:void(0)" onclick="add_commission()"><i class="fa fa-plus"></i> Add More</a>
                      </label>
                  <div class="row">
                <div class="col-lg-11" style="margin:0px;">
                    <small>Title</small>
                  <input type="text" class="form-control" placeholder="" required name="titles[]" style="padding-right:0px; padding-left:4px; margin:0px;">
                </div>
                <div class="col-lg-3" style="margin:0px; padding-right:0px;">
                    <small>Sale Price ($)</small>
                  <input type="number" class="form-control" placeholder="" required name="sale_prices[]" step="any" min="0" style="padding-right:0px; padding-left:4px; margin:0px;">
                </div>
                <div class="col-lg-3" style="margin:0px; padding-right:0px;">
                    <small>Deposit Price ($)</small>
                  <input type="number" class="form-control" placeholder="" required name="deposit_prices[]" step="any" min="0" style="padding-right:0px; padding-left:4px; margin:0px;">
                </div>
                <div class="col-lg-2" style="margin:0px; padding-right:0px;">
                    <small>Percent (%)</small>
                  <input type="number" class="form-control" placeholder="" required name="percents[]" step="any" min="0" style="padding-right:0px; padding-left:4px;">
                </div>
                <div class="col-lg-3">
                    <small>Fixed ($)</small>
                  <input type="number" class="form-control" placeholder="" required name="fixed[]" step="any" min="0" style="padding-right:0px; padding-left:4px;">
                </div>
              </div>
                      
                  </div>
                  
                  <script>
                      function add_commission(){
                          $("#commissions").append('<div class="row mt-3" style="margin-top:20px;">\
                <div class="col-lg-11" style="margin:0px;">\
                    <small>Title</small>\
                  <input type="text" class="form-control" placeholder="" required name="titles[]" style="padding-right:0px; padding-left:4px; margin:0px;">\
                </div>\
                <div class="col-lg-3" style="margin:0px; padding-right:0px;">\
                    <small>Sale Price ($)</small>\
                  <input type="number" class="form-control" placeholder="" required name="sale_prices[]" step="any" min="0" style="padding-right:0px; padding-left:4px; margin:0px;">\
                </div>\
                <div class="col-lg-3" style="margin:0px; padding-right:0px;">\
                    <small>Deposit Price ($)</small>\
                  <input type="number" class="form-control" placeholder="" required name="deposit_prices[]" step="any" min="0" style="padding-right:0px; padding-left:4px; margin:0px;">\
                </div>\
                <div class="col-lg-2" style="margin:0px; padding-right:0px;">\
                    <small>Percent (%)</small>\
                  <input type="number" class="form-control" placeholder="" required name="percents[]" step="any" min="0" style="padding-right:0px; padding-left:4px;">\
                </div>\
                <div class="col-lg-3">\
                    <small>Fixed ($)</small>\
                  <input type="number" class="form-control" placeholder="" required name="fixed[]" step="any" min="0" style="padding-right:0px; padding-left:4px;">\
                </div>\
                      <a class="float-right" href="javascript:void(0)" onclick="remove_commission(this)"><i class="fa fa-minus-circle"></i></a>\
              </div>');
                      }
                      
                      function remove_commission(th){
                          th=$(th).parent();
                          $(th).remove();
                      }
                  </script>
                  
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

            <div class="box-body" style="margin-top:30px;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Business User</th>
                  <th>Title</th>
                  <th>Sale Price</th>
                  <th>Deposit Price</th>
                    <th>Percentage</th>
                    <th>Fixed Price</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(!empty($commissions)) { $i=1;
                    foreach($commissions as $row) {
                        $p_id=$row['id'];
                   ?>
                <tr>
                    <form action="" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $row['for']; ?></td>
                  <td><input type="text" class="form-control" name="title" value="<?php echo $row['title']; ?>" required style="max-width:130px; padding-left:5px; padding-right:0px;"></td>
                  <td>$ <input type="number" class="form-control" name="sale_price" value="<?php echo $row['sale_price']; ?>" required step="any" min="0" style="max-width:80px; padding-left:5px; padding-right:0px;"></td>
                  <td>$ <input type="number" class="form-control" name="price" value="<?php echo $row['price']; ?>" required step="any" min="0" style="max-width:80px; padding-left:5px; padding-right:0px;"></td>
                  <td><input type="number" class="form-control" name="percent" value="<?php echo $row['percent']; ?>" required step="any" min="0" style="max-width:70px; padding-left:5px; padding-right:0px;"> %</td>
                  <td>$ <input type="number" class="form-control" name="fixed" value="<?php echo $row['fixed']; ?>" required step="any" min="0" style="max-width:80px; padding-left:5px; padding-right:0px;"></td>
                    <td>
                        <button class="btn btn-success">Update</button>
                  </form>
                    
                    <form action="" method="post" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
                        <button class="btn btn-danger" onclick="return confirm('Do you really want to delete this commission?');"><i class="fa fa-trash"></i></button>
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

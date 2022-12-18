<?php
$orders_page='active';
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
        All Orders
        <small><?php echo count($orders); ?> total orders</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/review-orders'); ?>">All Orders</a></li>
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

            <div class="box-body" style="margin-top:30px;">
                <?php if(isset($error) AND !empty($error)) echo $error.'<br><br>'; ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Ordered By</th>
                  <th>Contact Email</th>
                  <th>Ordered On</th>
                    <?php if($admin_type=='1') { ?>
                    <th>Portal</th>
                    <?php } ?>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    if(!empty($orders)) { $ids=array(); $i=0;
                        foreach($orders as $row) {
                        $r_id=$row['order']->id;
                   ?>
                <tr>
                  <td><?php echo $row['order']->id; ?></td>
                  <td><?php echo $row['user']->company_name; ?>
                      <p>(<?php echo $row['user']->email; ?>)</p>
                    </td>
                    <td><?php echo $row['order']->email; ?></td>
                    <td><?php echo $row['order']->on_date; ?></td>
                    <?php if($admin_type=='1') { ?>
                    <td><?php echo $row['admin']->site_name; ?></td>
                    <?php } ?>
                    
                  <td>
                    <form action="" method="post" style="display:inline;">
                        {{ csrf_field() }}
                    <input type="hidden" name="delete_id" value="<?php echo $row['order']->id; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this order?');"><i class="fa fa-trash"></i></button>
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

<script>
    function show_levels(id) {
        $('#levels-'+id).show();
    }
</script>
<?php include(app_path().'/admin/common/footer.php'); 
?>

<?php
$free_picks='active';
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
        Free Picks
        <small><?php echo count($data); ?> total records</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/free-picks'); ?>">Free Picks</a></li>
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
              
              <!--<button class="btn btn-success" style="float:right;" onclick="add_new()">+ Add New</button>-->

          <form role="form" action="" method="post" style="margin-top:5px; display:none;" id="add_new">
              {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Username<font style="color:red;">*</font></label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" required name="username">
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Password<font style="color:red;">*</font></label>
                  <input type="password" class="form-control" id="exampleInputEmail1" placeholder="" required name="pass">
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

            <div class="box-body" style="margin-top:30px;">
                <?php if(isset($error) AND !empty($error)) echo $error.'<br><br>'; ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>On Date</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    if(!empty($data)) { $ids=array(); $i=0;
                        foreach($data as $row) {
                        $r_id=$row->id;
                   ?>
                <tr>
                  <td><?php echo $row->id; ?></td>
                  <td><?php echo $row->name; ?></td>
                  <td><?php echo $row->email; ?></td>
                  <td><?php echo $row->phone; ?></td>
                  <td><?php echo $row->on_date; ?></td>
                    
                  <td>
                    <form action="" method="post" style="display:inline;">
                        {{ csrf_field() }}
                    <input type="hidden" name="delete_id" value="<?php echo $row->id; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this record?');"><i class="fa fa-trash"></i></button>
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

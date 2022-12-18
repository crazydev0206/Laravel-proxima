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
        Companies Data
        <small><?php echo count($companies_data); ?> total records</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/companies-data'); ?>">Companies Data</a></li>
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
                  <th>Website</th>
                  <th>Startups Funded</th>
                  <th>Funded Amount</th>
                  <th>Type</th>
                    <?php if($admin_type=='1') { ?>
                    <th>Portal</th>
                    <?php } ?>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    if(!empty($companies_data)) { $ids=array(); $i=0;
                        foreach($companies_data as $row) {
                        $r_id=$row['data']->id;
                   ?>
                <tr>
                  <td><?php echo $row['data']->id; ?></td>
                  <td><?php echo $row['data']->name; ?></td>
                  <td><?php echo $row['data']->website; ?></td>
                    <td><?php echo $row['data']->funded_startups; ?></td>
                    <td><?php echo $row['data']->funded_amount; ?></td>
                    <td><?php echo $row['data']->type; ?></td>
                    <?php if($admin_type=='1') { ?>
                    <td><?php echo $row['admin']->site_name; ?></td>
                    <?php } ?>
                    
                  <td>
                      <button class="btn btn-success" data-toggle="modal" data-target="#details-<?php echo $r_id; ?>" title="Company Details"><i class="fa fa-list"></i></button>
                    <form action="" method="post" style="display:inline;">
                        {{ csrf_field() }}
                    <input type="hidden" name="delete_id" value="<?php echo $row['data']->id; ?>">
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

<?php
    if(!empty($companies_data)) {
        foreach($companies_data as $row) {
            $u_id=$row['data']->id;
?>
<div class="modal fade" id="details-<?php echo $row['data']->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    {{ csrf_field() }}
              <div class="modal-header">
                  <h5 class="modal-title"><i class="fa fa-building"></i> <b><?php echo $row['data']->name; ?> Details</b></h5>
              </div>
              <div class="modal-body">
                  <table class="table table-striped">
                <tbody>
                    <tr>
                        <td style="max-width:200px;"><b>Address</b></td><td><?php echo $row['data']->address; ?></td>
                    </tr>
                    <tr>
                        <td style="max-width:200px;"><b>City</b></td><td><?php echo $row['data']->city; ?></td>
                    </tr>
                    <tr>
                        <td style="max-width:200px;"><b>Country</b></td><td><?php echo $row['data']->country; ?></td>
                    </tr>
                    <tr>
                        <td style="max-width:200px;"><b>Region</b></td><td><?php echo $row['data']->region; ?></td>
                    </tr>
                    <tr>
                        <td style="max-width:200px;"><b>Contact General</b></td><td><?php echo $row['data']->contact_general; ?></td>
                    </tr>
                    <tr>
                        <td style="max-width:200px;"><b>Contact Number</b></td><td><?php echo $row['data']->contact_number; ?></td>
                    </tr>
                    <tr>
                        <td style="max-width:200px;"><b>Contact Email</b></td><td><?php echo $row['data']->contact_email; ?></td>
                    </tr>
                    <tr>
                        <td style="max-width:200px;"><b>Contact Person</b></td><td><?php echo $row['data']->contact_person; ?></td>
                    </tr>
                    <tr>
                        <td style="max-width:200px;"><b>Title</b></td><td><?php echo $row['data']->title; ?></td>
                    </tr>
                    <tr>
                        <td style="max-width:200px;"><b>Type</b></td><td><?php echo $row['data']->type; ?></td>
                    </tr>

                    </tbody>
                <tfoot>

                </tfoot>
              </table>
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
              </div>
                  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
<?php } } ?>

<script>
    function show_levels(id) {
        $('#levels-'+id).show();
    }
</script>
<?php include(app_path().'/admin/common/footer.php'); 
?>

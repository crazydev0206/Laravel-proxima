<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');
    $user='active';

if($_SERVER['REQUEST_METHOD']=='POST') {
        if(isset($_POST['status'])) {
        $status=test_input($_POST['status']);
        $p_id=test_input($_POST['p_id']);
        
        if($status=='1') $status='0';
        else $status='1';
        
        $q="UPDATE users2 SET status='$status' WHERE id='$p_id'";
        $r=@mysqli_query($dbc,$q);
}
    
  if(isset($_POST['delete_id'])) {
  $cat_id=test_input($_POST['delete_id']);

  $q="DELETE FROM users2 WHERE id='$cat_id'";
  $r=@mysqli_query($dbc,$q);
      
  }

  if(isset($_POST['name'])) {
    $name=test_input($_POST['name']);
    $alias=test_input($_POST['alias']);
      $unit=test_input($_POST['unit']);

    if(!empty($name)) {
      $q="INSERT INTO categories (name,alias,unit) VALUES ('$name','$alias','$unit')";
      $r=@mysqli_query($dbc,$q);

      if($r) {
          $error='<font style="color:green;">Added successfully</font>';
      }
    }
  }
}

$q="SELECT * FROM users2 ORDER BY id DESC";
$r=@mysqli_query($dbc,$q);

include('../common/header.php'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <?php include('../common/left_menu.php'); ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All Users
        <small><?php echo @mysqli_num_rows($r); ?> total users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../users2/">All Users</a></li>
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
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Username<font style="color:red;">*</font></label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" required name="name">
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Password<font style="color:red;">*</font></label>
                  <input type="password" class="form-control" id="exampleInputEmail1" placeholder="" required name="alias">
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Name</th>
                    <th>Email</th>
                    <th>Registered On</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(@mysqli_num_rows($r)!=0) { $i=1;
                    while($row=@mysqli_fetch_assoc($r)) {
                        $r_id=$row['id'];
                   ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['reg_on']; ?></td>
                  <td>
                    <form action="" method="post" style="display:inline;">
                                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                              <button class='btn btn-sm btn-danger' title="Delete" onclick="return confirm('Are you sure you want to delete this user?');">
                                <span class='fa fa-trash'></span>
                              </button>
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
<?php include('../common/footer.php'); }
?>

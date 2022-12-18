<?php
if($_SERVER['REQUEST_METHOD']=='POST') {
    
  if(isset($_POST['p_id'])) {
  $id=test_input($_POST['p_id']);

  $q="DELETE FROM articles WHERE id='$id'";
  $r=@mysqli_query($dbc,$q);
  }
  }

$q="SELECT * FROM articles ORDER BY id DESC";
$r=@mysqli_query($dbc,$q);

    $projects='active';
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
        All Projects
        <small><?php echo count($all_projects); ?> total projects</small>
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/all-projects'); ?>">All Projects</a></li>
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Title</th>
                  <th>Category</th>
                    <th>Location</th>
                    <th>Price</th>
                    <th>Posted By</th>
                  <th>Posted On</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(!empty($all_projects)) { $i=1;
                    foreach($all_projects as $row) {
                        $p_id=$row['id'];
                   ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $row['title']; ?></td>
                  <td><?php echo $row['category']; ?></td>
                  <td><?php echo $row['location']; ?></td>
                  <td><?php echo '$'.$row['price'].' '.$row['currency']; ?></td>
                  <td><?php echo $row['posted_by']; ?></td>
                  <td><?php echo $row['posted_on'] ?></td>
                    <td>
                    <a href="<?php echo url('project/'.$p_id); ?>" target="_blank"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                      <a href="<?php echo url('admin/edit-project/'.$p_id); ?>"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a>
                 <form action="" method="post" style="display:inline;">
                        <?php echo csrf_field() ?>
                    <input type="hidden" name="feature_status" value="<?php echo $row['feature']; ?>">
                    <input type="hidden" name="feature_id" value="<?php echo $row['id']; ?>">
                     <?php if($row['feature']=='0') { ?>
                    <button type="submit" class="btn btn-default" onclick="return confirm('Do you really want to mark this project as Featured?');"><i class="fa fa-star"></i></button>
                     <?php } else { ?>
                     <button type="submit" class="btn btn-success" onclick="return confirm('Do you really want to remove this project from Featured list?');"><i class="fa fa-star"></i></button>
                     <?php } ?>
                  </form>
                    <form action="" method="post" style="display:inline;">
                        <?php echo csrf_field() ?>
                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this project?');"><i class="fa fa-trash"></i></button>
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

<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');
    if(!isset($_GET['id'])) {
              ?>
              <script> window.location="../all_journals/"; </script>
              <?php
            }
            else $id=test_input($_GET['id']);
 
    if($_SERVER['REQUEST_METHOD']=='POST') {   
    if(isset($_POST['delete'])) {
    $a_id=test_input($_POST['delete']);

    $q="DELETE FROM abstracts WHERE id='$a_id'";
    $r=@mysqli_query($dbc,$q);
        }
    }


$q="SELECT title, id FROM journals WHERE id='$id' LIMIT 1";
  $r=@mysqli_query($dbc,$q);
    $row=@mysqli_fetch_assoc($r);
    $jou='active';

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
          <b>"<?php echo $row['title']; ?>"</b> Abstracts
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../all_journals/">All Journals</a></li>
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
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Authors</th>
                    <th>Title</th>
                    <th>Volume No.</th>
                    <th>Issue No.</th>
                    <th>Year Accepted</th>
                  <th>Abstract</th>
                <th>Posted By</th>
                <th>Posted On</th>
                <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $q="SELECT * FROM abstracts WHERE j_id='$id'";
                  $r=@mysqli_query($dbc,$q);
                  if(@mysqli_num_rows($r)!=0) {
                    while($row=@mysqli_fetch_assoc($r)) {
                        $user=$row['user_id'];
                        
                        $qu="SELECT name, email FROM users WHERE id='$user' LIMIT 1";
                        $ru=@mysqli_query($dbc,$qu);
                        $rowu=@mysqli_fetch_assoc($ru);
                   ?>
                <tr>
                  <td>#<b><?php echo $row['id']; ?></b></td>
                    <td><?php echo $row['authors']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['volume']; ?></td>
                    <td><?php echo $row['issue']; ?></td>
                    <td><?php echo $row['year']; ?></td>
                    <td><?php echo $row['abstract']; ?></td>
                    <td><?php echo $rowu['name'].'<br>('.$rowu['email'].')'; ?></td>
                    <td><?php echo $row['on_date']; ?></td>
                    <td>
                        <a href="../edit_abstract/?id=<?php echo $row['id']; ?>"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a>
                        <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="delete" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this abstract?');"><i class="fa fa-trash"></i></button>
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

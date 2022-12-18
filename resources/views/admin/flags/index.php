<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');
    $flag='active';

if($_SERVER['REQUEST_METHOD']=='POST') {
    if(isset($_POST['delete_report'])) {
  $id=test_input($_POST['delete_report']);
  $l_id=test_input($_POST['l_id']);
      
  $q="DELETE FROM threads WHERE id='$l_id'"; //echo $l_id;
  $r=@mysqli_query($dbc,$q);
        
  $q="DELETE FROM flags WHERE id='$id'";
  $r=@mysqli_query($dbc,$q);
      
  }
    
  if(isset($_POST['delete_id'])) {
  $cat_id=test_input($_POST['delete_id']);
      
  $q="DELETE FROM flags WHERE id='$cat_id'";
  $r=@mysqli_query($dbc,$q);
      
  }
}

$q="SELECT * FROM flags WHERE type='1' ORDER BY id DESC";
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
        Flags
        <small><?php echo @mysqli_num_rows($r); ?> total flags</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../flags/">All Flags</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

            <div class="box-body" style="margin-top:30px;">
                <?php if(isset($error) AND !empty($error)) echo $error.'<br><br>'; ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Reported By</th>
                  <th>Report For</th>
                  <th>Report</th>
                  <th>On Date</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(@mysqli_num_rows($r)!=0) { $i=1;
                    while($row=@mysqli_fetch_assoc($r)) {
                        $r_id=$row['id'];
                        $user=$row['user_id'];
                        $item_id=$row['p_id'];
                        $p_id=$row['p_id'];
                        $type=$row['type'];
                        
                        $q2="SELECT name, email FROM users WHERE id='$user' LIMIT 1";
                        $r2=@mysqli_query($dbc,$q2);
                        $row2=@mysqli_fetch_assoc($r2);
                        
                        $q3="SELECT title FROM threads WHERE id='$item_id' LIMIT 1";
                        $r3=@mysqli_query($dbc,$q3);
                        $row3=@mysqli_fetch_assoc($r3);
                        $on='<a href="../../thread/?id='.$p_id.'" target="_blank"> '.$row3['title'].'</a>'; 
                        
                        /*if($for=='1') {
                            $on='Podcast: ';
                            $q3="SELECT title, u FROM podcasts WHERE id='$item_id' LIMIT 1";
                            $r3=@mysqli_query($dbc,$q3);
                            $row3=@mysqli_fetch_assoc($r3);
                            $on.='<a href="../../podcast/'.$row3['u'].'" target="_blank">'.$row3['title'].'</a>';
                        }
                        else {
                            $on='Episode: ';
                            $q3="SELECT title, u FROM episodes WHERE id='$item_id' LIMIT 1";
                            $r3=@mysqli_query($dbc,$q3);
                            $row3=@mysqli_fetch_assoc($r3);
                            $on.='<a href="../../episode/'.$row3['u'].'" target="_blank">'.$row3['title'].'</a>';
                        }*/
                   ?>
                <tr>
                  <td><?php echo $r_id; ?></td>
                  <td><?php echo $row2['name'].' <br>('.$row2['email'].')'; ?></td>
                  <td><?php echo $on; ?></td>
                  <td><?php echo $row['report']; ?></td>
                  <td><?php echo $row['on_date']; ?></td>
                  <td>
                      <a href="../edit_thread/?id=<?php echo $p_id; ?>"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a>
                      
                    <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this report?');"><i class="fa fa-trash"></i></button>
                  </form>
                      <br><br>
                      <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="delete_report" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="l_id" value="<?php echo $row['l_id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this thread?');">Delete Reported Item</button>
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

<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
  if(isset($_POST['reject'])) {
    $a_id=test_input($_POST['reject']);

    $q="UPDATE withdrawal_requests SET status='Cancelled' WHERE id='$a_id'";
    $r=@mysqli_query($dbc,$q);
  }

  if(isset($_POST['accept'])) {
    $a_id=test_input($_POST['accept']);

    $q="UPDATE withdrawal_requests SET status='Released' WHERE id='$a_id'";
    $r=@mysqli_query($dbc,$q);
      
      if($r) {
          $q="SELECT user_id, amount FROM withdrawal_requests WHERE id='$a_id' LIMIT 1";
          $r=@mysqli_query($dbc,$q);
          $row=@mysqli_fetch_assoc($r);
          $user=$row['user_id'];
          $amount=$row['amount'];
          
          $q="SELECT balance FROM users WHERE id='$user' LIMIT 1";
          $r=@mysqli_query($dbc,$q);
          $row=@mysqli_fetch_assoc($r);
          $balance=$row['balance'];
          $balance-=$amount;
          
          $q="UPDATE users SET balance='$balance' WHERE id='$user'";
          $r=@mysqli_query($dbc,$q);
          
      }
  }

  if(isset($_POST['delete'])) {
    $a_id=test_input($_POST['delete']);

    $q="DELETE FROM withdrawal_requests WHERE id='$a_id'";
    $r=@mysqli_query($dbc,$q);
  }
}

$q="SELECT * FROM withdrawal_requests";
$r=@mysqli_query($dbc,$q);
    $with='active';

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
        Withdrawal Requests
        <small><?php echo @mysqli_num_rows($r); ?> total requests</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../withdrawl_requests">Withdrawal Requests</a></li>
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
                  <th>Requested By</th>
                <th>Method</th>
                <th>Amount Requested</th>
                <th>Requested On</th>
                <th>Status</th>
                <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(@mysqli_num_rows($r)!=0) {
                    while($row=@mysqli_fetch_assoc($r)) {
                      $user=$row['user_id'];
                        $status=$row['status'];
                $status2=$row['status'];
                if($status=='Requested') $status='<font style="color:blue;"><b>Under Review</b></font>';
                if($status=='Released') $status='<font style="color:green;"><b>✓</b> Released</font>';
                if($status=='Cancelled') $status='<font style="color:red;"><b>X</b> Cancelled</font>';

                      $q2="SELECT name,email FROM users WHERE id='$user' LIMIT 1";
                      $r2=@mysqli_query($dbc,$q2);
                      if(@mysqli_num_rows($r2)==0) continue;
                      $row2=@mysqli_fetch_assoc($r2);
                   ?>
                <tr>
                  <td>#<b><?php echo $row['id']; ?></b></td>
                  <td><?php echo $row2['name'].' <br>('.$row2['email'].')'; ?></td>
                    <td><?php echo $row['method']; ?></td>
                  <td><?php echo '$'.$row['amount']; ?></td>
                  <td><?php echo $row['requested_on'] ?></td>
                  <td><?php echo $status; ?></td>
                  <td><center>
                      <a href="../bank_details/?id=<?php echo $user; ?>" target="_blank"><button class="btn btn-primary" type="button">Bank Details</button></a></center>
                    <?php if($row['status']!='Cancelled' AND $row['status']!='Released') { ?>
                    <center>
                    <form action="" method="post">
                    <input type="hidden" name="accept" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-success" onclick="return confirm('Do you really want to mark it as processed?');">Transferred</button>
                  </form>
                    <form action="" method="post">
                    <input type="hidden" name="reject" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to reject this request?');">Reject</button>
                  </form></center>
                  <?php } else { ?>
                      <center>
                    <form action="" method="post">
                    <input type="hidden" name="delete" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this application?');">Delete</button>
                  </form>
                          </center>
                    <?php } ?>
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

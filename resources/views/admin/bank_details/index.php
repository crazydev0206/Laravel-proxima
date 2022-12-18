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
              <script> window.location="../withdrawal_requests/"; </script>
              <?php
            }
            else $id=test_input($_GET['id']);


$q="SELECT * FROM bank_details WHERE user_id='$id'";
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
        Bank Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../withdrawl_requests/">Withdrawal Requests</a></li>
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
                  <th>Name</th>
                <th>Company Name</th>
                <th>Company Address</th>
                <th>Company Phone</th>
                <th>Email</th>
                <th>PayPal Email</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(@mysqli_num_rows($r)!=0) {
                    while($row=@mysqli_fetch_assoc($r)) {
                        
                   ?>
                <tr>
                  <td>#<b><?php echo $row['id']; ?></b></td>
                  <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['company_name']; ?></td>
    <td><?php echo $row['company_address'].', '.$row['company_city'].', '.$row['company_state'].', '.$row['company_zipcode']; ?></td>
    <td><?php echo $row['company_no']; ?></td>
    <td><?php if(!empty($row['email'])) echo $row['email']; else echo '<b>--</b>'; ?></td>
    <td><?php if(!empty($row['paypal_email1'])) echo $row['paypal_email1']; else echo '<b>--</b>'; ?></td>
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

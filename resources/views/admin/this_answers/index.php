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
<script> window.location="../dashboard"; </script>
<?php
}
else $id=test_input($_GET['id']);

if($_SERVER['REQUEST_METHOD']=='POST') {
  if(isset($_POST['answer_id'])) {
    $a_id=test_input($_POST['answer_id']);

    $q="DELETE FROM mb_chat WHERE id='$a_id'";
    $r=@mysqli_query($dbc,$q);
  }
}

$q="SELECT * FROM mb_chat WHERE q_id='$id'";
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
        #<?php echo $id; ?> Answers
        <small><?php echo @mysqli_num_rows($r); ?> total answers</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboards"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../mb_answers">MB Answers</a></li>
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
                  <th>Answer By</th>
                  <th>Answer</th>
                  <th>Question (#ID)</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(@mysqli_num_rows($r)!=0) {
                    while($row=@mysqli_fetch_assoc($r)) {
                      $user=$row['user_id'];
                      $qa_id=$row['q_id'];
                      $a_id=$row['id'];

                      $q2="SELECT question FROM questions WHERE id='$qa_id' LIMIT 1";
                      $r2=@mysqli_query($dbc,$q2);
                      if(@mysqli_num_rows($r2)==0) continue;
                      $row3=@mysqli_fetch_assoc($r2);

                      $q2="SELECT first_name,last_name,email FROM users WHERE id='$user' LIMIT 1";
                      $r2=@mysqli_query($dbc,$q2);
                      if(@mysqli_num_rows($r2)==0) continue;
                      $row2=@mysqli_fetch_assoc($r2);

                      if($row['message']=='Accepted the invitation!' OR $row['message']=='Rejected the invitation!') continue;
                   ?>
                <tr>
                  <td>#<b><?php echo $row['id']; ?></b></td>
                  <td><?php echo $row2['first_name'].' '.$row2['last_name'].' ('.$row2['email'].')'; ?></td>
                  <td><?php echo $row['message']; ?></td>
                  <td><?php echo $row3['question'].' (#<b>'.$row['q_id'].'</b>)' ?></td>
                  <td>
                    <form action="" method="post">
                    <input type="hidden" name="answer_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this answer?');">Delete</button>
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

<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');
    $raw='active';
    
    if(!isset($_GET['id'])) {
        ?>
<script>
    window.location="../raw_materials";
</script>
<?php
    }
    
    else $id=test_input($_GET['id']);

if($_SERVER['REQUEST_METHOD']=='POST') {
  if(isset($_POST['delete_raw_id'])) {
  $raw_id=test_input($_POST['delete_raw_id']);

  $q="DELETE FROM materials WHERE item='$raw_id'";
  $r=@mysqli_query($dbc,$q);
      
  $q="DELETE FROM raw_materials WHERE id='$raw_id'";
  $r=@mysqli_query($dbc,$q);
  }

  if(isset($_POST['raw_material_name'])) {
    $raw_material_name=test_input($_POST['raw_material_name']);
    $alias=test_input($_POST['alias']);
      $price_basic=test_input($_POST['price_basic']);
      $price_specific=test_input($_POST['price_specific']);
      $total_price=$price_basic+$price_specific;
      $preferred_supplier=test_input($_POST['preferred_supplier']);
      $alternate_supplier=test_input($_POST['alternate_supplier']);
      $category=test_input($_POST['category']);

    if(!empty($raw_material_name)) {
      $q="INSERT INTO raw_materials (name,created_on,alias,price_specific,price_basic,preferred_supplier,alternate_supplier,category_id,total_price) VALUES ('$raw_material_name',NOW(),'$alias','$price_specific','$price_basic','$preferred_supplier','$alternate_supplier','$category','$total_price')";
      $r=@mysqli_query($dbc,$q);

      if($r) {
          $error='<font style="color:green;">Added successfully</font>';
      }
    }
  }
}

$q="SELECT * FROM raw_logs WHERE item='$id' ORDER BY id DESC";
$r=@mysqli_query($dbc,$q);
    $item=$id;
    
    $q2="SELECT * FROM raw_materials WHERE id='$item' LIMIT 1";
    $r2=@mysqli_query($dbc,$q2);
    $row2=@mysqli_fetch_assoc($r2);

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
        "<?php echo $row2['name']; ?>" Price History
        <small><?php echo @mysqli_num_rows($r); ?> changes</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../raw_materials">Raw Materials</a></li>
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
                  <th>#</th>
                  <th>Raw Material</th>
                    <th>Price (Basic)</th>
                    <th>Price (Specific)</th>
                    <th>Total Price</th>
                  <!--<th>Total Items</th>-->
                  <th>On Date</th>
                </tr>
                </thead>
                <tbody>
                    
                    <tr style="color:blue;">
                  <td>0</td>
                  <td><?php echo $row2['name']; ?></td>
                    <td>Rs. <?php echo $row2['price_basic']; ?></td>
                    <td>Rs. <?php echo $row2['price_specific']; ?></td>
                    <td>Rs. <?php echo $row2['total_price']; ?></td>
                  <td><?php echo $row2['created_on'] ?></td>
                </tr>
                    
                  <?php
                  if(@mysqli_num_rows($r)!=0) { $i=0;
                    while($row=@mysqli_fetch_assoc($r)) {
                        $r_id=$row['id'];
                   ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $row2['name']; ?></td>
                    <td>Rs. <?php echo $row['price_basic']; ?></td>
                    <td>Rs. <?php echo $row['price_specific']; ?></td>
                    <td>Rs. <?php echo $row['total_price']; ?></td>
                  <td><?php echo $row['on_date'] ?></td>
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

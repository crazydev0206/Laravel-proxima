<?php $dash='active';
include(app_path()."/admin/common/header.php");
 ?>
  <!-- =============================================== -->

  <style type="text/css">
    .info-box-text {
      text-transform: none !important;
    }
  </style>

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
  <?php
    include(app_path()."/admin/common/left_menu.php");
      ?>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>All stats</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!--<div class="callout callout-info">
        <h4>Tip!</h4>

        <p>Add the fixed class to the body tag to get this layout. The fixed layout is your best option if your sidebar
          is bigger than your content because it prevents extra unwanted scrolling.</p>
      </div>-->
      <!-- Default box -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="<?php echo url('admin/users'); ?>" style="color:inherit;"><div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Drivers</span>
              <span class="info-box-number"><?php
              echo count($driver_count);
              ?></span>
            </div>
            <!-- /.info-box-content -->
          </div></a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
          
          <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="<?php echo url('admin/users'); ?>" style="color:inherit;"><div class="info-box">
            <span class="info-box-icon bg-orange"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Students</span>
              <span class="info-box-number"><?php
              echo count($student_count);
              ?></span>
            </div>
            <!-- /.info-box-content -->
              </div></a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
          
          <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="<?php echo url('admin/users'); ?>" style="color:inherit;">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Passengers</span>
              <span class="info-box-number"><?php
              echo count($passenger_count);
              ?></span>
            </div>
                  </div></a>
        </div>
          
          
          <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="<?php echo url('admin/rides?s=1'); ?>" style="color:inherit;"><div class="info-box">
            <span class="info-box-icon bg-purple"><i class="fa fa-list"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Rides</span>
              <span class="info-box-number"><?php
              echo count($rides_count);
              ?></span>
            </div>
            <!-- /.info-box-content -->
              </div></a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
          
          <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="<?php echo url('admin/reviews'); ?>" style="color:inherit;"><div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-star"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Reviews</span>
              <span class="info-box-number"><?php
              echo count($ratings_count);
              ?></span>
            </div>
            <!-- /.info-box-content -->
              </div></a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
          
      </div>
      <!-- /.row -->
        <!--<div class="row">
            <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Users Signed Up</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="areaChart" style="height:250px"></canvas>
              </div>
            </div>
          </div>
        </div>
            
        </div>-->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
include(app_path()."/admin/common/footer.php");
  ?>

<?php $video_setting='active';
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
        Site Settings
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/site-settings'); ?>">Video Setting</a></li>
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

                    <form method="post" action="">

                    <div class="row">

                      <div class="col-md-12">
                        <?php 

                          if ($type == "success") {
                            // code...
                            ?>
                            <div class="alert alert-success">
                              <?php echo $msg; ?>
                            </div>
                            <?php 
                          }else{

                            echo $type;
                          }

                        ?>
                      </div>

                    <div class="col-md-6">

                        <?php echo csrf_field() ?>
                      
                        <div class="form-group">
                          <label>Select Page</label>
                          <select class="form-control" name="page">
                            <option value="student">For Students</option>
                            <option value="passengers">For Passengers</option>
                            <option value="drivers">For Drivers</option>
                            <option value="introduction">Introduction Video</option>
                             <option value="how-it-works">How it works</option>

                          </select>
                        </div>

                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Select Language</label>
                        <select class="form-control" name="lang">
                            
                            <option value="en">English</option>
                            <option value="fr">French</option>
                            <option value="es">Spanish</option>

                        </select>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <label>Youtube Video Link</label>
                      <input type="text" name="youtube_link" required class="form-control" placeholder="youtube.com/wwatch?v=KNsELLrZ3V0&t=43s">
                    </div>
                    
                    <div class="col-md-12" style="margin-top:20px;" >
                      <button class="btn btn-md btn-primary" type="submit" value="submit" name="submit">Add Youtube Video</button>
                    </div>

                  </div>
                </form>
                    
                  </div>
              
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
<script type="text/javascript" src="<?php echo app_path(); ?>/assets/src/jquery.tokeninput.js"></script>

<link rel="stylesheet" href="<?php echo app_path(); ?>/assets/styles/token-input.css" type="text/css" />
<link rel="stylesheet" href="<?php echo app_path(); ?>/assets/styles/token-input-facebook.css" type="text/css" />
<?php include(app_path().'/admin/common/footer.php');
?>
<script>
    function change_logo_size(){
        var logo_width=$("#logo_width").val();
        var logo_height=$("#logo_height").val();
        
        $("#current_img").css('max-width', logo_width+'px');
        $("#current_img").css('max-height', logo_height+'px');
    }
    
                  $(document).on('click', '.browse', function(){
                    var file = $(this).prev();
                    file.trigger('click');
                  });

      $(document).on('change', '.file', function(e){
                      var o=new FileReader;
                      o.readAsDataURL(e.target.files[0]),o.onloadend=function(o){
                          $("#current_img").attr("src",o.target.result); 
                      }
                    //$(this).prev().text($(this).val().replace(/C:\\fakepath\\/i, ''));
                  });
    
            $(document).on('click', '.browse2', function(){
                    var file = $(this).prev();
                    file.trigger('click');
                  });

      $(document).on('change', '.file2', function(e){
                      var o=new FileReader;
                      o.readAsDataURL(e.target.files[0]),o.onloadend=function(o){
                          $("#current_img2").attr("src",o.target.result); 
                      }
                    //$(this).prev().text($(this).val().replace(/C:\\fakepath\\/i, ''));
                  });
</script>
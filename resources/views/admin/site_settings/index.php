<?php $site_page='active';
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
        <li><a href="<?php echo url('admin/site-settings'); ?>">Site Settings</a></li>
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
              
              
          <form role="form" action="" method="post" enctype="multipart/form-data" style="margin-top:0px;" id="add_new">
              <?php echo csrf_field(); ?>
              <div class="box-body" style="margin-top:15px;">
                  
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group">
                  <label for="inputEmail1" class="col-sm-2 control-label">Booking price <font style="color:red;">*</font></label>

                  <div class="col-sm-5">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                        <input type="number" class="form-control" name="booking_price" value="<?php echo $site->booking_price; ?>" required step="any" min="0">
                    </div>
                  </div>
                      
                      <div class="col-sm-5">
                          <div class="input-group">
                        <input type="number" class="form-control" name="booking_per" value="<?php echo $site->booking_per; ?>" required step="any" min="0">
                        <span class="input-group-addon" style="font-weight:bold;">%</span>
                    </div>
                  </div>
                </div>
                  </div>
                  
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group">
                  <label for="inputEmail1" class="col-sm-2 control-label">Gas cost <font style="color:red;">*</font></label>

                  <div class="col-sm-5">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                        <input type="number" class="form-control" name="gas_cost" value="<?php echo $site->gas_cost; ?>" required step="any" min="0">
                    </div>
                  </div>
                </div>
                  </div>
                  
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group">
                  <label for="inputEmail1" class="col-sm-2 control-label">Keywords</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_keywords" value="<?php echo $site->keywords; ?>" style="max-width:300px;">
                      <small><i>Separate multiple by comma.</i></small>
                  </div>
                </div>
                  </div>
                  
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group" style="margin-bottom:10px;">
                  <label for="inputEmail1" class="col-sm-2 control-label">Description</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_description" value="<?php echo $site->description; ?>" style="max-width:300px;">
                      <small><i>In a few words, explain what this site is about.</i></small>
                  </div>
                </div>
                  </div>
                  
                  <!--<div class="row" style="margin-bottom:25px;">
                  <div class="form-group" style="margin-bottom:10px;">
                  <label for="inputEmail1" class="col-sm-2 control-label">Update Favicon</label>

                  <div class="col-sm-10">
                    <input type="file" class="form-control file2" name="favicon" accept="image/*" style="display:none;">
                      <div class="browse2" style="border:1px solid black; border-radius:6px; padding:5px; max-width:140px; text-align:center; margin-bottom:10px; cursor:pointer;">Choose an Image</div>
                      <img src="<?php //if(!empty($site->favicon)) echo url('images/favicon/'.$site->favicon); else echo url('images/logo.svg'); ?>" id="current_img2" style="max-width:16px;">
                  </div>
                </div>
                  </div>
                  
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group" style="margin-bottom:10px;">
                  <label for="inputEmail1" class="col-sm-2 control-label">Update Logo</label>

                  <div class="col-sm-10">
                      <div style="overflow:hidden;">
                    <input type="file" class="form-control file" name="logo" accept="image/*" style="display:none;">
                      <div class="browse" style="float:left; border:1px solid black; border-radius:6px; padding:5px; width:140px; max-width:140px; text-align:center; margin-bottom:10px; cursor:pointer; margin-right:10px;">Choose an Image</div>
                      <div style="float:left; margin-bottom:10px;"><input type="number" class="form-control" name="logo_width" min="1" step="any" style="max-width:140px; display:inline; border-radius:6px;" value="<?php //if(!empty($site->logo_width)) echo $site->logo_width; else echo '36'; ?>" onkeyup="change_logo_size()" id="logo_width"> <b>X</b> <input type="number" class="form-control" name="logo_height" min="1" step="any" style="max-width:140px; display:inline; border-radius:6px;" value="<?php //if(!empty($site->logo_height)) echo $site->logo_height; else echo '47'; ?>" onkeyup="change_logo_size()" id="logo_height"></div>
                        </div>
                      
                      <img src="<?php //if(!empty($site->logo)) echo url('images/logo/'.$site->logo); else echo url('images/logo.svg'); ?>" id="current_img" style="max-width:<?php //if(!empty($site->logo_width)) echo $site->logo_width; else echo '36'; ?>px; max-height:<?php //if(!empty($site->logo_height)) echo $site->logo_height; else echo '47'; ?>px;">
                  </div>
                </div>
                  </div>-->
                  
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group">
                  <label for="inputEmail1" class="col-sm-2 control-label">Facebook</label>

                  <div class="col-sm-10">
                    <input type="url" class="form-control" name="facebook" value="<?php echo $site->facebook; ?>" style="max-width:300px;">
                  </div>
                </div>
                      </div>
                  
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group">
                  <label for="inputEmail1" class="col-sm-2 control-label">Instagram</label>

                  <div class="col-sm-10">
                    <input type="url" class="form-control" name="instagram" value="<?php echo $site->instagram; ?>" style="max-width:300px;">
                  </div>
                </div>
                      </div>
                  
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group">
                  <label for="inputEmail1" class="col-sm-2 control-label">YouTube</label>

                  <div class="col-sm-10">
                    <input type="url" class="form-control" name="youtube" value="<?php echo $site->youtube; ?>" style="max-width:300px;">
                  </div>
                </div>
                      </div>
                  
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group">
                  <label for="inputEmail1" class="col-sm-2 control-label">Twitter</label>

                  <div class="col-sm-10">
                    <input type="url" class="form-control" name="twitter" value="<?php echo $site->twitter; ?>" style="max-width:300px;">
                  </div>
                </div>
                      </div>
                  
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" style="margin-right:7px;">Save changes</button>
                <!--<a href="<?php echo url(''); ?>" target="_blank"><button type="button" class="btn btn-primary"><i class="fa fa-external-link"></i> &nbsp;Visit Site</button></a>-->
              </div>
              <hr>
          </form>
              
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
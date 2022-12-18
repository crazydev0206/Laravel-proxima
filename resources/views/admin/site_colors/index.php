<?php $colors_page='active'; $left_menu=0;
include(app_path().'/admin/common/header.php'); ?>
<!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo url('assets/admin/plugins/colorpicker/bootstrap-colorpicker.min.css'); ?>">
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
        Site Colors
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/site-colors') ?>">Site Colors</a></li>
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
              <div class="box-body">
                  <h3 style="margin:0px;">Header:</h3><hr>
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group">
                  <label for="inputEmail1" class="col-sm-2 control-label">Background Color <font style="color:red;">*</font></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control my-colorpicker1" name="header_background" required style="max-width:300px;"  id="header_background" value="<?php if(!empty($site->header_background)) echo $site->header_background; else echo '#ffffff'; ?>" onchange="update_header_color()">
                  </div>
                </div>
                      </div>
                  
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group">
                  <label for="inputEmail1" class="col-sm-2 control-label">Menu Color <font style="color:red;">*</font></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control my-colorpicker1" name="header_menu" required value="<?php if(!empty($site->header_menu)) echo $site->header_menu; else echo '#c4c4c4'; ?>" style="max-width:300px;" onchange="update_header_color()" id="header_menu">
                  </div>
                </div>
                  </div>
                  
                  <iframe src="<?php echo url('admin/preview?p=header'); ?>" style="width:100%; padding:0px; margin:0px; border:0px solid black; height:auto; margin-bottom:25px;" id="header_iframe"></iframe>
                  
                  
                  <h3 style="margin:0px;">Page Content:</h3><hr>
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group">
                  <label for="inputEmail1" class="col-sm-2 control-label">Background Color <font style="color:red;">*</font></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control my-colorpicker3" name="page_background" required style="max-width:300px;"  id="page_background" value="<?php if(!empty($site->page_background)) echo $site->page_background; else echo '#ffffff'; ?>" onchange="update_page_color()">
                  </div>
                </div>
                      </div>
                  
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group">
                  <label for="inputEmail1" class="col-sm-2 control-label">Text Color <font style="color:red;">*</font></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control my-colorpicker3" name="page_text" required value="<?php if(!empty($site->page_text)) echo $site->page_text; else echo '#212529'; ?>" style="max-width:300px;" onchange="update_page_color()" id="page_text">
                  </div>
                </div>
                  </div>
                  
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group">
                  <label for="inputEmail1" class="col-sm-2 control-label">Link Color <font style="color:red;">*</font></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control my-colorpicker3" name="page_link" required value="<?php if(!empty($site->page_text)) echo $site->page_text; else echo '#F8993A'; ?>" style="max-width:300px;" onchange="update_page_color()" id="page_link">
                  </div>
                </div>
                  </div>
                  
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group">
                  <label for="inputEmail1" class="col-sm-2 control-label">Wizard Button Color <font style="color:red;">*</font></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control my-colorpicker3" name="page_btn" required value="<?php if(!empty($site->page_btn)) echo $site->page_btn; else echo '#F8993A'; ?>" style="max-width:300px;" onchange="update_page_color()" id="page_btn">
                  </div>
                </div>
                  </div>
                  
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group">
                  <label for="inputEmail1" class="col-sm-2 control-label">Buttons Background <font style="color:red;">*</font></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control my-colorpicker3" name="page_btn_primary" required value="<?php if(!empty($site->page_btn_primary)) echo $site->page_btn_primary; else echo '#F8993A'; ?>" style="max-width:300px;" onchange="update_page_color()" id="page_btn_primary">
                  </div>
                </div>
                  </div>
                  
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group">
                  <label for="inputEmail1" class="col-sm-2 control-label">Buttons Text Color <font style="color:red;">*</font></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control my-colorpicker3" name="page_btn_primary_text" required value="<?php if(!empty($site->page_btn_primary_text)) echo $site->page_btn_primary_text; else echo '#ffffff'; ?>" style="max-width:300px;" onchange="update_page_color()" id="page_btn_primary_text">
                  </div>
                </div>
                  </div>
                  
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group">
                  <label for="inputEmail1" class="col-sm-2 control-label">Input Field Background <font style="color:red;">*</font></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control my-colorpicker3" name="input_background" required value="<?php if(!empty($site->input_background)) echo $site->input_background; else echo '#ffffff'; ?>" style="max-width:300px;" onchange="update_page_color()" id="input_background">
                  </div>
                </div>
                  </div>
                  
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group">
                  <label for="inputEmail1" class="col-sm-2 control-label">Input Field Text <font style="color:red;">*</font></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control my-colorpicker3" name="input_text" required value="<?php if(!empty($site->input_text)) echo $site->input_text; else echo '#495057'; ?>" style="max-width:300px;" onchange="update_page_color()" id="input_text">
                  </div>
                </div>
                  </div>
                  
                  <iframe src="<?php echo url('admin/preview?p=page'); ?>" style="width:100%; padding:0px; margin:0px; border:0px solid black; height:auto; max-height:260px; min-height:240px; margin-bottom:25px;" id="page_iframe"></iframe>
                  
                  
                  <h3 style="margin:0px;">Footer:</h3><hr>
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group">
                  <label for="inputEmail1" class="col-sm-2 control-label">Background Color <font style="color:red;">*</font></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control my-colorpicker" name="footer_background" required style="max-width:300px;"  id="footer_background" value="<?php if(!empty($site->footer_background)) echo $site->footer_background; else echo '#666666'; ?>" onchange="update_footer_color()">
                  </div>
                </div>
                      </div>
                  
                  <div class="row" style="margin-bottom:25px;">
                  <div class="form-group">
                  <label for="inputEmail1" class="col-sm-2 control-label">Text Color <font style="color:red;">*</font></label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control my-colorpicker2" name="footer_text" required value="<?php if(!empty($site->footer_text)) echo $site->footer_text; else echo '#ffffff'; ?>" style="max-width:300px;" onchange="update_footer_color()" id="footer_text">
                  </div>
                </div>
                  </div>
                  
                  <iframe src="<?php echo url('admin/preview?p=footer'); ?>" style="width:100%; padding:0px; margin:0px; border:0px solid black; height:auto; max-height:60px; margin-bottom:25px;" id="footer_iframe"></iframe>
                  
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" style="margin-right:7px;">Save Changes</button>
                <a href="<?php echo url('signup'); ?>" target="_blank"><button type="button" class="btn btn-primary"><i class="fa fa-external-link"></i> &nbsp;Visit Site</button></a>
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
<?php include(app_path().'/admin/common/footer.php');
?>
<!-- bootstrap color picker -->
<script src="<?php echo url('assets/admin/plugins/colorpicker/bootstrap-colorpicker.min.js'); ?>"></script>
<script>
    $(document).on("change" , "#header_background" , function(){
            alert($(this).val());
        });
    
    function update_header_color(){
        var hb=$("#header_background").val();
        hb=hb.replace('#','');
        var hm=$("#header_menu").val();
        hm=hm.replace('#','');
        //alert('d');
        $("#header_iframe").attr('src', '<?php echo url('admin/preview?p=header'); ?>&b='+hb+'&m='+hm);
    }
    
    function update_footer_color(){
        var fb=$("#footer_background").val();
        fb=fb.replace('#','');
        var ft=$("#footer_text").val();
        ft=ft.replace('#','');
        //alert('d');
        $("#footer_iframe").attr('src', '<?php echo url('admin/preview?p=footer'); ?>&b='+fb+'&t='+ft);
    }
    
    function update_page_color(){
        var fb=$("#page_background").val();
        fb=fb.replace('#','');
        var ft=$("#page_text").val();
        ft=ft.replace('#','');
        var pl=$("#page_link").val();
        pl=pl.replace('#','');
        var btn=$("#page_btn").val();
        btn=btn.replace('#','');
        var btn_p=$("#page_btn_primary").val();
        btn_p=btn_p.replace('#','');
        var btn_pt=$("#page_btn_primary_text").val();
        btn_pt=btn_pt.replace('#','');
        var input_b=$("#input_background").val();
        input_b=input_b.replace('#','');
        var input_t=$("#input_text").val();
        input_t=input_t.replace('#','');
        //alert('d');
        $("#page_iframe").attr('src', '<?php echo url('admin/preview?p=page'); ?>&b='+fb+'&t='+ft+'&l='+pl+'&btn='+btn+'&btn_p='+btn_p+'&btn_pt='+btn_pt+'&input_b='+input_b+'&input_t='+input_t);
    }
    
    //Colorpicker
    $(".my-colorpicker1").colorpicker().on('changeColor',
            function(ev) {
                update_header_color();
            });;
    
    $(".my-colorpicker2").colorpicker().on('changeColor',
            function(ev) {
                update_footer_color();
            });;
    
    $(".my-colorpicker3").colorpicker().on('changeColor',
            function(ev) {
                update_page_color();
            });;
    
    update_header_color();
    update_page_color();
    update_footer_color();
    
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

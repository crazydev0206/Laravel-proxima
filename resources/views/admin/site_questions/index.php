<?php $questions_page='active'; $left_menu=0;
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
        Site Questions
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/site-questions') ?>">Site Questions</a></li>
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
                  <h3 style="margin:0px;">Basic:</h3><hr>
                  <div class="row" style="margin-bottom:25px; padding-left:20px; padding-right:20px;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width:60px;"></th>
                                <th style="width:250px;">Field Placeholder</th>
                                <th style="width:120px;">Field Type</th>
                                <th style="width:90px;">Required</th>
                                <th style="width:250px;"></th>
                            </tr>
                        </thead>
                        <tbody id="basic-box">
                            <?php 
                            if(!empty($basic_questions)) { $i=1;
                                foreach($basic_questions as $question) {
                            ?>
                            <tr>
                                <td style="font-weight:bold;">#<?php echo $i++; ?>
                                    <input type="hidden" class="form-control" name="basic_ids[]" value="<?php echo $question->id; ?>"></td>
                                <td><input type="text" class="form-control" name="basic_names[]" value="<?php echo $question->name; ?>" required <?php if($question->default_field=='1') echo 'readonly'; ?> ></td>
                                <td>
                                    <select name="basic_types[]" required class="form-control" <?php if($question->default_field=='1') echo 'readonly'; ?> >
                                        <option value="text" <?php if($question->type=='text') echo 'selected'; ?>>Text</option>
                                        <option value="email" <?php if($question->type=='email') echo 'selected'; ?>>Email</option>
                                        <option value="url" <?php if($question->type=='url') echo 'selected'; ?>>URL</option>
                                        <option value="textarea" <?php if($question->type=='textarea') echo 'selected'; ?>>Textarea</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="basic_required[]" required class="form-control" <?php if($question->default_field=='1') echo 'readonly'; ?> >
                                        <option value="1" <?php if($question->required=='1') echo 'selected'; ?>>Yes</option>
                                        <option value="0" <?php if($question->required=='0') echo 'selected'; ?>>No</option>
                                    </select>
                                </td>
                                <td></td>
                            </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                      
                      <a href="javascript:void(0)" onclick="add_question('Basic')"><i class="fa fa-plus"></i> Add New</a>
                  </div>
                  
                  <script>
                      window.basic_questions=<?php echo count($basic_questions)+1; ?>;
                      function add_question(section)
                      {
                          if(section=='Basic')
                              {
                                  $("#basic-box").append('<tr>\
                                <td style="font-weight:bold;">#'+window.basic_questions+'\
                                    <input type="hidden" class="form-control" name="basic_ids[]" value="0"></td>\
                                <td><input type="text" class="form-control" name="basic_names[]" value="" required></td>\
                                <td>\
                                    <select name="basic_types[]" required class="form-control">\
                                        <option value="text">Text</option>\
                                        <option value="email">Email</option>\
                                        <option value="url">URL</option>\
                                        <option value="textarea">Textarea</option>\
                                    </select>\
                                </td>\
                                <td>\
                                    <select name="basic_required[]" required class="form-control">\
                                        <option value="1">Yes</option>\
                                        <option value="0">No</option>\
                                    </select>\
                                </td>\
                                <td></td>\
                            </tr>');
                                  
                                window.basic_questions+=1;
                              }
                      }
                  </script>
                  
                  
                  <h3 style="margin:0px;">About:</h3><hr>
                  <div class="row" style="margin-bottom:25px;">
                  </div>
                  
                  
                  <h3 style="margin:0px;">Needs:</h3><hr>
                  <div class="row" style="margin-bottom:25px;">
                  </div>
                  
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

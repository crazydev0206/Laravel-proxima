<?php include(app_path().'/common/header.php'); ?>

<link href="<?php echo url('stylesheets/uikit.css'); ?>" rel="stylesheet" />
<link href="<?php echo url('javascripts/libs/flot/flot.css'); ?>" rel="stylesheet" />
<link href="<?php echo url('stylesheets/perfect-scrollbar.css'); ?>" rel="stylesheet" />
<link href="<?php echo url('stylesheets/dashboard.css'); ?>" rel="stylesheet" />
<link href="<?php echo url('stylesheets/wave.css'); ?>" rel="stylesheet" />

<div class='body__content container-fluid'>
    <div class="row">
        <div class="col-12 col-md-12 col-lg -4 col-xl-3">
            <div class="container-fluid flex-grow-1 container-p-y">
                <?php include(app_path().'/common/left_profile.php')?>

            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-8 col-xl-9">
            <div class="container-fluid flex-grow-1 container-p-y">
                <div class="d-flex align-items-center justify-content-between">

                    <div class="text-muted small d-block breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="lnr lnr-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo url('dashboard')?>"><?php echo $title?></a>
                            </li>
                            <?php if(isset($subtitle)):?>
                            <li class="breadcrumb-item active"><?php echo $subtitle?></li>
                            <?php endif?>
                        </ol>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header pb-2">
                        <h5 class="main-heading pull-left">
                            <?php echo trans('profile.verify_driver_license'); ?></h5>
                        <p class="pull-right text-danger mb-0">
                            <font style="color:red;">*</font>
                            <?php echo trans('profile.indicates_required_fields'); ?>
                        </p>
                    </div>
                    <div class="card-body">
                        <form class='rider__sign parsley__form__validate' data-parsley-validate='' action=""
                            method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <p><?php echo trans('profile.verify_driver_license_no'); ?></p>


                            <?php if($user->driver=='2') { ?>
                            <p class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
                                <?php echo trans('forms.license_under_review'); ?></p>
                            <?php } else if($user->driver=='3') { ?>
                            <p class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
                                <?php echo trans('forms.license_rejected'); ?></p>
                            <?php } else if($user->driver=='1') { ?>
                            <p class="alert alert-success"><i class="fa fa-check"></i>
                                <?php echo trans('forms.license_verified'); ?></p>
                            <?php } ?>

                            <div class='form-group'>
                                <?php
                                    $car_image = url('images/drivers_license.png');
                                    if (isset($user->driver_license) and $user->driver_license != '') $car_image = url('driver_license/' . $user->driver_license);
                                    ?>
                                <div>
                                    <label
                                        for='datepicker'><?php if($user->driver_license!='') echo trans('forms.different_copy'); else echo trans('forms.upload_license');  ?>
                                        <font style="color:red;">*</font>
                                    </label>


                                    <div class='img-thumbnail-wrapper'
                                        style="max-width:400px; max-height:400px; width:auto; height:auto;">
                                        <input type="hidden" name="car_file_name" id="img_file"
                                            value="<?php if (isset($user->driver_license) and $user->driver_license != '') echo $user->driver_license; ?>">
                                        <input type="file" name="car_file" class="car_file" style="display:none;"
                                            accept="image/*">
                                        <img src="<?php echo $car_image; ?>" class="img-thumbnail img-fluid car_browse"
                                            style="background:black; cursor:pointer; max-width:100%;" id="car_image" />
                                    </div>

                                </div>

                                <!-- <p id="file_name" style="display:none;"></p>
                                    <input type="file" name="file" class="car_file" style="display:none;">
                                    <div class="car_browse text-center"
                                    style="border:1px solid black; border-radius:3px; max-width:200px; padding:10px; padding-top:5px; padding-bottom:5px; cursor:pointer;">
                                    <?php# echo trans('forms.choose_file'); ?></div> -->
                            </div>



                            <div class='form-group mt-2 <?php echo $user->driver_license ? "d-none" : "";?>'>
                                <button class='btn btn-dark btn-outline btn-outline-default btn-c-transition btn-radius'
                                    id="submit_btn" type='submit'>
                                    <?php echo trans('forms.upload'); ?>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>


<?php include(app_path().'/common/footer.php'); ?>
<script src="<?php echo url('javascripts/libs/parsley.min.js'); ?>"></script>

<script>
$(document).on('click', '.car_browse', function() {
    var file = $(this).prev();
    file.trigger('click');
});

// $(document).on('change', '.car_file', function(e) {
//     /*var o=new FileReader;
//     o.readAsDataURL(e.target.files[0]),o.onloadend=function(o){
//         $("#car_image").attr("src",o.target.result); 
//     }*/
//     $("#file_name").text($(this).val().replace(/C:\\fakepath\\/i, ''));
//     $("#file_name").show();
// });

$(document).on('change', '.car_file', function(e) {
    var o = new FileReader;
    o.readAsDataURL(e.target.files[0]), o.onloadend = function(o) {
        var formData = new FormData();
        var token = '<?php echo csrf_token(); ?>';
        formData.append('_token', token);
        formData.append('file', e.target.files[0]);

        $.ajax({
            url: "<?php echo url('verify-driver') ?>",
            type: "POST",
            data: formData,
            beforeSend: function() { //alert('sending');
                $("#submit_btn").attr('disabled', true);
                // $("#submit_btn").click(()=>{});
            },
            contentType: false,
            processData: false,
            success: function(data) { //alert(data);
                //success
                // here we will handle errors and validation messages

                // console.log(data)

                if (!data.success) {} else {
                    // ALL GOOD! just show the success message!
                    $("#img_file").val(data.name);
                    $(".car_file").val('');


                    var dialog = $.confirm({
                        title: 'Upload successful',
                        content: "Your drivers' license has been uploaded",
                        icon: 'fa fa-check',
                        type: 'green',
                        typeAnimated: true,
                        theme: 'modern',
                        buttons: {

                            somethingElse: {
                                text: 'Close',
                                btnClass: 'btn-green',
                                action: function() {

                                    $("#submit_btn").css('display', 'none');
                                    dialog.close();
                                }
                            }
                        }
                    });
                }
            },
            error: function() {
                //error
            }
        });

        $("#car_image").attr("src", o.target.result);
    }
});
</script>
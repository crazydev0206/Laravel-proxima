<?php include(app_path() . '/common/header.php'); ?>
<style>
    .bg-lightBackground {
        background-color: #0678ce !important;
        color: white;
    }

    .gnhGDU .section-content {
        padding-left: 24px;
        padding-right: 24px;
    }

    .gfgVke {
        position: relative;
        -webkit-box-align: center;
        align-items: center;
        padding: 16px 0px;
        flex: 1 1 0%;
        border-width: 0px;
        border-style: initial;
        border-color: initial;
        border-image: initial;
        background: none;
    }

    .gfgVke .kirk-item-leftAddon {
        margin-right: 16px;
    }

    <style>.gfgVke .kirk-item-leftAddon,
    .gfgVke .kirk-item-rightAddon {
        display: inline-flex;
        min-width: 24px;
        -webkit-box-align: center;
        align-items: center;
    }

    .gfgVke .kirk-item-leftText {
        flex: 1 1 0%;
    }
</style>
<style>
    input[type="text"] {
        border-radius: .25rem;
    }

    .btn-outline-default {
        background: #394d5b;
        color: white;
    }

    ul.sign__up__role li .role-icon {
        border-radius: 0px;
    }

    .parsley__form__validate .parsley-errors-list.filled {
        list-style: none;
        padding: 5px 10px;
        margin-top: 12px;
        background: #1d82d0;
        position: relative;
    }

    .parsley__form__validate .parsley-errors-list.filled:before {
        content: "";
        position: absolute;
        background: #1d82d0;
        width: 9px;
        height: 9px;
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
        top: -5px;
        left: 8px;
    }

    .parsley__form__validate .parsley-errors-list.filled li {
        color: #fff;
    }

    .parsley__form__validate .parsley-errors-list.filled li+li {
        margin-top: 3px;
    }

    .parsley__form__validate .sign__up__role__wrapper .parsley-errors-list.filled {
        margin-top: -19px;
    }

    .login-or span:after,
    .login-or span:before {
        width: calc(50% - 100px);
    }

    ul.social__media__signup li a {
        width: 55px;
        padding-left: 12.5px;
    }
</style>
<div class='body__content'>
    <div class='page__sign__up page__common p-100 pt-5'>
        <div class='container'>
            <div class='row'>
                <div class='col-12 col-md-10 col-lg-8 col-xl-7 mr-auto ml-auto'>
                    <div class='row' style="justify-content:center; align-items:center;">

                        <div class='col-12'>
                            <div style="display: flex; justify-content:center; align-items:center;">
                                <div class="text-center">
                                    <h3 class='f-700 mb-1'><?php echo trans('account.step2of5'); ?></h3>
                                    <p class='text-mute mb-30' style="font-size: 16px; font-weight: 400; color: #2d4653; line-height:1.3rem;"><?php echo trans('account.step2of5_text'); ?></p>
                                    <!-- <p class=" mb-30 text-danger font-weight-bold">(*) Indicates required fields</p> -->

                                </div>
                            </div>
                            <div class="col-md-6 offset-md-3">

                                <?php if (Session::has('success')) { ?>
                                    <p class="alert alert-success"><?php echo Session::get('success'); ?></p>
                                <?php } ?>
                                <?php if (Session::has('error')) { ?>
                                    <p class="alert alert-danger"><?php echo Session::get('error'); ?></p>
                                <?php } ?>

                                <?php if ($user->status == '2') { ?>
                                    <p class="alert alert-success">Your account is under review, you will be notified once it is approved. You can also update the details if required.</p>
                                <?php } ?>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='col-12'></div>
                        </div>
                        <!-- / Normal sign in/up section -->
                        <div class='row'>
                            <div class='col-12'>
                                <form class='rider__sign parsley__form__validate' action="<?= url('step/2/upload_picture') ?>" method="post" onsubmit="return check_data();" enctype="multipart/form-data">

                                    <center>
                                        <?php echo csrf_field(); ?>
                                        <div class='form-group'>

                                            <div class="image__outer mb-3 profile__image--84" style="max-width:150px; max-height:150px; width:auto; height:auto;">
                                                <?php
                                                if ($user->gender == 'Male')
                                                    $img = url('images/3-3-upload-your-photo.png');
                                                else if ($user->gender == 'Female')
                                                    $img = url('images/3-1-upload-your-photo.png');
                                                else
                                                    $img = url('images/3-2-upload-your-photo.png');
                                                if (!empty($user->profile_image)) $img = url('images/profile_images/' . $user->profile_image);
                                                else if (!empty($user->avatar)) $img = $user->avatar;
                                                ?>
                                                <picture>
                                                    <input type="hidden" name="file_name" id="img_file" value="<?php echo $user->profile_image; ?>">

                                                    <input type="hidden" name="avatar" value="<?php echo $user->avatar; ?>">

                                                    <input type="file" name="file" class="car_file" style="display:none;" accept="image/*">

                                                    <img src="<?php echo $img; ?>" class="car_browse" alt="User simple" style="width:100%; min-height:150px; max-height:150px; cursor:pointer; border-radius:50%; object-fit:fill;" id="car_image">
                                                </picture>

                                                <div class="profile__upload__options car_browse">
                                                    <div class="upload__tool d-none">
                                                        <div class="upload__icon">
                                                            <span class="fa fa-camera"></span>
                                                        </div>
                                                        <div class="upload__text">
                                                            <span>
                                                                + Add picture
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mb-4 text-center" style="overflow:hidden;">
                                                <p><?php echo trans('account.images_allowed'); ?></p>
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#why-needed"><?php echo trans('account.why_photo_needed'); ?></a>
                                            </div>
                                        </div>

                                        <p class="alert alert-danger" style="display:none;">Error</p>
                                    </center>

                                    <div class='form-group'>
                                        <!-- / reCaptch -->
                                    </div>
                                    <div class='form-group text-center'>
                                        <center>
                                            <p class="alert alert-danger" style="display:none; max-width:250px;" id="error"></p>
                                        </center>
                                        <button id="skipStep3" class='btn btn-outline btn-outline-default btn-c-transition btn-radius' type='button'>
                                            <?php echo trans('account.skip'); ?>
                                        </button>
                                        <button class='btn btn-outline btn-outline-default btn-c-transition btn-radius' type='submit' id="submit_btn">
                                            <?php echo trans('account.next'); ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php include(app_path() . '/common/footer.php'); ?>

    <div class="modal fade" id="why-needed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post" id="completed-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="0" id="completed_ride_field">
                    <div class="modal-header" style="background: #F9FAFF; padding: 18px 45px 18px 34px; padding-right:20px;">

                        <div style="overflow:hidden;">
                            <div class="pull-left">
                                <h3 class="modal-title">Why is my photo needed?</h3>
                            </div>
                        </div>

                    </div>
                    <div class="modal-body" style="padding: 18px 45px 18px 34px; padding-top:0px; padding-left:20px; padding-right:20px;">
                        <p class="alert alert-success" id="booking_success" style="display:none;"></p>
                        <div id="ember953" class="liquid-container ember-view" style="">
                            <div id="ember956" class="liquid-child ember-view" style="top: 0px; left: 0px;">
                                <div id="ember957" class="ember-view">
                                    <div class="scroll-x scroll-y scrollbox split-view-content ind-split-view-content download-payslip-footer-margin">
                                        <ul class="mt-4 text-justify">
                                            <li>ProximaRide is all about your safety. Since you have never met the people you are travelling with, you all will feel reassured when you can see each other. And, it will help drivers and passengers find each other at the meeting place</li>
                                            <li>Passengers are more likely to book in a ride with a driver that they can see</li>
                                            <li>Drivers are more likely to approve passengers they can see</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer text-center" style="padding: 18px 30px 18px 17px; padding-left:20px; padding-right:20px;">
                        <button type="button" class="btn btn-primary ml-auto mr-auto" data-dismiss="modal">Got it</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script src="<?php echo url('javascripts/libs/parsley.min.js'); ?>"></script>
    <script>
        $(document).on('click', '.car_browse', function() {
            $("#error").hide();
            var file = $('.car_file');
            file.trigger('click');
        });

        $(document).on('change', '.car_file', function(e) {
            var o = new FileReader;
            var fileType = e.target.files[0]['type'];

            var validImageTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/jpg', 'image/svg'];
            if (!validImageTypes.includes(fileType)) {
                $("#error").text('Please upload a valid file.');
                $("#error").show();
                $(".car_file").val('');
            } else {
                var flag = 1;
                var totalBytes = e.target.files[0].size;
                if (totalBytes < 1000000) {
                    // + 'KB'
                    var _size = Math.floor(totalBytes / 1000);
                } else {
                    // + 'MB'
                    var _size = Math.floor(totalBytes / 1000000);
                    if (parseInt(_size) > 5) flag = 0;
                }

                console.log(_size);

                if (flag == 1) {
                    var formData = new FormData();
                    var token = '<?php echo csrf_token(); ?>';
                    formData.append('_token', token);
                    formData.append('file', e.target.files[0]);

                    $.ajax({
                        url: "<?php echo url('upload-profile-image') ?>",
                        type: "POST",
                        data: formData,
                        beforeSend: function() { //alert('sending');
                            $("#submit_btn").attr('disabled', true);
                        },
                        contentType: false,
                        processData: false,
                        success: function(data) { //alert(data);
                            $("#submit_btn").attr('disabled', false);
                            //success
                            // here we will handle errors and validation messages
                            if (!data.success) {} else {
                                // ALL GOOD! just show the success message!
                                $("#img_file").val(data.name);
                                $(".car_file").val('');
                            }
                        },
                        error: function() {
                            //error
                        }
                    });

                    o.readAsDataURL(e.target.files[0]), o.onloadend = function(o) {
                        $("#car_image").attr("src", o.target.result);
                        $("#boxx").click();
                    }
                } else {

                    var dialog = $.confirm({
                        title: 'Image upload error',
                        content: 'Image must be less than 5 MB',
                        icon: 'fa fa-exclamation-circle',
                        type: 'red',
                        typeAnimated: true,
                        theme: 'modern',
                        buttons: {

                            somethingElse: {
                                text: 'Close',
                                btnClass: 'btn-red',
                                action: function() {

                                    dialog.close();
                                }
                            }
                        }
                    });

                    // $("#error").text('Image must be less than 5 MB.');
                    // $("#error").show();
                    
                    $(".car_file").val('');


                }
            }
            //$(this).prev().text($(this).val().replace(/C:\\fakepath\\/i, ''));
        });

        function show_form(type) {
            $("#form-box").empty();

            if (type == 'Driver') {
                $("#form-box").append('<div class="form-group">\
    <label>Driver License</label>\
<input class="form-control" name="driver_license" required type="file">\
</div>');
            }

            if (type == 'Student') {
                $("#form-box").append('<div class="form-group">\
    <label>Student Card<font style="color:red;">*</font></label>\
<input class="form-control" name="student_card" type="file" required>\
</div>\
<div class="row">\
<div class="col-12 col-md-12">\
<div class="form-group">\
    <label>School Name<font style="color:red;">*</font></label>\
<input class="form-control" name="school_name" required type="text">\
</div>\
</div>\
</div>');
            }
        }

        function check_data() {
            var file = $('#img_file').val();
            <?php if (!empty($user->avatar)) { ?>
                file = 'abcd';
            <?php } ?>
            $("#error").hide();

            if (file == '') {
                $("#error").text('Please select a photo first.');
                $("#error").show();
                return false;
            } else {
                $("#error").hide();
                return true;
            }
        }
    </script>



    <script type="text/javascript">
        $("#skipStep3").click(function() {

            var url = '<?= url('/step/3'); ?>'

            location.href = url;

            var apiurl = '<?= url('/api/step_two_skip'); ?>';

            var token = '<?php echo csrf_token(); ?>';

            $.post(apiurl, {
                "_token": token
            }, function() {

                location.href = '<?= url('step/3'); ?>';



            });

        });
    </script>
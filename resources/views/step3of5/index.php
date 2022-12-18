<?php include(app_path() . '/common/header.php'); ?>
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
                        <div style="display: flex; justify-content:center; align-items:center;">
                            <div class="text-center">
                                <h3 class='f-700 mb-1'><?php echo trans('account.step3of5'); ?></h3>
                                <!-- <p class="text-danger font-weight-bold">(*) Indicates required fields</p> -->
                                <p class='mb-30' style="font-size: 16px; font-weight: 400; color: #2d4653; line-height:1.3rem;"><?php echo trans('account.step3of5_text'); ?></p>
                            </div>
                        </div>
                        <div class='col-12'>
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


                                <form class='rider__sign parsley__form__validate' action="<?= url('/api/submit_third_form') ?>" method="post" enctype="multipart/form-data" id="car__form">

                                    <?php echo csrf_field(); ?>

                                    <div class="row">
                                        <div class="col-8">
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <input class='form-control form-group-border' placeholder='<?php echo trans('account.model'); ?>' type='text' name="model" required value="<?php if (isset($vehicle->model)) echo $vehicle->model; ?>" id="car__model">
                                                </div>

                                                <div class="col-6 mb-3">
                                                    <div class='form-group'>
                                                        <select class='form-control form-group-border' name="type" required id="car__type">
                                                            <option value=''><?php echo trans('account.type'); ?></option>
                                                            <option value="Convertible" <?php if (isset($vehicle->type) and $vehicle->type == 'Convertible') echo 'selected'; ?>>Convertible</option>
                                                            <option value="Coupe" <?php if (isset($vehicle->type) and $vehicle->type == 'Coupe') echo 'selected'; ?>>Coupe</option>
                                                            <option value="Hatchback" <?php if (isset($vehicle->type) and $vehicle->type == 'Hatchback') echo 'selected'; ?>>Hatchback</option>
                                                            <option value="Minivan" <?php if (isset($vehicle->type) and $vehicle->type == 'Minivan') echo 'selected'; ?>>Minivan</option>
                                                            <option value="Sedan" <?php if (isset($vehicle->type) and $vehicle->type == 'Sedan') echo 'selected'; ?>>Sedan</option>
                                                            <option value="Station Wagon" <?php if (isset($vehicle->type) and $vehicle->type == 'Station Wagon') echo 'selected'; ?>>Station Wagon</option>
                                                            <option value="SUV" <?php if (isset($vehicle->type) and $vehicle->type == 'SUV') echo 'selected'; ?>>SUV</option>
                                                            <option value="Truck" <?php if (isset($vehicle->type) and $vehicle->type == 'Truck') echo 'selected'; ?>>Truck</option>
                                                            <option value="Van" <?php if (isset($vehicle->type) and $vehicle->type == 'Van') echo 'selected'; ?>>Van</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-6 mb-3">
                                                    <div class='form-group'>
                                                        <input class='form-control form-group-border' placeholder='License Plate number' id="license_no" name="license_no" required value="<?php if (isset($vehicle->license_no)) echo $vehicle->license_no; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-6 mb-2">
                                                    <div class='form-group'>
                                                        <input class='form-control form-group-border' placeholder='<?php echo trans('account.color'); ?>' name="color" id="car_color" required value="<?php if (isset($vehicle->color)) echo $vehicle->color; ?>">
                                                    </div>

                                                </div>
                                                <div class="col-6 mb-2">
                                                    <div class='form-group'>
                                                        <select class='form-control form-group-border' name="year" required id="car__year">
                                                            <option value=''><?php echo trans('account.year'); ?></option>
                                                            <?php for ($i = 2050; $i >= 1990; $i--) { ?>
                                                                <option value='<?php echo $i; ?>' <?php if (isset($vehicle->year) and $vehicle->year == $i) echo 'selected'; ?>>
                                                                    <?php echo $i; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <?php
                                            $car_image = url('images/4-upload-car-photo.png');
                                            if (isset($vehicle->image) and $vehicle->image != '') $car_image = url('car_images/' . $vehicle->image);
                                            ?>
                                            <div>
                                                <!-- <center> -->
                                                <div class='img-thumbnail-wrapper' style="max-width:250px; max-height:250px; width:auto; height:auto;">
                                                    <input type="hidden" name="car_file_name" id="img_file" value="<?php if (isset($vehicle->image) and $vehicle->image != '') echo $vehicle->image; ?>">
                                                    <input type="file" name="car_file" class="car_file" style="display:none;" accept="image/*">
                                                    <img src="<?php echo $car_image; ?>" class="img-thumbnail img-fluid car_browse" alt="Bentley continental gt red wallpaper" style="background:black; cursor:pointer; max-width:100%;" id="car_image" />
                                                </div>

                                                <div class="col-12 mb-4 mt-2 text-center" style="overflow:hidden;">
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#why-needed"><?php echo trans('account.why_car_photo_needed'); ?></a>
                                                </div>
                                                <!-- </center> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class='form-group'>
                                        <!-- / reCaptch -->
                                    </div>



                                    <div class="alert alert-danger" id="error" style="display:none;">
                                        Error
                                    </div>

                                    <div class='form-group text-center'>
                                        <p class="alert alert-danger" style="display:none;" id="error"></p>
                                        <a href="<?php echo url('/api/user/skip_third_function'); ?>"><button class='btn btn-outline btn-outline-default btn-c-transition btn-radius' type='button'>
                                                <?php echo trans('account.skip'); ?>
                                            </button></a>
                                        <button class='btn btn-outline btn-outline-default btn-c-transition btn-radius' type='button' id="submit_btn">
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
                    <div class="modal-header" style="background: #F9FAFF; padding: 18px 45px 18px 34px; padding-left:20px; padding-right:20px;">

                        <div style="overflow:hidden;">
                            <div class="pull-left">
                                <h3 class="modal-title"><?php echo trans('account.why_car_photo_needed'); ?></h3>
                            </div>
                        </div>

                    </div>
                    <div class="modal-body" style="padding: 18px 45px 18px 34px; padding-top:0px; padding-left:0px; padding-right:20px;">
                        <p class="alert alert-success" id="booking_success" style="display:none;"></p>
                        <div id="ember953" class="liquid-container ember-view" style="">
                            <div id="ember956" class="liquid-child ember-view" style="top: 0px; left: 0px;">
                                <div id="ember957" class="ember-view">
                                    <div class="scroll-x scroll-y scrollbox split-view-content ind-split-view-content download-payslip-footer-margin">
                                        <?php echo trans('account.why_car_photo_needed_text'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer text-center" style="padding: 18px 30px 18px 17px; padding-left:20px; padding-right:20px;">
                        <button type="button" class="btn btn-primary ml-auto mr-auto" data-dismiss="modal"><?php echo trans('account.got_it'); ?></button>
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
            var file = $(this).prev();
            file.trigger('click');
        });

        $(document).on('change', '.car_file', function(e) {
            var o = new FileReader;
            o.readAsDataURL(e.target.files[0]), o.onloadend = function(o) {
                var formData = new FormData();
                var token = '<?php echo csrf_token(); ?>';
                formData.append('_token', token);
                formData.append('file', e.target.files[0]);

                $.ajax({
                    url: "<?php echo url('upload-car-image') ?>",
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

                $("#car_image").attr("src", o.target.result);
            }
            //$(this).prev().text($(this).val().replace(/C:\\fakepath\\/i, ''));
        });
    </script>


    <script type="text/javascript">
        $("#submit_btn").click(function() {


            var carmodel = $("#car__model").val();
            var cartype = $("#car__type").val();
            var license_no = $("#license_no").val();
            var carColor = $("#car_color").val();
            var year = $("#car__year").val();

            if (carmodel == "") {
                showErrorDialog('Please enter your car model', $("#car__model").addClass('border border-danger'));
                // error("Please enter your car model");
            } else if (cartype === "") {

                showErrorDialog("Please select your car type", $("#car__type").addClass('border border-danger') );
                $("#car__model").removeClass('border border-danger')
                // error("Please select your car type");

            } else if (license_no == "") {

                showErrorDialog("Please enter your license number", $("#license_no").addClass('border border-danger'));
                $("#car__type").removeClass('border border-danger');
                // error("Please enter your license number");

            } else if (carColor == "") {
                showErrorDialog("Please add your car color", $("#car_color").addClass('border border-danger'));
                $("#license_no").removeClass('border border-danger')
                // error("Please add your car color");
            } else if (year == "") {
                showErrorDialog("Please add your car year", $("#car__year").addClass('border border-danger'));
                $("#car_color").removeClass('border border-danger')
            
                // error("Please add your car year");
            } else {

                $("#car__form").submit();

            }

        });
    </script>

    <script type="text/javascript">
        function error(msg) {
            $("#error").show();
            $("#error").html(msg);
        }
    </script>
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
                    <div class="card-body">

                        <form class='rider__sign parsley__form__validate' data-parsley-validate='' action=""
                            method="post" enctype="multipart/form-data" id="form">
                            <?php echo csrf_field(); ?>
                            <!-- / Personal Information -->
                            <!--<h5 class='f-500 mb-2'>Basic Details:</h5>-->
                            <div style="display:flex; justify-content: space-between; align-item:center; ">
                                <h5><?php echo ucfirst(trans('profile.vehicle'))?></h5>
                                <span style="color:red;font-size: 14px;">(*) Indicates required
                                    fields</span>

                            </div>
                            
                            <hr class="mt-0 mb-4">

                            <?php if(Session::has('success')) { ?>
                            <p class="alert2 alert alert-success"><?php echo Session::get('success'); ?>
                            </p>
                            <?php } ?>
                            <?php if(Session::has('error')) { ?>
                            <p class="alert2 alert alert-danger"><?php echo Session::get('error'); ?>
                            </p>
                            <?php } ?>

                            <div class="row mb-4 pb-5">
                                <div class="col-12 col-md-12 col-xl-8">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <div class='form-group'>
                                                <label for='profile-about-me'><?php echo trans('forms.model'); ?> <font
                                                        style="color:red;">*</font></label>
                                                <input class='form-control form-group-border'
                                                    placeholder='Model (e.g. “Toyota Sienna” or “Dodge Grand Caravan”)'
                                                    type='text' name="model" required
                                                    value="<?php if(isset($vehicle->model)) echo $vehicle->model; ?>"
                                                    id="model">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class='form-group'>
                                                <label for='profile-about-me'><?php echo trans('forms.type'); ?> <font
                                                        style="color:red;">*</font></label>
                                                <select class='form-control form-group-border' name="type" required
                                                    id="type">
                                                    <option value=''></option>
                                                    <option value="Convertible"
                                                        <?php if(isset($vehicle->type) AND $vehicle->type=='Convertible') echo 'selected'; ?>>
                                                        Convertible</option>
                                                    <option value="Coupe"
                                                        <?php if(isset($vehicle->type) AND $vehicle->type=='Coupe') echo 'selected'; ?>>
                                                        Coupe</option>
                                                    <option value="Hatchback"
                                                        <?php if(isset($vehicle->type) AND $vehicle->type=='Hatchback') echo 'selected'; ?>>
                                                        Hatchback</option>
                                                    <option value="Minivan"
                                                        <?php if(isset($vehicle->type) AND $vehicle->type=='Minivan') echo 'selected'; ?>>
                                                        Minivan</option>
                                                    <option value="Sedan"
                                                        <?php if(isset($vehicle->type) AND $vehicle->type=='Sedan') echo 'selected'; ?>>
                                                        Sedan</option>
                                                    <option value="Station Wagon"
                                                        <?php if(isset($vehicle->type) AND $vehicle->type=='Station Wagon') echo 'selected'; ?>>
                                                        Station Wagon</option>
                                                    <option value="SUV"
                                                        <?php if(isset($vehicle->type) AND $vehicle->type=='SUV') echo 'selected'; ?>>
                                                        SUV</option>
                                                    <option value="Truck"
                                                        <?php if(isset($vehicle->type) AND $vehicle->type=='Truck') echo 'selected'; ?>>
                                                        Truck</option>
                                                    <option value="Van"
                                                        <?php if(isset($vehicle->type) AND $vehicle->type=='Van') echo 'selected'; ?>>
                                                        Van</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class='form-group'>
                                                <label
                                                    for='profile-about-me'><?php echo trans('forms.license_plate_number'); ?>
                                                    <font style="color:red;">*</font>
                                                </label>
                                                <input class='form-control form-group-border'
                                                    placeholder='License plate number' name="license_no" required
                                                    value="<?php if(isset($vehicle->license_no)) echo $vehicle->license_no; ?>"
                                                    id="liscense_no">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class='form-group'>
                                                <label for='profile-about-me'><?php echo trans('forms.color'); ?> <font
                                                        style="color:red;">*</font></label>
                                                <input class='form-control form-group-border' placeholder='Color'
                                                    name="color" id="color" required
                                                    value="<?php if(isset($vehicle->color)) echo $vehicle->color; ?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class='form-group'>
                                                <label for='profile-about-me'><?php echo trans('forms.year'); ?> <font
                                                        style="color:red;">*</font></label>
                                                <select class='form-control form-group-border' name="year" id="year">
                                                    <option value=''>Year</option>
                                                    <?php for($i=2050; $i>=1990; $i--) { ?>
                                                    <option value='<?php echo $i; ?>'
                                                        <?php if(isset($vehicle->year) AND $vehicle->year==$i) echo 'selected'; ?>>
                                                        <?php echo $i; ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-xl-4">
                                    <div class="form-group">
                                        <?php 
                                                    $car_image=url('images/4-upload-car-photo.png');
                                                    if(isset($vehicle->image) AND $vehicle->image!='') $car_image=url('car_images/'.$vehicle->image);
                                                ?>
                                        <input type="hidden" name="car_file_name" id="img_file"
                                            value="<?php if(isset($vehicle->image)) echo $vehicle->image; ?>">
                                        <div class='img-thumbnail-wrapper' style="width:100%;height:40vh;">

                                            <input type="file" name="car_file" class="car_file" style="display:none;"
                                                accept="image/*">
                                            <img src="<?php echo $car_image; ?>" width="400" height="250"
                                                class="img-thumbnail img-fluid car_browse"
                                                alt="Bentley continental gt red wallpaper"
                                                style="background:black; cursor:pointer; width:300px; height:100%;"
                                                id="car_image" />

                                            <p class="text-center mb-1 mt-3 w-100" style="font-weight:bold;">
                                                <?php if(isset($vehicle->image) AND $vehicle->image!='') echo trans('forms.this_your_car'); else echo ''; ?>
                                            </p>
                                            <?php if(isset($vehicle->image) AND $vehicle->image!='') { ?>
                                            <p class="mb-2 text-center" style="color:red;"><a href="javascript:void(0)"
                                                    style="color:inherit;"
                                                    onclick="$('#car_image').attr('src', '<?php echo url('images/4-upload-car-photo.png'); ?>'); $('#remove').val('1'); $(this).text('Photo has been removed. Click save below to save the changes.')"><?php echo trans('forms.remove_car'); ?></a>
                                            </p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-12">
                                    <div class='form-group mt-3 text-center'>
                                        <input type="hidden" name="remove" value="0" id="remove">
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                    <button class='btn btn-outline btn-outline-default btn-radius btn-dark mt-4'
                                        type='button' id="submit_btn">
                                        <?php echo trans('forms.save'); ?>
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
<script src="<?php echo url('plugins/perfect-scrollbar.js'); ?>" type="text/javascript"></script>



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

$(document).ready(function() {

    $('#datepicker2').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd-mm-yyyy'
    });
});
</script>

<script type="text/javascript">
$("#submit_btn").click(function() {

    var model = $("#model").val();
    var type = $("#type").val();
    var color = $("#color").val();
    var liscense_no = $("#liscense_no").val();
    var year = $("#year").val();

    if (model == "") {
        showErrorDialog('Please enter your car model', $("#model").addClass('border border-danger'));
        // error("Please enter your car model");
    } else if (type === "") {

        showErrorDialog("Please select your car type", $("#type").addClass('border border-danger'));
        $("#model").removeClass('border border-danger')
        // error("Please select your car type");

    } else if (liscense_no == "") {

        showErrorDialog("Please enter your license number", $("#liscense_no").addClass('border border-danger'));
        $("#type").removeClass('border border-danger');
        // error("Please enter your license number");

    } else if (color == "") {
        showErrorDialog("Please add your car color", $("#color").addClass('border border-danger'));
        $("#license_no").removeClass('border border-danger')
        // error("Please add your car color");
    } else if (year == "") {
        showErrorDialog("Please add your car year", $("#year").addClass('border border-danger'));
        $("#car_color").removeClass('border border-danger')

        // error("Please add your car year");
    } else {

        $("#form").submit();

    }


});

function error(msg) {
    $("#error").show();
    $("#error").html(msg);
}
</script>
<?php include(app_path() . '/common/header.php'); ?>
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
                        <form action="" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <!-- / Personal Information -->
                            <!--<h5 class='f-500 mb-2'>Basic Details:</h5>-->
                            <div style="display:flex; justify-content: space-between; align-item:center; ">
                                <h5><?php echo ucfirst(trans('profile.photo'))?></h5>
                                <span style="color:red;font-size: 14px;">(*) Indicates required
                                    fields</span>

                            </div>
                        
                            <hr class="mt-0 mb-1">
                            <p><?php echo trans('forms.click_photo_edit'); ?></p>

                            <?php if(Session::has('success')) { ?>
                            <p class="alert2 alert alert-success"><?php echo Session::get('success'); ?></p>
                            <?php } ?>
                            <?php if(Session::has('error')) { ?>
                            <p class="alert2 alert alert-danger"><?php echo Session::get('error'); ?></p>
                            <?php } ?>

                            <div class='form-group'>
                                <div class="image__outer mb-3 profile__image--84"
                                    style="max-width:150px; max-height:150px; width:auto; height:auto;">
                                    <?php 
                                                    if($user->gender=='Male')
                                                    $img=url('images/3-3-upload-your-photo.png');
                                                    else if($user->gender=='Female')
                                                    $img=url('images/3-1-upload-your-photo.png');
                                                    else
                                                    $img=url('images/3-2-upload-your-photo.png');
                                                    if(!empty($user->profile_image)) $img=url('images/profile_images/'.$user->profile_image);
                                                    else if(!empty($user->avatar)) $img=$user->avatar;
                                                    ?>
                                    <picture>
                                        <input type="hidden" name="file_name" id="img_file"
                                            value="<?php echo $user->profile_image; ?>">
                                        <input type="file" name="file" class="car_file" style="display:none;"
                                            accept="image/*">
                                        <img src="<?php echo $img; ?>" class="" alt="User simple"
                                            style="width:100%; min-height:150px; max-height:150px; cursor:pointer; border-radius:50%; object-fit:fill;"
                                            id="car_image">
                                    </picture>
                                    <div class="profile__upload__options car_browse">
                                        <div class="upload__tool d-none">
                                            <!-- <center> -->
                                                <div class="upload__icon">
                                                    <span class="fa fa-camera"></span>
                                                </div>
                                                <div class="upload__text">
                                                    <span>
                                                        + Update picture
                                                    </span>
                                                </div>
                                            <!-- </center> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- / End Personal Information -->
                            <div class='form-group mt-3'>
                                <p><?php echo trans('forms.image_formats_allowed'); ?></p>
                                <p class="alert alert-danger" id="error" style="display:none; max-width:300px;"></p>
                                <button class='btn btn-outline btn-outline-default btn-radius' type='submit'
                                    id="submit_btn">
                                    <?php echo trans('forms.save'); ?>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div <div class='body__content'>
<div class='profile__page page__common p-60 with-b-top'>
    <div class='container'>
        <div class='row'>
            <div class='col-12'>
                ]
                <div class='page__content__body'>
                    <div class='row'>
                        <div class='col-12 col-md-4 col-lg-3'>
                            <?php include(app_path().'/common/left_profile.php'); ?>
                        </div>
                        <div class='col-12 col-md-8 col-lg-9'>

                            <div class='tab-content' id='profile-form-content'>

                                <div aria-labelledby='profile-tab'
                                    class="tab-pane fade <?php if(!isset($_GET['t']) OR $_GET['t']=='profile') echo 'show active'; ?>"
                                    id='profile' role='tabpanel'>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <!-- / Personal Information -->
                                        <!--<h5 class='f-500 mb-2'>Basic Details:</h5>-->
                                        <h5 class="main-heading"><?php echo trans('profile.photo'); ?></h5>
                                        <hr class="mt-0 mb-1">
                                        <p><?php echo trans('forms.click_photo_edit'); ?></p>

                                        <?php if(Session::has('success')) { ?>
                                        <p class="alert2 alert alert-success"><?php echo Session::get('success'); ?></p>
                                        <?php } ?>
                                        <?php if(Session::has('error')) { ?>
                                        <p class="alert2 alert alert-danger"><?php echo Session::get('error'); ?></p>
                                        <?php } ?>

                                        <div class='form-group'>
                                            <div class="image__outer mb-3 profile__image--84"
                                                style="max-width:150px; max-height:150px; width:auto; height:auto;">
                                                <?php 
                                                    if($user->gender=='Male')
                                                    $img=url('images/3-3-upload-your-photo.png');
                                                    else if($user->gender=='Female')
                                                    $img=url('images/3-1-upload-your-photo.png');
                                                    else
                                                    $img=url('images/3-2-upload-your-photo.png');
                                                    if(!empty($user->profile_image)) $img=url('images/profile_images/'.$user->profile_image);
                                                    else if(!empty($user->avatar)) $img=$user->avatar;
                                                    ?>
                                                <picture>
                                                    <input type="hidden" name="file_name" id="img_file"
                                                        value="<?php echo $user->profile_image; ?>">
                                                    <input type="file" name="file" class="car_file"
                                                        style="display:none;" accept="image/*">
                                                    <img src="<?php echo $img; ?>" class="" alt="User simple"
                                                        style="width:100%; min-height:150px; max-height:150px; cursor:pointer; border-radius:50%; object-fit:fill;"
                                                        id="car_image">
                                                </picture>
                                                <div class="profile__upload__options car_browse">
                                                    <div class="upload__tool d-none">
                                                        <center>
                                                            <div class="upload__icon">
                                                                <span class="fa fa-camera"></span>
                                                            </div>
                                                            <div class="upload__text">
                                                                <span>
                                                                    + Update picture
                                                                </span>
                                                            </div>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- / End Personal Information -->
                                        <div class='form-group mt-3'>
                                            <p><?php echo trans('forms.image_formats_allowed'); ?></p>
                                            <p class="alert alert-danger" id="error"
                                                style="display:none; max-width:300px;"></p>
                                            <button class='btn btn-outline btn-outline-default btn-radius' type='submit'
                                                id="submit_btn">
                                                <?php echo trans('forms.save'); ?>
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div aria-labelledby='payments-tab'
                                    class="tab-pane fade <?php if(isset($_GET['t']) AND $_GET['t']=='payments') echo 'show active'; ?>"
                                    id='payments' role='tabpanel'>
                                    <?php if(!empty($cards)) { ?>
                                    <h5 class="mb-2">My Cards:</h5>

                                    <?php foreach($cards as $card) { ?>
                                    <div class="col-6 col-md-4 p-0">
                                        <div class='card__top mb-4 p-3'>
                                            <h6 class='title' style="color: #1fb9f6 !important;">
                                                XXXX-XXXX-XXXX-<?php echo $card->last4; ?>
                                            </h6>
                                            <h5 class='sub-title'>
                                                Valid through <?php echo $card->exp_month.'/'.$card->exp_year; ?> -
                                                <?php echo $card->brand; ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php } ?>

                                    <h5 class="mb-2">Add a Card:</h5>

                                    <div class='card__box card' style="max-width:500px;">
                                        <div class='card-body p-0'>
                                            <form action="" method="post" enctype="multipart/form-data"
                                                id="payment-form">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="add_card" value="1">
                                                <div id="card-element">
                                                    <!-- a Stripe Element will be inserted here. -->
                                                </div>
                                                <div class="alert alert-danger mt-2" id="card-errors" role="alert"
                                                    style="display:none;"></div>
                                                <div class="form-group mt-3">
                                                    <button class='btn btn-outline btn-outline-default btn-radius'
                                                        type='submit' id="payment-submit">
                                                        Add
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <div aria-labelledby='security-tab'
                                    class="tab-pane fade <?php if(isset($_GET['t']) AND $_GET['t']=='security') echo 'show active'; ?>"
                                    id='security' role='tabpanel'>
                                    <?php if($user->verify!='1') { ?>
                                    <p class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Your email
                                        is not verified. Please follow the link in the confirmation email to verify
                                        <b><?php echo $user->email; ?></b>
                                    </p>

                                    <button class='btn btn-outline btn-outline-default btn-radius mb-4' type='button'>
                                        Resend Email
                                    </button>
                                    <?php } ?>

                                    <?php if($user->status!='1') { ?>

                                    <?php if($user->type=='Driver') { ?>
                                    <?php if($user->status=='0') { ?>
                                    <p class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Your
                                        account is not verified. Please provide your driving license to get your account
                                        verified and unlock all our premium features.</p>
                                    <?php } ?>
                                    <?php if($user->status=='2') { ?>
                                    <p class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Your
                                        account is under review. You can update the information provided following the
                                        verification button below if needed.</p>
                                    <?php } ?>
                                    <?php } ?>

                                    <?php if($user->type=='Student') { ?>
                                    <?php if($user->status=='0') { ?>
                                    <p class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Your
                                        account is not verified. Please provide your student card to get your account
                                        verified and unlock all our premium features.</p>
                                    <?php } ?>
                                    <?php if($user->status=='2') { ?>
                                    <p class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Your
                                        account is under review. You can update the information provided following the
                                        verification button below if needed.</p>
                                    <?php } ?>
                                    <?php } ?>

                                    <a href="<?php echo url('complete-signup'); ?>"><button
                                            class='btn btn-outline btn-outline-default btn-radius mb-3' type='button'>
                                            Verification Form
                                        </button></a>
                                    <?php } ?>

                                    <?php if($user->pass!='') { ?>
                                    <form action="" method="post">
                                        <?php echo csrf_field(); ?>
                                        <div class='row mt-3'>
                                            <div class='col-12 col-md-12'>
                                                <h5 class="mb-0 mb-2">Change Password:</h5>
                                                <div class='row'>
                                                    <div class='col-12 col-md-4'>
                                                        <div class='form-group'>
                                                            <label for='profile-phone'>Current Password <font
                                                                    style="color:red;">*</font></label>
                                                            <input class='form-control' placeholder='' type='password'
                                                                required name="pass">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='row'>
                                                    <div class='col-12 col-md-4'>
                                                        <div class='form-group'>
                                                            <label for='profile-phone'>New Password <font
                                                                    style="color:red;">*</font></label>
                                                            <input class='form-control' placeholder='' type='password'
                                                                required name="pass1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='row'>
                                                    <div class='col-12 col-md-4'>
                                                        <div class='form-group'>
                                                            <label for='profile-phone'>Confirm Password <font
                                                                    style="color:red;">*</font></label>
                                                            <input class='form-control' placeholder='' type='password'
                                                                required name="pass2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='form-group mt-2'>
                                            <button class='btn btn-outline btn-outline-default btn-radius'
                                                type='submit'>
                                                Update
                                            </button>
                                        </div>
                                    </form>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<?php include(app_path().'/common/footer.php'); ?>
<script src="https://js.stripe.com/v3/"></script>
<script>
// Create a Stripe client
var pk = '<?php echo env('STRIPE_PUB_KEY'); ?>';
var stripe = Stripe(pk);

// Create an instance of Elements
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
    base: {
        color: '#32325d',
        lineHeight: '18px',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
};

// Create an instance of the card Element
var card = elements.create('card', {
    style: style
});

// Add an instance of the card Element into the `card-element` <div>
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
        $("#card-errors").show();
    } else {
        displayError.textContent = '';
        $("#card-errors").hide();
    }
});

// Handle form submission
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
        if (result.error) {
            // Inform the user if there was an error
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
            $("#card-errors").show();
        } else { //alert(result.token);
            // Send the token to your server
            $("#card-errors").hide();
            $("#payment-submit").attr('disabled', true);
            stripeTokenHandler(result.token);
        }
    });
});

function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
}
</script>
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
            }
        } else {
            $("#error").text('Image must be less than 5 MB.');
            $("#error").show();
            $(".car_file").val('');
        }
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
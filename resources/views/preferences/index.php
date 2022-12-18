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
                            method="post">
                            <?php echo csrf_field(); ?>

                            <h5 class="main-heading"><?php echo trans('profile.preferences'); ?></h5>
                            <hr class="mt-0 mb-4">

                            <?php if(Session::has('success')) { ?>
                            <p class="alert2 alert alert-success"><?php echo Session::get('success'); ?>
                            </p>
                            <?php } ?>
                            <?php if(Session::has('error')) { ?>
                            <p class="alert2 alert alert-danger"><?php echo Session::get('error'); ?>
                            </p>
                            <?php } ?>

                            <div class='form-group' id="smoke">
                                <label class="font-weight-bold"><?php echo trans('forms.smoking'); ?>:</label>
                                <ul class='ul__list ul__list--horizontal'>
                                    <li>
                                        <label class='checkbox__square checkbox__round checkbox__radio--1'
                                            for='profile-smoke-non-smoking'>
                                            <div class='radio-element radio-element-1'>
                                                <input id='profile-smoke-non-smoking' name='smoke'
                                                    data-parsley-errors-container='#parsley-smoke-error'
                                                    data-parsley-required="true" type='radio' value='No'
                                                    <?php if($user->smoke=='No') echo 'checked'; ?>>
                                                <span class='text checkbox__all'>
                                                    <span class='select-element checkbox__element'>
                                                        <span class='toggle'></span>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class='radio-text'>
                                                <?php echo trans('forms.non_smoking'); ?>
                                            </div>
                                        </label>
                                    </li>
                                    <li>
                                        <label class='checkbox__square checkbox__round checkbox__radio--1'
                                            for='profile-smoke-smoking'>
                                            <div class='radio-element radio-element-1'>
                                                <input id='profile-smoke-smoking' name='smoke'
                                                    data-parsley-errors-container='#parsley-smoke-error'
                                                    data-parsley-required="true" type='radio' value='Yes'
                                                    <?php if($user->smoke=='Yes') echo 'checked'; ?>>
                                                <span class='text checkbox__all'>
                                                    <span class='select-element checkbox__element'>
                                                        <span class='toggle'></span>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class='radio-text'>
                                                <?php echo trans('forms.smoking'); ?>
                                            </div>
                                        </label>
                                    </li>

                                    <li>
                                        <label class='checkbox__square checkbox__round checkbox__radio--1'
                                            for='profile-smoke-no-preference'>
                                            <div class='radio-element radio-element-1'>
                                                <input id='profile-smoke-no-preference' name='smoke'
                                                    data-parsley-errors-container='#parsley-smoke-error'
                                                    data-parsley-required="true" type='radio' value='No preference'
                                                    <?php if($user->smoke=='No preference') echo 'checked'; ?>>
                                                <span class='text checkbox__all'>
                                                    <span class='select-element checkbox__element'>
                                                        <span class='toggle'></span>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class='radio-text'>
                                                <?php echo trans('forms.no_preference'); ?>
                                            </div>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div id='parsley-smoke-error'></div>

                            <div class='form-group' id="pets">
                                <label class="font-weight-bold"><?php echo trans('forms.pets'); ?>:</label>
                                <ul class='ul__list ul__list--horizontal'>
                                    <li>
                                        <label class='checkbox__square checkbox__round checkbox__radio--1'
                                            for='profile-pets-non-smoking'>
                                            <div class='radio-element radio-element-1'>
                                                <input id='profile-pets-non-smoking' name='pets'
                                                    data-parsley-errors-container='#parsley-pets-error'
                                                    data-parsley-required="true" type='radio' value='Yes'
                                                    <?php if($user->pets=='Yes') echo 'checked'; ?>>
                                                <span class='text checkbox__all'>
                                                    <span class='select-element checkbox__element'>
                                                        <span class='toggle'></span>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class='radio-text'>
                                                <?php echo trans('forms.yes'); ?>
                                            </div>
                                        </label>
                                    </li>
                                    <li>
                                        <label class='checkbox__square checkbox__round checkbox__radio--1'
                                            for='profile-pets-smoking'>
                                            <div class='radio-element radio-element-1'>
                                                <input id='profile-pets-smoking' name='pets'
                                                    data-parsley-errors-container='#parsley-pets-error'
                                                    data-parsley-required="true" type='radio' value='No'
                                                    <?php if($user->pets=='No') echo 'checked'; ?>>
                                                <span class='text checkbox__all'>
                                                    <span class='select-element checkbox__element'>
                                                        <span class='toggle'></span>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class='radio-text'>
                                                <?php echo trans('forms.no'); ?>
                                            </div>
                                        </label>
                                    </li>
                                    <li>
                                        <label class='checkbox__square checkbox__round checkbox__radio--1'
                                            for='profile-pets-no-preference'>
                                            <div class='radio-element radio-element-1'>
                                                <input id='profile-pets-no-preference' name='pets'
                                                    data-parsley-errors-container='#parsley-pets-error'
                                                    data-parsley-required="true" type='radio' value='No preference'
                                                    <?php if($user->pets=='No preference') echo 'checked'; ?>>
                                                <span class='text checkbox__all'>
                                                    <span class='select-element checkbox__element'>
                                                        <span class='toggle'></span>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class='radio-text'>
                                                <?php echo trans('forms.no_preference'); ?>
                                            </div>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div id='parsley-pets-error'></div>

                            <!-- / Ride features -->
                            <ul class='ride__features__list ul__list'>
                                <?php 
                                                    $features=array();
                                                    if(!empty($user->features)) $features=explode(';',$user->features);
                                                ?>
                                <li style="color: #e11e86; font-weight: bold;">
                                    <label class='checkbox__square checkbox__element checkbox__long__text'
                                        for='pink_ride'>
                                        <input id='pink_ride' type='checkbox' value='Pink ride' name="features[]"
                                            <?php if(in_array('Pink ride', $features)) echo 'checked'; ?>
                                            class="filter_field">
                                        <span class='checkbox__all'>
                                            <span class='checkbox__element'>
                                                <i class='fa fa-check'></i>
                                            </span>
                                        </span>
                                        <span class='text show-info-top-right'>
                                            <span class='info-icon filter_field text-dark' data-toggle='tooltip'
                                                title='<?php echo trans('forms.only_female_drivers'); ?>'>
                                                <i class='fa fa-info-circle'></i>
                                            </span>
                                            <?php echo trans('forms.pink_rides'); ?>
                                        </span>
                                    </label>
                                </li>
                                <li style="color: #077dd5; font-weight: bold;">
                                    <label class='checkbox__square checkbox__element checkbox__long__text'
                                        for='extra-care-ride'>
                                        <input id='extra-care-ride' type='checkbox' value='Extra-care ride'
                                            name="features[]"
                                            <?php if(in_array('Extra-care ride', $features)) echo 'checked'; ?>
                                            class="filter_field">
                                        <span class='checkbox__all'>
                                            <span class='checkbox__element'>
                                                <i class='fa fa-check'></i>
                                            </span>
                                        </span>
                                        <span class='text show-info-top-right'>
                                            <span class='info-icon filter_field text-dark' data-toggle='tooltip'
                                                title='Only selected drivers and passengers can use this service. The system will let you know whether you are eligible or not after you complete your registration'>
                                                <i class='fa fa-info-circle'></i>
                                            </span>
                                            <?php echo trans('forms.extra_care_rides'); ?>
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label class='checkbox__square checkbox__element checkbox__long__text'
                                        for='electric_car'>
                                        <input id='electric_car' type='checkbox' value='Electric car' name="features[]"
                                            <?php if(in_array('Electric car', $features)) echo 'checked'; ?>
                                            class="filter_field">
                                        <span class='checkbox__all'>
                                            <span class='checkbox__element'>
                                                <i class='fa fa-check'></i>
                                            </span>
                                        </span>
                                        <span class='text show-info-top-right'>
                                            <?php echo trans('forms.electric_car'); ?>
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label class='checkbox__square checkbox__element checkbox__long__text' for='wi-fi'>
                                        <input id='wi-fi' type='checkbox' value='Wi-Fi' name="features[]"
                                            <?php if(in_array('Wi-Fi', $features)) echo 'checked'; ?>
                                            class="filter_field">
                                        <span class='checkbox__all'>
                                            <span class='checkbox__element'>
                                                <i class='fa fa-check'></i>
                                            </span>
                                        </span>
                                        <span class='text show-info-top-right'>
                                            <?php echo trans('forms.wifi'); ?>
                                        </span>
                                    </label>
                                </li>
                                <?php if($user->account_type == 'driver'):?>
                                <li>
                                    <label class='checkbox__square checkbox__element checkbox__long__text'
                                        for='5 star passengers'>
                                        <input id='5 star passengers' type='checkbox'
                                            value='I want only 5 star passengers' name="features[]"
                                            <?php if (in_array('I want only 5 star passengers', $features)) echo 'checked'; ?>
                                            class="filter_field">
                                        <span class='checkbox__all'>
                                            <span class='checkbox__element'>
                                                <i class='fa fa-check'></i>
                                            </span>
                                        </span>
                                        <span class='text show-info-top-right'>
                                            <?php echo trans('account.only_5_stars'); ?>
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label class='checkbox__square checkbox__element checkbox__long__text'
                                        for='4.5 star passengers'>
                                        <input id='4.5 star passengers' type='checkbox'
                                            value='I want only with review score of 4.5 star passengers'
                                            name="features[]"
                                            <?php if (in_array('I want only with review score of 4.5 star passengers', $features)) echo 'checked'; ?>
                                            class="filter_field">
                                        <span class='checkbox__all'>
                                            <span class='checkbox__element'>
                                                <i class='fa fa-check'></i>
                                            </span>
                                        </span>
                                        <span class='text show-info-top-right'>
                                            <?php echo trans('account.only_4.5_stars'); ?>
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label class='checkbox__square checkbox__element checkbox__long__text'
                                        for='4 star passengers'>
                                        <input id='4 star passengers' type='checkbox'
                                            value='I want only with review score of 4 star passengers' name="features[]"
                                            <?php if (in_array('I want only with review score of 4 star passengers', $features)) echo 'checked'; ?>
                                            class="filter_field">
                                        <span class='checkbox__all'>
                                            <span class='checkbox__element'>
                                                <i class='fa fa-check'></i>
                                            </span>
                                        </span>
                                        <span class='text show-info-top-right'>
                                            <?php echo trans('account.only_4_stars'); ?>
                                        </span>
                                    </label>
                                </li>
                                <?php endif;?>

                                <li>
                                    <label class='checkbox__square checkbox__element checkbox__long__text'
                                        for='i take infants'>
                                        <input id='i take infants' type='checkbox'
                                            value='I take infants and I provide car baby seat(s)' name="features[]"
                                            <?php if(in_array('I take infants and I provide car baby seat(s)', $features)) echo 'checked'; ?>
                                            class="filter_field">
                                        <span class='checkbox__all'>
                                            <span class='checkbox__element'>
                                                <i class='fa fa-check'></i>
                                            </span>
                                        </span>
                                        <span class='text show-info-top-right'>
                                            I have (I take) enfant(s), and I provide car baby seat(s)
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label class='checkbox__square checkbox__element checkbox__long__text'
                                        for='i-take-infants'>
                                        <input id='i-take-infants' type='checkbox'
                                            value='I take infants if the passenger provides car baby seat(s)'
                                            name="features[]"
                                            <?php if(in_array('I take infants if the passenger provides car baby seat(s)', $features)) echo 'checked'; ?>
                                            class="filter_field">
                                        <span class='checkbox__all'>
                                            <span class='checkbox__element'>
                                                <i class='fa fa-check'></i>
                                            </span>
                                        </span>
                                        <span class='text show-info-top-right'>
                                            I have (I take) enfant(s), but do not have car baby seat(s)
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label class='checkbox__square checkbox__element checkbox__long__text'
                                        for='isdtakesdkids2'>
                                        <input id='isdtakesdkids2' type='checkbox'
                                            value='I take children and I provide car booster seat(s)' name="features[]"
                                            <?php if(in_array('I take children and I provide car booster seat(s)', $features)) echo 'checked'; ?>
                                            class="filter_field">
                                        <span class='checkbox__all'>
                                            <span class='checkbox__element'>
                                                <i class='fa fa-check'></i>
                                            </span>
                                        </span>
                                        <span class='text show-info-top-right'>
                                            I have (I take) child(ren), and I provide car booster
                                            seat(s)
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label class='checkbox__square checkbox__element checkbox__long__text'
                                        for='idtakedkids'>
                                        <input id='idtakedkids' type='checkbox'
                                            value='I take children if the passenger providers car baby seat(s)'
                                            name="features[]"
                                            <?php if(in_array('I take children if the passenger providers car baby seat(s)', $features)) echo 'checked'; ?>
                                            class="filter_field">
                                        <span class='checkbox__all'>
                                            <span class='checkbox__element'>
                                                <i class='fa fa-check'></i>
                                            </span>
                                        </span>
                                        <span class='text show-info-top-right'>
                                            I have (I take) child(ren), but I do not have car baby
                                            seat(s)
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label class='checkbox__square checkbox__element' for='bike rack'>
                                        <input id='bike rack' type='checkbox' value='Bike rack' name="features[]"
                                            <?php if(in_array('Bike rack', $features)) echo 'checked'; ?>
                                            class="filter_field">
                                        <span class='checkbox__all'>
                                            <span class='checkbox__element'>
                                                <i class='fa fa-check'></i>
                                            </span>
                                        </span>
                                        <span class='text show-info-top-right'>
                                            <?php echo trans('forms.bike_rack'); ?>
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label class='checkbox__square checkbox__element' for='ski rack'>
                                        <input id='ski rack' type='checkbox' value='Ski rack' name="features[]"
                                            <?php if(in_array('Ski rack', $features)) echo 'checked'; ?>
                                            class="filter_field">
                                        <span class='checkbox__all'>
                                            <span class='checkbox__element'>
                                                <i class='fa fa-check'></i>
                                            </span>
                                        </span>
                                        <span class='text show-info-top-right'>
                                            <?php echo trans('forms.ski_rack'); ?>
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label class='checkbox__square checkbox__element' for='winter tires'>
                                        <input id='winter tires' type='checkbox' value='Winter tires' name="features[]"
                                            <?php if(in_array('Winter tires', $features)) echo 'checked'; ?>
                                            class="filter_field">
                                        <span class='checkbox__all'>
                                            <span class='checkbox__element'>
                                                <i class='fa fa-check'></i>
                                            </span>
                                        </span>
                                        <span class='text show-info-top-right'>
                                            <?php echo trans('forms.winter_tires'); ?>
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label class='checkbox__square checkbox__element' for='air conditioning'>
                                        <input id='air conditioning' type='checkbox' value='Air conditioning'
                                            name="features[]"
                                            <?php if(in_array('Air conditioning', $features)) echo 'checked'; ?>
                                            class="filter_field">
                                        <span class='checkbox__all'>
                                            <span class='checkbox__element'>
                                                <i class='fa fa-check'></i>
                                            </span>
                                        </span>
                                        <span class='text show-info-top-right'>
                                            <?php echo trans('forms.air_conditioning'); ?>
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label class='checkbox__square checkbox__element' for='heating'>
                                        <input id='heating' type='checkbox' value='Heating' name="features[]"
                                            <?php if(in_array('Heating', $features)) echo 'checked'; ?>
                                            class="filter_field">
                                        <span class='checkbox__all'>
                                            <span class='checkbox__element'>
                                                <i class='fa fa-check'></i>
                                            </span>
                                        </span>
                                        <span class='text show-info-top-right'>
                                            <?php echo trans('forms.heating'); ?>
                                        </span>
                                    </label>
                                </li>
                            </ul>
                            <!-- / End Ride features -->

                            <div class='form-group mt-2'>
                                <button class='btn btn-outline btn-outline-default btn-radius' type='submit'>
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
<script src="<?php echo url('javascripts/libs/parsley.min.js'); ?>"></script>
<script src="<?php echo url('plugins/perfect-scrollbar.js'); ?>" type="text/javascript"></script>

<script>
// $(document).on('click', '.car_browse', function() {
//     var file = $(this).prev();
//     file.trigger('click');
// });

// $(document).on('change', '.car_file', function(e) {
//     var o = new FileReader;
//     o.readAsDataURL(e.target.files[0]), o.onloadend = function(o) {
//         $("#car_image").attr("src", o.target.result);
//     }
//     //$(this).prev().text($(this).val().replace(/C:\\fakepath\\/i, ''));
// });

// $(document).ready(function() {

//     $('#datepicker2').datepicker({
//         uiLibrary: 'bootstrap4',
//         format: 'dd-mm-yyyy'
//     });
// });
const current_date = new Date().getFullYear();
const pink = $('#pink_ride');
const extraRide = $('#extra-care-ride');
const gender = '<?php echo $user->gender; ?>';
const age = current_date - <?php $age = explode('-',$user->dob); echo $age[0]; ?>;
const account_type = '<?php echo $user->account_type; ?>';

if (gender !== 'Female') {
    pink.click(() => {

        showErrorDialog(
            'Pink rides are strictly for female drivers and passengers',
            $('#pink_ride').prop('checked', false)
        );
    });
}

extraRide.click(() => {
    // console.log(1)
    if (age < 50 && account_type == 'driver') {
        showErrorDialog(
            'You are unable to select this preference due to your current age',
            extraRide.prop('checked', false)
        );

    }
});
</script>
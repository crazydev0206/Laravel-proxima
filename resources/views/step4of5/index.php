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
                    <div style="display: flex; justify-content:center; align-items:center;">
                        <div class="text-center">
                            <h3 class='f-700 mb-1'><?php echo trans('account.step4of5'); ?></h3>
                            <p class='text-center mb-30'
                                style="font-size: 16px; font-weight: 400; color: #2d4653; line-height:1.3rem;">
                                <?php echo trans('account.step4of5_text'); ?></p>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-12'>

                            <div class="col-md-6 offset-md-3">

                                <?php if (Session::has('success')) { ?>
                                <p class="alert alert-success"><?php echo Session::get('success'); ?></p>
                                <?php } ?>
                                <?php if (Session::has('error')) { ?>
                                <p class="alert alert-danger"><?php echo Session::get('error'); ?></p>
                                <?php } ?>

                                <?php if ($user->status == '2') { ?>
                                <p class="alert alert-success">Your account is under review, you will be notified once
                                    it is approved. You can also update the details if required.</p>
                                <?php } ?>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='col-12'></div>
                        </div>
                        <!-- / Normal sign in/up section -->
                        <div class='row'>
                            <div class='col-12'>
                                <form class='rider__sign parsley__form__validate' data-parsley-validate=''
                                    action="<?= url('/api/submit_fourth_form'); ?>" method="post"
                                    onsubmit="return check_data();" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>

                                    <p><?php echo trans('account.preferences_are_for_both'); ?></p>

                                    <div class='form-group' id="smoke">
                                        <label><?php echo trans('account.smoking'); ?>:</label>
                                        <ul class='ul__list ul__list--horizontal'>
                                            <li>
                                                <label class='checkbox__square checkbox__round checkbox__radio--1'
                                                    for='profile-smoke-non-smoking'>
                                                    <div class='radio-element radio-element-1'>
                                                        <input id='profile-smoke-non-smoking' name='smoke'
                                                            data-parsley-errors-container='#parsley-smoke-error'
                                                            data-parsley-required="true" type='radio' value='No'
                                                            <?php if ($user->smoke == 'No') echo 'checked'; ?>>
                                                        <span class='text checkbox__all'>
                                                            <span class='select-element checkbox__element'>
                                                                <span class='toggle'></span>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class='radio-text'>
                                                        <?php echo trans('account.non_smoking'); ?>
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
                                                            <?php if ($user->smoke == 'Yes') echo 'checked'; ?>>
                                                        <span class='text checkbox__all'>
                                                            <span class='select-element checkbox__element'>
                                                                <span class='toggle'></span>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class='radio-text'>
                                                        <?php echo trans('account.smoking'); ?>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>
                                                <label class='checkbox__square checkbox__round checkbox__radio--1'
                                                    for='profile-smoke-no-preference'>
                                                    <div class='radio-element radio-element-1'>
                                                        <input id='profile-smoke-no-preference' name='smoke'
                                                            data-parsley-errors-container='#parsley-smoke-error'
                                                            data-parsley-required="true" type='radio'
                                                            value='No preference'
                                                            <?php if ($user->smoke == 'No preference') echo 'checked'; ?>>
                                                        <span class='text checkbox__all'>
                                                            <span class='select-element checkbox__element'>
                                                                <span class='toggle'></span>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class='radio-text'>
                                                        <?php echo trans('account.no_preference'); ?>
                                                    </div>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div id='parsley-smoke-error'></div>

                                    <div class='form-group' id="pets">
                                        <label><?php echo trans('account.pets'); ?>:</label>
                                        <ul class='ul__list ul__list--horizontal'>
                                            <li>
                                                <label class='checkbox__square checkbox__round checkbox__radio--1'
                                                    for='profile-pets-non-smoking'>
                                                    <div class='radio-element radio-element-1'>
                                                        <input id='profile-pets-non-smoking' name='pets'
                                                            data-parsley-errors-container='#parsley-pets-error'
                                                            data-parsley-required="true" type='radio' value='Yes'
                                                            <?php if ($user->pets == 'Yes') echo 'checked'; ?>>
                                                        <span class='text checkbox__all'>
                                                            <span class='select-element checkbox__element'>
                                                                <span class='toggle'></span>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class='radio-text'>
                                                        <?php echo trans('account.yes'); ?>
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
                                                            <?php if ($user->pets == 'No') echo 'checked'; ?>>
                                                        <span class='text checkbox__all'>
                                                            <span class='select-element checkbox__element'>
                                                                <span class='toggle'></span>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class='radio-text'>
                                                        <?php echo trans('account.no'); ?>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>
                                                <label class='checkbox__square checkbox__round checkbox__radio--1'
                                                    for='profile-pets-no-preference'>
                                                    <div class='radio-element radio-element-1'>
                                                        <input id='profile-pets-no-preference' name='pets'
                                                            data-parsley-errors-container='#parsley-pets-error'
                                                            data-parsley-required="true" type='radio'
                                                            value='No preference'
                                                            <?php if ($user->pets == 'No preference') echo 'checked'; ?>>
                                                        <span class='text checkbox__all'>
                                                            <span class='select-element checkbox__element'>
                                                                <span class='toggle'></span>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class='radio-text'>
                                                        <?php echo trans('account.no_preference'); ?>
                                                    </div>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div id='parsley-pets-error'></div>

                                    <!-- / Ride features -->
                                    <ul class='ride__features__list ul__list'>
                                        <?php
                                        $features = array();
                                        if (!empty($user->features)) $features = explode(';', $user->features);
                                        ?>
                                        <li style="color: #e11e86;" class="font-weight-bold">
                                            <label class='checkbox__square checkbox__element checkbox__long__text'
                                                for='pink_ride'>

                                                <input id='pink_ride' type='checkbox' value='Pink ride'
                                                    name="features[]"
                                                    <?php if (in_array('Pink ride', $features)) echo 'checked'; #if($user->gender !== 'Female') echo 'disabled'; ?>
                                                    class="filter_field">
                                                <span class='checkbox__all'>
                                                    <span class='checkbox__element'>
                                                        <i class='fa fa-check'></i>
                                                    </span>
                                                </span>
                                                <span class='text show-info-top-right'>
                                                    <span class='info-icon filter_field text-dark' data-toggle='tooltip'
                                                        title='Only female drivers and female passengers'>
                                                        <i class='fa fa-info-circle'></i>
                                                    </span>
                                                    <?php echo trans('account.pink_rides'); ?>
                                                </span>
                                            </label>
                                        </li>
                                        
                                        <li class="text-success font-weight-bold">
                                            <label class='checkbox__square checkbox__element checkbox__long__text'
                                                for='extra-care-ride'>
                                                <input id='extra-care-ride' type='checkbox' value='Extra-care ride'
                                                    name="features[]"
                                                    <?php if (in_array('Extra-care ride', $features)) echo 'checked'; ?>
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
                                                    <?php echo trans('account.extra_care_rides'); ?>
                                                </span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class='checkbox__square checkbox__element checkbox__long__text'
                                                for='electric_car'>
                                                <input id='electric_car' type='checkbox' value='Electric car'
                                                    name="features[]"
                                                    <?php if (in_array('Electric car', $features)) echo 'checked'; ?>
                                                    class="filter_field">
                                                <span class='checkbox__all'>
                                                    <span class='checkbox__element'>
                                                        <i class='fa fa-check'></i>
                                                    </span>
                                                </span>
                                                <span class='text show-info-top-right'>
                                                    <?php echo trans('account.electric_car'); ?>
                                                </span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class='checkbox__square checkbox__element checkbox__long__text'
                                                for='wi-fi'>
                                                <input id='wi-fi' type='checkbox' value='Wi-Fi' name="features[]"
                                                    <?php if (in_array('Wi-Fi', $features)) echo 'checked'; ?>
                                                    class="filter_field">
                                                <span class='checkbox__all'>
                                                    <span class='checkbox__element'>
                                                        <i class='fa fa-check'></i>
                                                    </span>
                                                </span>
                                                <span class='text show-info-top-right'>
                                                    <?php echo trans('account.wifi'); ?>
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
                                                    value='I want only with review score of 4 star passengers'
                                                    name="features[]"
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
                                                    value='I take infants and I provide car baby seat(s)'
                                                    name="features[]"
                                                    <?php if (in_array('I take infants and I provide car baby seat(s)', $features)) echo 'checked'; ?>
                                                    class="filter_field">
                                                <span class='checkbox__all'>
                                                    <span class='checkbox__element'>
                                                        <i class='fa fa-check'></i>
                                                    </span>
                                                </span>
                                                <span class='text show-info-top-right'>
                                                    <?php echo trans('account.have_enfants_provide_car'); ?>
                                                </span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class='checkbox__square checkbox__element checkbox__long__text'
                                                for='i-take-infants'>
                                                <input id='i-take-infants' type='checkbox'
                                                    value='I take infants if the passenger provides car baby seat(s)'
                                                    name="features[]"
                                                    <?php if (in_array('I take infants if the passenger provides car baby seat(s)', $features)) echo 'checked'; ?>
                                                    class="filter_field">
                                                <span class='checkbox__all'>
                                                    <span class='checkbox__element'>
                                                        <i class='fa fa-check'></i>
                                                    </span>
                                                </span>
                                                <span class='text show-info-top-right'>
                                                    <?php echo trans('account.have_enfants_no_car'); ?>
                                                </span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class='checkbox__square checkbox__element checkbox__long__text'
                                                for='isdtakesdkids2'>
                                                <input id='isdtakesdkids2' type='checkbox'
                                                    value='I take children and I provide car booster seat(s)'
                                                    name="features[]"
                                                    <?php if (in_array('I take children and I provide car booster seat(s)', $features)) echo 'checked'; ?>
                                                    class="filter_field">
                                                <span class='checkbox__all'>
                                                    <span class='checkbox__element'>
                                                        <i class='fa fa-check'></i>
                                                    </span>
                                                </span>
                                                <span class='text show-info-top-right'>
                                                    <?php echo trans('account.have_children_provide_car'); ?>
                                                </span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class='checkbox__square checkbox__element checkbox__long__text'
                                                for='idtakedkids'>
                                                <input id='idtakedkids' type='checkbox'
                                                    value='I take children if the passenger providers car baby seat(s)'
                                                    name="features[]"
                                                    <?php if (in_array('I take children if the passenger providers car baby seat(s)', $features)) echo 'checked'; ?>
                                                    class="filter_field">
                                                <span class='checkbox__all'>
                                                    <span class='checkbox__element'>
                                                        <i class='fa fa-check'></i>
                                                    </span>
                                                </span>
                                                <span class='text show-info-top-right'>
                                                    <?php echo trans('account.have_children_no_car'); ?>
                                                </span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class='checkbox__square checkbox__element' for='bike rack'>
                                                <input id='bike rack' type='checkbox' value='Bike rack'
                                                    name="features[]"
                                                    <?php if (in_array('Bike rack', $features)) echo 'checked'; ?>
                                                    class="filter_field">
                                                <span class='checkbox__all'>
                                                    <span class='checkbox__element'>
                                                        <i class='fa fa-check'></i>
                                                    </span>
                                                </span>
                                                <span class='text show-info-top-right'>
                                                    <?php echo trans('account.bike_rack'); ?>
                                                </span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class='checkbox__square checkbox__element' for='ski rack'>
                                                <input id='ski rack' type='checkbox' value='Ski rack' name="features[]"
                                                    <?php if (in_array('Ski rack', $features)) echo 'checked'; ?>
                                                    class="filter_field">
                                                <span class='checkbox__all'>
                                                    <span class='checkbox__element'>
                                                        <i class='fa fa-check'></i>
                                                    </span>
                                                </span>
                                                <span class='text show-info-top-right'>
                                                    <?php echo trans('account.ski_rack'); ?>
                                                </span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class='checkbox__square checkbox__element' for='winter tires'>
                                                <input id='winter tires' type='checkbox' value='Winter tires'
                                                    name="features[]"
                                                    <?php if (in_array('Winter tires', $features)) echo 'checked'; ?>
                                                    class="filter_field">
                                                <span class='checkbox__all'>
                                                    <span class='checkbox__element'>
                                                        <i class='fa fa-check'></i>
                                                    </span>
                                                </span>
                                                <span class='text show-info-top-right'>
                                                    <?php echo trans('account.winter_tires'); ?>
                                                </span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class='checkbox__square checkbox__element' for='air conditioning'>
                                                <input id='air conditioning' type='checkbox' value='Air conditioning'
                                                    name="features[]"
                                                    <?php if (in_array('Air conditioning', $features)) echo 'checked'; ?>
                                                    class="filter_field">
                                                <span class='checkbox__all'>
                                                    <span class='checkbox__element'>
                                                        <i class='fa fa-check'></i>
                                                    </span>
                                                </span>
                                                <span class='text show-info-top-right'>
                                                    <?php echo trans('account.ac'); ?>
                                                </span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class='checkbox__square checkbox__element' for='heating'>
                                                <input id='heating' type='checkbox' value='Heating' name="features[]"
                                                    <?php if (in_array('Heating', $features)) echo 'checked'; ?>
                                                    class="filter_field">
                                                <span class='checkbox__all'>
                                                    <span class='checkbox__element'>
                                                        <i class='fa fa-check'></i>
                                                    </span>
                                                </span>
                                                <span class='text show-info-top-right'>
                                                    <?php echo trans('account.heating'); ?>
                                                </span>
                                            </label>
                                        </li>
                                    </ul>
                                    <!-- / End Ride features -->

                                    <div id="form-box">
                                        <?php if ($user->type == 'Driver') { ?>
                                        <div class='form-group'>
                                            <label>Driver License <font style="color:red;">*</font></label>
                                            <input class='form-control' name='driver_license' required type="file"
                                                required>
                                        </div>
                                        <!--<div class='row'>
<div class='col-12 col-md-12'>
<div class='form-group'>
<input class='form-control' name='first_name' placeholder='First Name' required type="text">
</div>
</div>
</div>-->
                                        <?php } ?>

                                        <?php if ($user->type == 'Student') { ?>
                                        <div class='form-group'>
                                            <label>Student Card<font style="color:red;">*</font></label>
                                            <input class='form-control' name='student_card' type="file"
                                                <?php if (empty($user->student_card)) echo 'required'; ?>>
                                        </div>
                                        <div class='row'>
                                            <div class='col-12 col-md-12'>
                                                <div class='form-group'>
                                                    <label>School Name<font style="color:red;">*</font></label>
                                                    <input class='form-control' name='school_name' required type="text"
                                                        value="<?php echo $user->school_name; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>

                                    <div class='form-group'>
                                        <!-- / reCaptch -->
                                    </div>
                                    <div class='form-group text-center'>
                                        <p class="alert alert-danger" style="display:none;" id="error"></p>
                                        <a href="<?php echo url('/skip/fourth_step'); ?>"><button
                                                class='btn btn-outline btn-outline-default btn-c-transition btn-radius'
                                                type='button'>
                                                <?php echo trans('account.skip'); ?>
                                            </button></a>
                                        <button class='btn btn-outline btn-outline-default btn-c-transition btn-radius'
                                            type='submit' id="submit_btn">
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
    <script src="<?php echo url('javascripts/libs/parsley.min.js'); ?>"></script>
    <script>
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
                'You are not allowed to select this preference',
                extraRide.prop('checked', false)
            );

        }
    });



    function check_data() {
        if ($('input[name="smoke"]:checked').length <= 0) {
            //$("#error").text('Please select seat first.');
            //$("#error").show();
            var scrollPos = $("#smoke").offset().top;
            $(window).scrollTop(scrollPos);
            return false;
        }
        if ($('input[name="pets"]:checked').length <= 0) {
            //$("#error").text('Please select seat first.');
            //$("#error").show();
            var scrollPos = $("#pets").offset().top;
            $(window).scrollTop(scrollPos);
            return false;
        }

        return true;
    }
    </script>
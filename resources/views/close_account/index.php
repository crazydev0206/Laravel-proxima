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
                <?php $user_data=$user; include(app_path().'/common/left_profile.php'); ?>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-8 col-xl-9">
            <div class="container-fluid flex-grow-1 container-p-y">
                <div class="d-flex align-items-center justify-content-between">

                    <div class="text-muted small d-block breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="lnr lnr-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo url($title)?>"><?php echo $title?></a>
                            </li>
                            <?php if(isset($subtitle)):?>
                            <li class="breadcrumb-item active"><?php echo $subtitle?></li>
                            <?php endif?>
                        </ol>
                    </div>


                </div>
                <div class="card">
                    <div class="card-header pb-2">
                        <h5 class="main-heading"><?php echo  trans('profile.close_my_account'); ?></h5>
                    </div>
                    <div class="card-body">
                        <form class='rider__sign parsley__form__validate' data-parsley-validate='' action=""
                            method="post">
                            <?php echo csrf_field(); ?>
                            <!-- / Personal Information -->
                            <!--<h5 class='f-500 mb-2'>Basic Details:</h5>-->
                            
                            <div class='row'>
                                <div class='col-12 col-md-12'>
                                    <p class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>
                                        <?php echo trans('forms.closing_will_delete'); ?></p>
                                    <div class='row'>
                                        <div class='col-12 pb-3'>
                                            <p style="font-weight:bold; color:black;">
                                                <?php echo trans('forms.we_are_sorry_leave'); ?></p>

                                            <div class='form-group'>
                                                <h5 class='f-section-title mt-4'>
                                                    <?php echo trans('forms.reasons_closing_account'); ?>
                                                </h5>
                                                <hr class="mt-0">
                                                <ul class='ride__features__list ul__list'>
                                                    <li>
                                                        <label class='checkbox__square checkbox__element' for='wi-fi'>
                                                            <input id='wi-fi' type='checkbox' value='Prefer not to say'
                                                                name="reasons[]">
                                                            <span class='checkbox__all'>
                                                                <span class='checkbox__element'>
                                                                    <i class='fa fa-check'></i>
                                                                </span>
                                                            </span>
                                                            <span class='text show-info-top-right'>
                                                                <?php echo trans('forms.prefer_not_say'); ?>
                                                            </span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class='checkbox__square checkbox__element'
                                                            for='5 star passengers'>
                                                            <input id='5 star passengers' type='checkbox'
                                                                value='I do not like the phone/email customer service'
                                                                name="reasons[]">
                                                            <span class='checkbox__all'>
                                                                <span class='checkbox__element'>
                                                                    <i class='fa fa-check'></i>
                                                                </span>
                                                            </span>
                                                            <span class='text show-info-top-right'>
                                                                <?php echo trans('forms.not_customer_service'); ?>
                                                            </span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class='checkbox__square checkbox__element'
                                                            for='i take infants'>
                                                            <input id='i take infants' type='checkbox'
                                                                value='Technical issues with the website/app'
                                                                name="reasons[]">
                                                            <span class='checkbox__all'>
                                                                <span class='checkbox__element'>
                                                                    <i class='fa fa-check'></i>
                                                                </span>
                                                            </span>
                                                            <span class='text show-info-top-right'>
                                                                <?php echo trans('forms.technical_issues'); ?>
                                                            </span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class='checkbox__square checkbox__element'
                                                            for='i-take-infants'>
                                                            <input id='i-take-infants' type='checkbox'
                                                                value='Difficulties making/receiving payments'
                                                                name="reasons[]">
                                                            <span class='checkbox__all'>
                                                                <span class='checkbox__element'>
                                                                    <i class='fa fa-check'></i>
                                                                </span>
                                                            </span>
                                                            <span class='text show-info-top-right'>
                                                                <?php echo trans('forms.difficulties_making'); ?>
                                                            </span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class='checkbox__square checkbox__element'
                                                            for='isdftakesdids2'>
                                                            <input id='isdftakesdids2' type='checkbox'
                                                                value="I don't use ridesharing anymore"
                                                                name="reasons[]">
                                                            <span class='checkbox__all'>
                                                                <span class='checkbox__element'>
                                                                    <i class='fa fa-check'></i>
                                                                </span>
                                                            </span>
                                                            <span class='text show-info-top-right'>
                                                                <?php echo trans('forms.dont_use'); ?>
                                                            </span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class='checkbox__square checkbox__element'
                                                            for='idtakedkids'>
                                                            <input id='idtakedkids' type='checkbox'
                                                                value='I tried it, and ridesharing is just not for me'
                                                                name="reasons[]">
                                                            <span class='checkbox__all'>
                                                                <span class='checkbox__element'>
                                                                    <i class='fa fa-check'></i>
                                                                </span>
                                                            </span>
                                                            <span class='text show-info-top-right'>
                                                                <?php echo trans('forms.tried_it'); ?>
                                                            </span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class='checkbox__square checkbox__element'
                                                            for='bike rack'>
                                                            <input id='bike rack' type='checkbox'
                                                                value="I have another account that I'll be using"
                                                                name="reasons[]">
                                                            <span class='checkbox__all'>
                                                                <span class='checkbox__element'>
                                                                    <i class='fa fa-check'></i>
                                                                </span>
                                                            </span>
                                                            <span class='text show-info-top-right'>
                                                                <?php echo trans('forms.another_account'); ?>
                                                            </span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class='checkbox__square checkbox__element'
                                                            for='ski rack'>
                                                            <input id='ski rack' type='checkbox'
                                                                value='I did not get bookings on the rides I posted'
                                                                name="reasons[]">
                                                            <span class='checkbox__all'>
                                                                <span class='checkbox__element'>
                                                                    <i class='fa fa-check'></i>
                                                                </span>
                                                            </span>
                                                            <span class='text show-info-top-right'>
                                                                <?php echo trans('forms.no_bookings'); ?>
                                                            </span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class='checkbox__square checkbox__element'
                                                            for='winter tires'>
                                                            <input id='winter tires' type='checkbox'
                                                                value='I did not find rides to my destination'
                                                                name="reasons[]">
                                                            <span class='checkbox__all'>
                                                                <span class='checkbox__element'>
                                                                    <i class='fa fa-check'></i>
                                                                </span>
                                                            </span>
                                                            <span class='text show-info-top-right'>
                                                                <?php echo trans('forms.no_rides'); ?>
                                                            </span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class='checkbox__square checkbox__element'
                                                            for='air conditioning'>
                                                            <input id='air conditioning' type='checkbox' value='Other'
                                                                name="reasons[]">
                                                            <span class='checkbox__all'>
                                                                <span class='checkbox__element'>
                                                                    <i class='fa fa-check'></i>
                                                                </span>
                                                            </span>
                                                            <span class='text show-info-top-right'>
                                                                <?php echo trans('forms.other'); ?>
                                                            </span>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class='form-section'>
                                                <h5 class='f-section-title mt-4'>
                                                    <?php echo trans('forms.would_recommed?'); ?></h5>
                                                <hr class="mt-0">
                                                <ul class='ul__list'>
                                                    <li>
                                                        <label
                                                            class='checkbox__square checkbox__round checkbox__radio--1'
                                                            for='payment-method-cash'>
                                                            <div class='radio-element'>
                                                                <input id='payment-method-cash' name='recommend'
                                                                    type='radio' value='Yes' class="filter_field">
                                                                <span class='checkbox__all'>
                                                                    <span class='select-element checkbox__element'>
                                                                        <span class='toggle'></span>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                            <div class='radio-text'>
                                                                <?php echo trans('forms.yes'); ?>
                                                            </div>
                                                        </label>
                                                    <li>
                                                        <label
                                                            class='checkbox__square checkbox__round checkbox__radio--1'
                                                            for='payment-method-transfer'>
                                                            <div class='radio-element'>
                                                                <input id='payment-method-transfer' name='recommend'
                                                                    type='radio' value='No' class="filter_field">
                                                                <span class='checkbox__all'>
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
                                                        <label
                                                            class='checkbox__square checkbox__round checkbox__radio--1'
                                                            for='payment-method-guaranteed-cash'>
                                                            <div class='radio-element'>
                                                                <input id='payment-method-guaranteed-cash'
                                                                    name='recommend' type='radio'
                                                                    value='Prefer not to say' class="filter_field">
                                                                <span class='checkbox__all'>
                                                                    <span class='select-element checkbox__element'>
                                                                        <span class='toggle'></span>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                            <div class='radio-text'>
                                                                <?php echo trans('forms.prefer_not_say'); ?>
                                                            </div>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class='form-group'>
                                                <h5 class='f-section-title mt-4'>
                                                    <?php echo trans('forms.more_please'); ?></h5>
                                                <hr class="mt-0">
                                                <textarea class='form-control textarea_limit form-group-border'
                                                    id='profile-about-me' placeholder='' rows='3'
                                                    name="more"></textarea>
                                            </div>
                                        </div>

                                        <div class='col-12 col-md-4'>
                                            <div class='form-group'>
                                                <input type='checkbox' required name="delete" value="1"
                                                    onchange="delete_account(this)"
                                                    data-parsley-trigger='blur focusout change'
                                                    data-parsley-required-message="Please check this checkbox to contine.">
                                                <?php echo trans('profile.close_my_account'); ?>.
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row' style="display:none;" id="password">
                                        <div class='col-12 col-md-4'>
                                            <div class='form-group'>
                                                <label for='profile-phone'><?php echo trans('forms.enter_password'); ?>
                                                    <font style="color:red;">*</font>
                                                </label>
                                                <input class='form-control form-group-border' placeholder=''
                                                    type='password' required name="pass"
                                                    data-parsley-trigger='blur focusout change'
                                                    data-parsley-required-message="This field is required.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class='form-group mt-2'>
                                <button class='btn btn-outline btn-outline-default btn-radius' type='submit'>
                                    <?php echo trans('forms.close_account'); ?>
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
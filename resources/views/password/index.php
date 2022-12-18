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
                        <h5 class="main-heading pull-left">
                            <?php echo trans('profile.password'); ?></h5>
                        <p class="pull-right mb-0">
                            <font style="color:red;">*</font>
                            <?php echo trans('profile.indicates_required_fields'); ?>
                        </p>
                    </div>
                    <div class="card-body">
                        <form class='rider__sign parsley__form__validate' data-parsley-validate='' action=""
                            method="post">
                            <?php echo csrf_field(); ?>
                            <!-- / Personal Information -->
                            <!--<h5 class='f-500 mb-2'>Basic Details:</h5>-->

                            <div class='row'>

                                <div class='col-12 col-md-6'>
                                    <div class='form-group'>
                                        <label for='profile-phone'><?php echo trans('forms.current_password'); ?>
                                            <font style="color:red;">*</font>
                                        </label>
                                        <input class='form-control form-group-border' placeholder='' type='password'
                                            required name="pass" data-parsley-trigger='blur focusout change'
                                            data-parsley-required-message="If you want to update your password, this field is required.">
                                    </div>
                                </div>
                                <div class='col-12 col-md-6'>
                                    <div class='form-group'>
                                        <label for='profile-phone'><?php echo trans('forms.new_password'); ?>
                                            <font style="color:red;">*</font>
                                        </label>
                                        <input class='form-control form-group-border' placeholder='' type='password'
                                            required name="pass1" data-parsley-trigger='blur focusout change'
                                            data-parsley-required-message="If you want to update your password, this field is required.">
                                    </div>
                                </div>
                                <div class='col-12 col-md-6'>
                                    <div class='form-group'>
                                        <label for='profile-phone'><?php echo trans('forms.confirm_new_password'); ?>
                                            <font style="color:red;">*</font>
                                        </label>
                                        <input class='form-control form-group-border' placeholder='' type='password'
                                            required name="pass2" data-parsley-trigger='blur focusout change'
                                            data-parsley-required-message="If you want to update your password, this field is required.">
                                    </div>
                                </div>

                            </div>

                            <div class='form-group mt-2'>
                                <button class='btn btn-outline btn-outline-default btn-radius' type='submit'>
                                    <?php echo trans('forms.update'); ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include(app_path() . '/common/footer.php'); ?>
<script src="<?php echo url('javascripts/libs/parsley.min.js'); ?>"></script>


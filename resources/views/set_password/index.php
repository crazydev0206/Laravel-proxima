<?php include(app_path().'/common/header.php'); ?>
<style>
    input[type="text"] {
    border-radius: .25rem;
}
    
    .btn-outline-default{
            background: #394d5b;
            color: white;
        }
        
        ul.sign__up__role li .role-icon{
            border-radius: 0px;
        }
</style>

<div class='body__content'>
<div class='page__sign__up page__common p-100'>
<div class='container'>
<div class='row'>
<div class='col-12 col-md-10 col-lg-8 col-xl-7 mr-auto ml-auto'>
<div class='row'>
<div class='col-12'>
<h3 class='text-center f-700 mb-4'><?php echo trans('account.reset_password'); ?></h3>
    <?php if(Session::has('success') AND Session::get('success')!='') { ?>
    <p class="alert alert-success"><?php echo Session::get('success'); ?></p>
    <?php } ?>
    <?php if(Session::has('error')) { ?>
    <p class="alert alert-danger"><?php echo Session::get('error'); ?></p>
    <?php } ?>
</div>
</div>
<div class='row'>
<div class='col-12'></div>
</div>
<!-- / Normal sign in/up section -->
<div class='row'>
<div class='col-12'>
<form class='rider__sign parsley__form__validate' data-parsley-validate='' action="" method="post">
    <?php echo csrf_field(); ?>
<div class='form-group'>
<div class='input-group input-group-s-append'>
<input class='form-control' placeholder='<?php echo trans('account.choose_password'); ?>' type="password" required name="pass1" data-parsley-trigger='blur focusout change' data-parsley-errors-container='#parsley-password-error' data-parsley-pattern="/^[\w@-]{8,}$/" data-parsley-pattern-message="Password must contain a minimum of 8 characters." autocomplete="new-password" autofill="no" data-parsley-required-message="This field is required." id="pass1">
<span class='input-group-append'>
<span class='input-group-text'><img src="<?php echo url('images/27-password-fixed.png'); ?>" style="max-width:22px; max-height:100%;"></span>
</span>
</div>
</div>
    <div id='parsley-password-error'></div>
    <p class="alert alert-danger pt-1 pb-1" style="display:none;" id="pass_error"></p>
<div class='form-group'>
<div class='input-group input-group-s-append'>
<input class='form-control' placeholder='<?php echo trans('account.confirm_password'); ?>' type="password" name="pass2" data-parsley-trigger='blur focusout change' data-parsley-errors-container='#parsley-confirm-password-error' required id="pass2" data-parsley-equalto="#pass1" data-parsley-equalto-message="<?php echo trans('account.password_not_match'); ?>" autocomplete="no" autofill="no" data-parsley-required-message="This field is required.">
<span class='input-group-append'>
<span class='input-group-text'><img src="<?php echo url('images/27-password-fixed.png'); ?>" style="max-width:22px; max-height:100%;"></span>
</span>
</div>
</div>
    <div id='parsley-confirm-password-error'></div>
    <p class="alert alert-danger pt-1 pb-1" style="display:none;" id="pass_error2"></p>
<div class='form-group'>
<!-- / reCaptch -->
</div>
<div class='form-group text-center'>
<button class='btn btn-outline btn-outline-default btn-c-transition btn-radius' type='submit'>
<?php echo trans('account.submit'); ?>
</button>
</div>
<div class='hr-or text-center'>
<span class='or-text'><?php echo trans('account.or'); ?></span>
</div>
<div class='form-group'>
<p class='text-center'>
<a href='<?php echo url('signin'); ?>'><?php echo trans('account.login_now'); ?></a>
</p>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>

</div>

<?php include(app_path().'/common/footer.php'); ?>
<script src="<?php echo url('javascripts/libs/parsley.min.js'); ?>"></script>
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

    @media only screen and (max-width: 460px) {
        ul.social__media__signup li {
            flex-basis: 22% !important;
        }
    }

    .error_under {
        padding: 0px !important;
        margin-top: 10px;
        padding-left: 10px !important;
        padding-top: 3px !important;
        padding-bottom: 3px !important;
    }

    .form-control {

        outline: none !important;
        border: 1 px solid #aaa !important;
    }

    .rider__sign .form-control {
        border-color: #e9e9e9 !important;
    }

    .rider__sign .error {

        border: 1px solid red !important;
    }
</style>

<div class='body__content'>
    <div class='page__sign__up page__common p-100 pt-5'>
        <div class='container'>
            <div class='row'>
                <div class='col-12 col-md-10 col-lg-8 col-xl-7 mr-auto ml-auto'>
                    <div class='row'>
                        <div class='col-12'>
                            <h3 class='text-center f-700 mb-0'><?php echo trans('account.create_an_account', [], $languageSet); ?></h3>
                            <p class='text-center mb-30' style="font-size: 16px; font-weight: 400; color: #2d4653;"></p>
                            <?php if (Session::has('success')) { ?>
                                <p class="alert alert-success"><?php echo Session::get('success'); ?></p>
                            <?php } ?>
                            <?php if (Session::has('error')) { ?>
                                <p class="alert alert-danger"><?php echo Session::get('error'); ?></p>
                            <?php } ?>
                            <div class='hr-or text-center login-or'>
                                <span class='or-text'><?php echo trans('account.use_social_media', [], $languageSet); ?></span>
                            </div>
                            <!-- / Social media login information -->
                            <ul class='social__media__signup ul__list'>
                                <li>
                                    <a href='<?php echo url('facebook-redirect'); ?>' style="text-decoration: none;">
                                        <img src="<?php echo url('images/social-media/fb.svg'); ?>" alt="Facebook" style="max-width:28px; max-height:28px;" />
                                        <span class='text'></span>
                                    </a>
                                </li>
                                <li>
                                    <a href='<?php echo url('linkedin-redirect'); ?>' style="text-decoration: none;">
                                        <img src="<?php echo url('images/social-media/ln.svg'); ?>" alt="Google" style="max-width:28px; max-height:28px;" />
                                        <span class='text'></span>
                                    </a>
                                </li>
                                <li>
                                    <a href='<?php echo url('google-redirect'); ?>' style="text-decoration: none;">
                                        <img src="<?php echo url('images/social-media/google.svg'); ?>" alt="Google" style="max-width:28px; max-height:28px;" />
                                        <span class='text'></span>
                                    </a>
                                </li>
                                </li>
                                <li>
                                    <a href='<?php echo url('instagram-redirect'); ?>' style="text-decoration: none;">
                                        <img src="<?php echo url('images/social-media/instagram.png'); ?>" alt="Facebook" style="max-width:28px; max-height:28px;" />
                                        <span class='text'></span>
                                    </a>
                                </li>
                                <li>
                                    <a href='<?php echo url('tiktok-redirect'); ?>' style="text-decoration: none;">
                                        <img src="<?php echo url('images/social-media/icons8-tiktok.svg'); ?>" alt="Facebook" style="max-width:28px; max-height:28px;" />
                                        <span class='text'></span>
                                    </a>
                                </li>
                                <li>
                                    <a href='<?php echo url('snapchat-redirect'); ?>' style="text-decoration: none;">
                                        <img src="<?php echo url('images/social-media/icons8-snapchat.svg'); ?>" alt="Facebook" style="max-width:28px; max-height:28px;" />
                                        <span class='text'></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class='hr-or text-center'>
                        <span class='or-text'><?php echo trans('account.or', [], $languageSet); ?></span>
                    </div>
                    <div class='row'>
                        <div class='col-12'></div>
                    </div>
                    <!-- / Normal sign in/up section -->
                    <div class='row'>
                        <div class='col-12'>
                            <p class='text-center'><?php echo trans('account.signup_with_email', [], $languageSet); ?></p>



                            <div class="alert alert-danger" id="errorShow" style="display:none;">
                                Please enter your email
                            </div>



                            <form class='rider__sign'>
                                <?php echo csrf_field(); ?>

                                <div class='form-group'>
                                    <input class='form-control' name='first_name' placeholder='<?php echo trans('account.first_name', [], $languageSet); ?>' value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" id="first_name">
                                    <div class="alert alert-danger error_under" id="fn_error" style="display:none;">
                                        Please enter your first name
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <input class='form-control' name='last_name' id="last_name" placeholder='<?php echo trans('account.last_name', [], $languageSet); ?>' required type="text">
                                    <div class="alert alert-danger error_under" id="ln_error" style="display:none;">
                                        Please enter your last name
                                    </div>
                                </div>
                                <div id='parsley-first-name-error'></div>
                                <div class='form-group'>
                                    <div class='input-group input-group-s-append' id="emailGroup">
                                        <input class='form-control' placeholder='<?php echo trans('account.email', [], $languageSet); ?>' name="email" required type="email" id="email" autocomplete="no" autofill="no">
                                        <span class='input-group-append'>
                                            <span class='input-group-text'><img src="<?php echo url('images/20-at-sign.png'); ?>" style="max-width:22px; max-height:100%;"></span>
                                        </span>
                                    </div>
                                    <div class="alert alert-danger error_under" id="error_email" style="display: none;">

                                    </div>
                                </div>
                                <div id='parsley-username-error'></div>
                                <p class="alert alert-danger pt-1 pb-1" style="display:none;" id="error2"></p>
                                <div class='form-group'>
                                    <div class='input-group input-group-s-append'>
                                        <input class='form-control' placeholder='<?php echo trans('account.choose_password', [], $languageSet); ?>' type="password" data-parsley-trigger='blur focusout change' data-parsley-errors-container='#parsley-password-error' name="pass1" required id="pass1" data-parsley-pattern="/^[\w@-]{8,}$/" data-parsley-pattern-message="<?php echo url('account.password_must_contain'); ?>" autocomplete="new-password" autofill="no" data-parsley-required-message="<?php echo trans('account.field_required', [], $languageSet); ?>">
                                        <span class='input-group-append'>
                                            <span class='input-group-text'><img src="<?php echo url('images/27-password-fixed.png'); ?>" style="max-width:22px; max-height:100%;"></span>
                                        </span>
                                    </div>
                                </div>
                                <div id='parsley-password-error'></div>
                                <p class="alert alert-danger pt-1 pb-1" style="display:none;" id="pass_error"></p>

                                <div class='form-group'>
                                    <div class='input-group input-group-s-append'>
                                        <input class='form-control' placeholder='<?php echo trans('account.confirm_password', [], $languageSet); ?>' type="password" name="pass2" data-parsley-trigger='blur focusout change' data-parsley-errors-container='#parsley-confirm-password-error' required id="pass2" data-parsley-equalto="#pass1" data-parsley-equalto-message="The passwords do not match." autocomplete="no" autofill="no" data-parsley-required-message="<?php echo trans('account.field_required', [], $languageSet); ?>">
                                        <span class='input-group-append'>
                                            <span class='input-group-text'><img src="<?php echo url('images/27-password-fixed.png'); ?>" style="max-width:22px; max-height:100%;"></span>
                                        </span>
                                    </div>
                                </div>
                                <div id='parsley-confirm-password-error'></div>
                                <p class="alert alert-danger pt-1 pb-1" style="display:none;" id="pass_error2"></p>

                                <div class='form-group'>
                                    <label class='form-control-checkbox'>
                                        <input type='checkbox' id="terms" required name="terms" value="1" data-parsley-required-message="Please agree to our terms and conditions to continue.">
                                        <?php echo trans('account.read_and_accepted'); ?>
                                    </label>
                                </div>

                                <center>
                                    <div class='form-group'>
                                        <div class="g-recaptcha" data-sitekey="6LfAGWciAAAAAJUGyZjA1fssjZars2CVnw3JBdWv" style="display: inline-block;"></div>
                                        <div id="g-recaptcha-error"></div>
                                    </div>
                                </center>

                                <div class='form-group text-center'>
                                    <p class="alert alert-danger" style="display:none;" id="error"></p>
                                    <button class='btn btn-outline btn-outline-default btn-c-transition btn-radius' type='button' id="submit_btn">
                                        <?php echo trans('account.signup', [], $languageSet); ?>
                                    </button>
                                </div>
                                <div class='hr-or text-center'>
                                    <span class='or-text'><?php echo trans('account.or', [], $languageSet); ?></span>
                                </div>
                                <div class='form-group'>
                                    <p style="font-family:  'futura', sans-serif;font-size: 22px !important;" class="mt-3 text-center">Already have an account? <a style="font-weight: 700;text-decoration: none;" class="text-primary" href="<?= url('/login'); ?>">Sign in </a>now</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<style type="text/css">
    .box {
        min-height: 50px;
        border: 1px solid #e9e9e9;
    }

    .box:hover {
        border: 1px solid #077DD5;
        color: #077DD5;
    }

    .boxActive {

        border: 1px solid #077DD5;
        color: #077DD5;


    }
</style>



<div class="modal" id="typeStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                        <h3>Select Your Account Type</h3>
                        <p>Select whether you want to use your account as a passenger or driver?</p>

                        <div class="box boxActive" data-type="passenger">

                            <h3 style="padding-top: 25px;padding-bottom: 25px;text-align: center;">Passenger</h3>

                        </div>
                        <div class="box" style="margin-top:20px;" data-type="driver">

                            <h3 style="padding-top: 25px;padding-bottom: 25px;text-align: center;">Driver</h3>

                        </div>
                        <div style="text-align: center;margin-top: 20px;">
                            <button class='btn btn-outline btn-outline-default btn-c-transition btn-radius' type='button' id="completeProcess">
                                Complete Registration
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<script>
    function submitUserForm() {
        var response = grecaptcha.getResponse();
        if (response.length == 0) {
            document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">This field is required.</span>';
            return false;
        }
        return true;
    }

    function verifyCaptcha() {
        document.getElementById('g-recaptcha-error').innerHTML = '';
    }
</script>
<?php include(app_path() . '/common/footer.php'); ?>

<script src="<?php echo url('javascripts/libs/parsley.min.js'); ?>"></script>

<script>
    function recaptchaCallback() {
        if (grecaptcha && grecaptcha.getResponse().length !== 0) {
            $("#captcha-error").hide();
            $("#submit_btn").attr('disabled', false);
        }
    }

    function check_password() {
        var pass1 = $("#pass1").val();

        if (!(pass1.match("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$"))) {
            $("#pass_error").text('<?php echo url('account.password_must_contain'); ?>');
            $("#pass_error").show();
            return false;
        } else $("#pass_error").hide();

        return true;
    }

    function match_password() {
        var pass1 = $("#pass1").val();
        var pass2 = $("#pass2").val();
        if (pass1 != pass2) {
            $("#pass_error2").text('Passwords did not match.');
            $("#pass_error2").show();
            return false;
        } else $("#pass_error2").hide();

        return true;
    }

    function check_data(th) {
        //var check=check_password();
        //var match=match_password();

        //if(!check) return false;

        $("#error").hide();

        if (grecaptcha && grecaptcha.getResponse().length !== 0) {
            $("#captcha-error").hide();
        } else {
            $("#captcha-error").show();
            return false;
        }

        if ($(th).parsley().isValid()) {
            // show alert message
            //alert('no client side errors!');
            $("#submit_btn").attr('disabled', true);
            return true;
        }

        $("#submit_btn").attr('disabled', false);
        return false;

        $("#submit_btn").attr('disabled', false);
        return true;

        var atLeastOneIsChecked = $('input[name="type"]:checked').length > 0;

        if (!atLeastOneIsChecked) {
            $("#error").text('Please select account type first.');
            $("#error").show();
            return false;
        }

        var phone = $("#phone_field").val().replace(/[^0-9]/gi, '');
        var lng = phone.length;
        if (parseInt(lng) < 10) {
            $("#error").text('Phone number must be of 10 digits.');
            $("#error").show();
            return false;
        }

    }
</script>


<script type="text/javascript">
    let type = "passenger";


    $("#submit_btn").click(function() {



        var fn = $("#first_name").val();
        var ln = $("#last_name").val();
        var email = $("#email").val();
        var pass = $("#pass1").val();
        var confirmpass = $("#pass2").val();
        var checkEmail = validateEmail(email);
        $(".form-control").removeClass('error');
        $(".form-control").parent().removeClass('error');
        var terms = $("#terms");
        var response = grecaptcha.getResponse();

        if (fn == "") {

            $("#first_name").addClass('error');
            showError("Please enter your first name", "#first_name");

        } else if (ln == "") {

            $("#last_name").addClass('error');
            showError("Please enter your last name", "#last_name");
        } else if (email == "") {

            $("#email").parent().addClass('error');
            showError("Please enter your email address", "#email");
        } else if (checkEmail == false) {
            $("#email").parent().addClass('error');
            showError("Please check your email address", "#email");
        } else if (pass == "") {

            $("#pass1").parent().addClass('error');
            showError("Please enter your password", "#pass1");

        } else if (confirmpass == "") {

            $("#pass2").parent().addClass('error');
            showError("Please enter your confirm password", "#pass2");

        } else if (pass != confirmpass) {

            $("#pass1").parent().addClass('error');
            $("#pass2").parent().addClass('error');
            showError("The passwords you entered do not match", "#pass1");

        } else if (pass.length < 8) {

            $("#pass1").parent().addClass('error');
            $("#pass2").parent().addClass('error');
            showError("Password must contain no less than 8 characters", "#pass1");

        } else if (!$("#terms").is(':checked')) {

            showError("Please accept our terms and policies", null);

            $('html, body').animate({
                scrollTop: $("#errorShow").offset().top
            }, 300);

        } else if (response == null || response == "") {

            showError("Prove that you are a human, check the recaptcha", null);

        } else {

            $("#errorShow").hide();
            $("#errorShow").html("");

            $("#submit_btn").html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');



            var url = '<?= url('api/user_register'); ?>';

            var token = '<?php echo csrf_token(); ?>';

            $.post(url, {
                email: email,
                fn: fn,
                ln: ln,
                type: 1,
                pass: pass,
                "_token": token
            }, function(data) {

                console.log(data);


                if (data.result == 'failed') {

                    var msg = data.msg;


                    setTimeout(function() {


                        showError("This email is already used", "#email");


                        $("#submit_btn").html("Sign up");

                    }, 2000);





                } else if (data.result == "success") {


                    var dialog = $.confirm({
                        title: 'Registration Successful',
                        content: 'Your signup was successful. Please check your Inbox to verify your email address.\nCheck your Spam folder as well. You never know :)',
                        icon: 'fa fa-check',
                        type: 'green',
                        typeAnimated: true,
                        theme: 'modern',
                        buttons: {

                            somethingElse: {
                                text: 'Close',
                                btnClass: 'btn-green',
                                action: function() {

                                    location.href = "login";
                                }
                            }
                        }
                    });


                } else {

                    setTimeout(function() {


                        var dialog = $.confirm({
                            title: 'Error',
                            content: "Server error occured. Please contact administrator of website.",
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


                        $("#submit_btn").html("Sign up");

                    }, 2000);


                }

            }).fail(function() {

                var dialog = $.confirm({
                    title: 'Error',
                    content: "Server error occured. Please contact administrator of website.",
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


                $("#submit_btn").html("Sign up");


            });





        }

    });


    function showError(message, id) {
        $("#errorShow").show();
        $("#errorShow").html(message);
        $(id).focus();

        $('html, body').animate({
            scrollTop: $("#errorShow").offset().top
        }, 300);
    }

    function validateEmail(email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (!emailReg.test(email)) {
            return false;
        } else {
            return true;
        }
    }
</script>

<script type="text/javascript">
    $(".box").click(function() {

        type = $(this).attr('data-type');

        $(".box").removeClass('boxActive');

        $(this).addClass('boxActive');

    });
</script>
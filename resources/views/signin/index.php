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

    .login-or span:after,
    .login-or span:before {
        width: calc(50% - 45px);
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
</style>

<div class='body__content'>
    <div class='page__sign__up page__common p-100 pt-5'>
        <div class='container'>
            <div class='row'>
                <div class='col-12 col-md-10 col-lg-8 col-xl-7 mr-auto ml-auto'>
                    <div class='row'>
                        <div class='col-12'>
                            <h3 class='text-center f-700 mb-4'><?php echo trans('account.welcome_to_proximaride', [], $languageSet) ?></h3>
                            <div class='hr-or text-center login-or'>
                                <span class='or-text'><?php echo trans('account.continue_with', [], $languageSet) ?></span>
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
                        <span class='or-text'><?php echo trans('account.or', [], $languageSet) ?></span>
                    </div>
                    <!-- / Normal sign in/up section -->
                    <div class='row'>
                        <div class='col-8 offset-2'>

                            <div class="alert alert-danger" id="error" style="display:none;">
                                Email not found
                            </div>

                            <div class="form-group">

                                <div class='input-group input-group-s-append' id="emailGroup">
                                    <input class='form-control' placeholder='<?php echo trans('account.email', [], $languageSet); ?>' name="email" required type="email" id="email" autocomplete="no" autofill="no" style="border-right: none!important;">
                                    <span class='input-group-append' style="background-color: #fff !important;">
                                        <span class='input-group-text' style="background-color: #fff !important;border-left: none !important;"><img src="<?php echo url('images/20-at-sign.png'); ?>" style="max-width:22px; max-height:100%;"></span>
                                    </span>
                                </div>

                            </div>


                            <div class="form-group">

                                <div class='input-group input-group-s-append'>
                                    <input class='form-control' placeholder='<?php echo trans('account.choose_password', [], $languageSet); ?>' type="password" name="pass1" required id="password" style="border-right: none !important;">
                                    <span class='input-group-append'>
                                        <span class='input-group-text' style="background-color: #fff !important;border-left: none !important;"><img src="<?php echo url('images/27-password-fixed.png'); ?>" style="max-width:22px; max-height:100%;"></span>
                                    </span>
                                </div>

                            </div>



                            <div class="row">


                                <div class="col-md-7" style="padding-top:8px;">

                                    <a class="text-primary" href="<?= url('forgot-password'); ?>" style="font-weight: 700;text-decoration: none;margin-top: 15px;font-size: 18px;font-family: 'futura', sans-serif;">Forgot your password?</a>

                                </div>

                                <div class="col-md-5 text-right">
                                    <button class="btn btn-outline btn-outline-default btn-c-transition btn-radius" id="login"><?php echo trans('account.login', [], $languageSet) ?></button>
                                </div>


                            </div>

                            <div class="row">

                                <div class="col-md-12 text-center">
                                    <p style="font-size: 18px !important;" class="mt-3">Don't have an account yet? <a style="font-weight: 700;text-decoration: none;font-family:  'futura', sans-serif;" class="text-primary" href="<?= url('/signup'); ?>">Sign up </a>now</p>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include(app_path() . '/common/footer.php'); ?>
<script src="<?php echo url('javascripts/libs/parsley.min.js'); ?>"></script>


<script type="text/javascript">

    $("#login").click(function() {

        var btn = $(this);

        var oldhtml = $(this).html();

        var email = $("#email").val();

        var password = $("#password").val();


        if (email == "") {
            showErrorDialog('Please enter your email address');

            // $("#error").show();
            // $("#error").html("Please enter your email address");
        } else if (password == "") {
            showErrorDialog('Please enter your password');

            // $("#error").show();
            // $("#error").html("Please enter your password");

        } else {


            var url = '<?= url('/api/user/login'); ?>';

            var token = '<?php echo csrf_token(); ?>';

            btn.html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');

            $.post(url, {
                "_token": token,
                email: email,
                password: password
            }, function(data) {

                setTimeout(function() {

                    if (data.result == "failed") {

                        var msg = data.msg;

                        btn.html(oldhtml);

                        if (data.error == 'email_verified') {
                                  var dialog = $.confirm({
                                        title: 'Error',
                                        content: msg,
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
                                            },

                                        
                                            resendEmail: {
                                                text: 'Send the email again',
                                                btnClass: 'btn-primary',
                                                action: function() {

                                                    let r = '<?= url('/api/resend_verification'); ?>';
                                                    $.post(r, {
                                                        "_token": token,
                                                        email: email
                                                    }, function(data) {
                                                        
                                                        if(data.result == 'success'){
                                                            $.confirm({
                                                                title: 'Email sent',
                                                                content: data.msg,
                                                                icon: 'fa fa-check',
                                                                type: 'green',
                                                                typeAnimated: true,
                                                                theme: 'modern',
                                                                buttons: {

                                                                    se: {
                                                                        text: 'Okay',
                                                                        btnClass: 'btn-green',
                                                                        action: function() {
                                                                            dialog.close()
                                                                        }
                                                                    }
                                                                }
                                                            
                                                            });
                                                        }
                                                    });
                                                }
                                            }
                                        }
                                    });
                        }
                        else {
                            showErrorDialog(msg)  

                        }
                        

                    } else if (data.result == "success") {

                        var msg = data.msg;
                        var step = data.step;

                        var dialog = $.confirm({
                            title: 'Login successful',
                            content: msg,
                            icon: 'fa fa-check',
                            type: 'green',
                            typeAnimated: true,
                            theme: 'modern',
                            buttons: {

                                somethingElse: {
                                    text: 'Proceed',
                                    btnClass: 'btn-green',
                                    action: function() {
                                        if (step == 0) {

                                            step = 1;
                                        }

                                        if (step == "6") {

                                            var url = '<?= url('/dashboard'); ?>';

                                            location.href = url;


                                        } else {

                                            var url = '<?= url('/step/'); ?>';

                                            url = url + "/" + step;

                                            location.href = url;

                                        }
                                    }
                                }
                            }
                        });

                    }


                }, 3000);



            });



        }



    });


    showError();

    function showError() {
        let status =  "<?php echo Session::get('result')?>";
        let msg = "<?php echo Session::get('message'); ?>"

        // console.log(status);
        if(status === 'error' ){

        // setTimeout(() => {
                let dialog = $.confirm({
                    title: 'Error',
                    content: msg,
                    icon: 'fa fa-exclamation-circle',
                    type: 'red',
                    typeAnimated: true,
                    theme: 'modern',
                    buttons: {

                        somethingElse: {
                            text: 'Close',
                            btnClass: 'btn-red',
                            action: function() {

                                '<?= Session::forget('result'); ?>';
                                // let url = '<?= url('/api/clear-error'); ?>';;
                                // $.post(url, {
                                //     "_token": token,
                                // });
                                dialog.close();
                            }
                        }
                    }
                });
            // }, 1000);
        }
    }
</script>
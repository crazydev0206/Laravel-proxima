<?php include(app_path().'/common/header.php'); ?>
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
</style>

<div class='body__content'>
    <div class='page__sign__up page__common p-100'>
        <div class='container'>
            <div class='row'>
                <div class='col-12 col-md-10 col-lg-8 col-xl-7 mr-auto ml-auto'>
                    <div class='row'>
                        <div class='col-12'>
                            <h3 class='text-center f-700 mb-0'><?php echo trans('account.forgot_password'); ?></h3>
                            <p class='text-center mb-30' style="font-size: 16px; font-weight: 400; color: #2d4653;">
                                <?php echo trans('account.will_send_instructions') ?></p>
                            <?php if(Session::has('success')) { ?>
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
                        <div class='col-8 offset-2'>
                            <form class='rider__sign parsley__form__validate' action="" method="post">
                                <?php echo csrf_field(); ?>

                                <div class='form-group'>
                                    <div class='input-group input-group-s-append'>
                                        <input id="email" class='form-control'
                                            placeholder='<?php echo trans('account.your_email') ?>' type="email"
                                            required name="email">
                                        <span class='input-group-append'>
                                            <span class='input-group-text'><img
                                                    src="<?php echo url('images/20-at-sign.png'); ?>"
                                                    style="max-width:22px; max-height:100%;"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <!-- / reCaptch -->
                                </div>
                                <div class='form-group text-center'>
                                    <button class='btn btn-outline btn-outline-default btn-c-transition btn-radius'
                                        type='button' id="sendForgotEmail">
                                        <?php echo trans('account.send') ?>
                                    </button>
                                </div>
                                <div class='hr-or text-center'>
                                    <span class='or-text'>Or</span>
                                </div>
                                <div class='form-group'>
                                    <p class='text-center'>
                                        <a
                                            href='<?php echo url('signin'); ?>'><?php echo trans('account.login_now') ?></a>
                                    </p>
                                    <p class='text-center'>
                                        <?php echo trans('account.not_member_yet') ?><br>
                                        <a
                                            href='<?php echo url('signup'); ?>'><?php echo trans('account.create_account') ?></a>
                                        <?php echo trans('account.only_takes_minutes'); ?>
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


<script type="text/javascript">
$("#sendForgotEmail").click(function() {

    var email = $("#email").val();

    var forgoturl = '<?=url('/api/forgot'); ?>';

    var token = '<?php echo csrf_token(); ?>';

    if (email == '') {
        showErrorDialog('Please input your email address');
    } else {
        $.post(forgoturl, {
            "_token": token,
            email: email
        }, function(data) {


            console.log(data);

            if (data.result == "failed") {

                var dialog = $.confirm({
                    title: 'Error',
                    content: "Email not found",
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



            } else {

                var dialog = $.confirm({
                    title: 'Email sent successfully',
                    content: 'An email has been sent to your registered email address. Please follow instruction to reset your password',
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

            }

        });
    }



});
</script>
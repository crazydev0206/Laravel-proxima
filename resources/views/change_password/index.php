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
                            <h3 class='text-center f-700 mb-0'>Change your password</h3>


                        </div>
                    </div>
                    <div class='row' style="margin-top:30px;">
                        <div class='col-12'></div>
                    </div>
                    <!-- / Normal sign in/up section -->
                    <div class='row'>
                        <div class='col-8 offset-2'>
                            <form class='rider__sign parsley__form__validate' action="" method="post">
                                <?php echo csrf_field(); ?>

                                <div class='form-group'>
                                    <div class='input-group input-group-s-append'>
                                        <input id="pass" class='form-control' placeholder='Select a new password'
                                            type="password" required name="email">
                                        <span class='input-group-append'>
                                            <span class='input-group-text'><img
                                                    src="<?php echo url('images/27-password-fixed.png'); ?>"
                                                    style="max-width:22px; max-height:100%;"></span>
                                        </span>
                                    </div>
                                </div>


                                <div class='form-group' style="margin-top:20px;">
                                    <div class='input-group input-group-s-append'>
                                        <input id="cpass" class='form-control' placeholder='Confirm your new password'
                                            type="password" required name="email">
                                        <span class='input-group-append'>
                                            <span class='input-group-text'><img
                                                    src="<?php echo url('images/27-password-fixed.png'); ?>"
                                                    style="max-width:22px; max-height:100%;"></span>
                                        </span>
                                    </div>
                                </div>





                                <div class="alert alert-danger" id="error" style="display: none;">
                                    Error
                                </div>


                                <div class='form-group'>
                                    <!-- / reCaptch -->
                                </div>
                                <div class='form-group text-center'>
                                    <button class='btn btn-outline btn-outline-default btn-c-transition btn-radius'
                                        type='button' id="sendForgotEmail">
                                        Submit
                                    </button>
                                </div>
                                <div class='hr-or text-center'>
                                    <span class='or-text'>Or</span>
                                </div>
                                <div class='form-group'>
                                    <p class='text-center text-primary'
                                        style="font: normal 14px/1.5 'Futura', san-serif;">
                                        <a
                                            href='<?php echo url('signin'); ?>'><?php echo trans('account.login_now') ?></a>
                                    </p>
                                    <p class='text-center text-primary'
                                        style="font: normal 14px/1.5 'Futura', san-serif;">
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

    var uid = '<?=$change_password_uid; ?>';

    var pass = $("#pass").val();

    var cpass = $("#cpass").val();

    if (pass == "") {

        showErrorDialog('Please enter your password');
        // error("Please enter your password");
    } else if (cpass == "") {
        showErrorDialog('Please confirm your password');

        // error("Please confirm your password");
    } else if (pass != cpass) {
        showErrorDialog('Your both password doesnt matches');

        // error("Your both password doesnt matches");
    } else {

        var url = '<?= url('/api/changeYourPassword'); ?>';

        var token = '<?php echo csrf_token(); ?>';

        $.post(url, {
            pass: pass,
            "_token": token,
            uid: uid
        }, function(data) {

            if (data.status == 'success') {

                var dialog = $.confirm({
                    title: 'Successful',
                    content: 'Your password has been changed successfully',
                    icon: 'fa fa-check',
                    type: 'green',
                    typeAnimated: true,
                    theme: 'modern',
                    buttons: {

                        somethingElse: {
                            text: 'Close',
                            btnClass: 'btn-green',
                            action: function() {
                                var url = '<?php echo  url('/login'); ?>';

                                location.href = url;
                            }
                        }
                    }
                });



            } else {
                showErrorDialog(data.msg);
            }



        });

    }


});

function error(msg) {
    $("#error").show();
    $("#error").html(msg);
}
</script>
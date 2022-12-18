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
    
    .parsley__form__validate .parsley-errors-list.filled {
  list-style: none;
  padding: 5px 10px;
  margin-top: 12px;
  background: #1d82d0;
  position: relative; }
  .parsley__form__validate .parsley-errors-list.filled:before {
    content: "";
    position: absolute;
    background: #1d82d0;
    width: 9px;
    height: 9px;
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    top: -5px;
    left: 8px; }
  .parsley__form__validate .parsley-errors-list.filled li {
    color: #fff; }
    .parsley__form__validate .parsley-errors-list.filled li + li {
      margin-top: 3px; }

.parsley__form__validate .sign__up__role__wrapper .parsley-errors-list.filled {
  margin-top: -19px; }
    
    .login-or span:after, .login-or span:before {
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
</style>

<div class='body__content'>
<div class='page__sign__up page__common p-100 pt-5'>
<div class='container'>
<div class='row'>
<div class='col-12 col-md-10 col-lg-8 col-xl-7 mr-auto ml-auto'>
<div class='row'>
<div class='col-12'>
<h5 class='text-center f-700 mb-4' style="font-size:19px;">We have sent a link to <?php echo $user_verify->email; ?> Please check on it to verify your email</h5>
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
<div class='col-12 text-center'>
    <img src="<?php echo url('images/19-email-beige-letter.png'); ?>" style="max-width:150px; margin-bottom:20px;"><br>
    <a href="javascript:void(0)" data-toggle="modal" data-target="#why-needed">Why do I need to verify my email?</a>
    
    <p class="alert alert-success mt-4 mb-0 ml-auto mr-auto" style="max-width:300px; display:none;" id="success">Verification email sent successfully.</p>
    
    <div class="ml-auto mr-auto" style="border:1px solid black; padding-bottom:40px; padding-top:5px; margin-top:30px; font-weight:bold; max-width:270px; border-top:4px solid black; padding-left:5px; padding-right:5px;">
        <p style="color:inherit; font-size:14px !important;">Did not get the email?</p>
        <p style="color:inherit; font-size:14px !important;">Check your spam or junk folder</p>
        
        <a href="javascript:void(0)" style="color:inherit; text-decoration:underline;" onclick="send_email2(this)">Send again</a><br>
        <a href="javascript:void(0)" style="color:inherit; text-decoration:underline;" onclick="$(this).next().show(); $(this).hide();">Use a different email</a>
        
        <form class='rider__sign parsley__form__validate' data-parsley-validate='' action="" method="post" style="display:none; margin-top:20px;" id="new_email">
        <?php echo csrf_field(); ?>
            
        <div class='form-group form-group-border'>
            <div class='input-group input-group-s-append'>
                <input class='form-control' placeholder='Email' name="email" data-parsley-trigger='blur focusout change' data-parsley-errors-container='#parsley-username-error' required type="email" id="email" onblur="check_email();" value="<?php echo $user_verify->email; ?>" autocomplete="no" autofill="no">
                <span class='input-group-append'>
                    <span class='input-group-text'><img src="<?php echo url('images/20-at-sign.png'); ?>" style="max-width:22px; max-height:100%;"></span>
                </span>
            </div>
        </div>
            
    <div id='parsley-username-error'></div>
    <p class="alert alert-danger pt-1 pb-1" style="display:none;" id="error2"></p>
            <div class='form-group text-center'>
    <p class="alert alert-danger" style="display:none;" id="error"></p>
<button class='btn btn-outline btn-outline-default btn-c-transition btn-radius' type='submit' id="submit_btn">
Submit
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

</div>

<?php include(app_path().'/common/footer.php'); ?>
<script src="<?php echo url('javascripts/libs/parsley.min.js'); ?>"></script>
<script>
    $("#new_email").submit(function(e){
        e.preventDefault();
        
        var email=$("#email").val();
        var formData=new FormData();
        var token='<?php echo csrf_token(); ?>';
        formData.append('_token', token);
        formData.append('email', email);
        
        $.ajax({
                url: "<?php echo url('update-email') ?>",
                type: "POST",
                data:  formData,
                beforeSend: function(){ //alert('sending');
                    $("#submit_btn").attr('disabled', true);
                },
                contentType: false,
                processData:false,
                success: function(data) { //alert(data);
                    //success
                    // here we will handle errors and validation messages
                    if ( ! data.success) {
                    } else {
                        // ALL GOOD! just show the success message!
                        $("#submit_btn").attr('disabled', true);
                        window.location='';
                    }
                },
                error: function()  {
                    //error
                } 	        
        });
    });
    
    function check_email()
    {
        var email=$("#email").val();
        var formData=new FormData();
        var token='<?php echo csrf_token(); ?>';
        formData.append('_token', token);
        formData.append('email', email);
        
        $.ajax({
                url: "<?php echo url('check-email2') ?>",
                type: "POST",
                data:  formData,
                beforeSend: function(){ //alert('sending');
                    $("#submit_btn").attr('disabled', true);
                },
                contentType: false,
                processData:false,
                success: function(data) { //alert(data);
                    //success
                    // here we will handle errors and validation messages
                    if ( ! data.success) {
                        $("#error2").html('This email is already registered with ProximaRide. If it is you, <a href="<?php echo url('forgot-password'); ?>">click here</a> to recover it.');
                        $("#error2").show();
                        $("#submit_btn").attr('disabled', true);
                    } else {
                        // ALL GOOD! just show the success message!
                        $("#error2").hide();
                        $("#submit_btn").attr('disabled', false);
                    }
                },
                error: function()  {
                    //error
                } 	        
        });
    }
    
    function send_email2(th)
    {
        var formData=new FormData();
        var token='<?php echo csrf_token(); ?>';
        formData.append('_token', token);
        
        $.ajax({
                url: "<?php echo url('send-verification-email') ?>",
                type: "POST",
                data:  formData,
                beforeSend: function(){ //alert('sending');
                    $(th).attr('disabled', true);
                },
                contentType: false,
                processData:false,
                success: function(data) { //alert(data);
                    //success
                    // here we will handle errors and validation messages
                    if ( ! data.success) {
                    } else {
                        // ALL GOOD! just show the success message!
                        $("#success").text('Verification email sent successfully.');
                        $("#success").show();
                        $(th).attr('disabled', false);
                    }
                },
                error: function()  {
                    //error
                } 	        
        });
    }
</script>

<div class="modal fade" id="why-needed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post" id="completed-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="0" id="completed_ride_field">
              <div class="modal-header" style="background: #F9FAFF; padding: 18px 45px 18px 34px; padding-right:20px;">
                  
                  <div style="overflow:hidden;">
                      <div class="pull-left">
                          <h3 class="modal-title">Why do I need to verify my email?</h3>
                      </div>
                  </div>
                  
              </div>
              <div class="modal-body" style="padding: 18px 45px 18px 34px; padding-top:0px; padding-left:20px; padding-right:20px;">
                  <p class="alert alert-success" id="booking_success" style="display:none;"></p>
                  <div id="ember953" class="liquid-container ember-view" style=""><div id="ember956" class="liquid-child ember-view" style="top: 0px; left: 0px;">      <div id="ember957" class="ember-view">
<div class="scroll-x scroll-y scrollbox split-view-content ind-split-view-content download-payslip-footer-margin">
<ul class="mt-4 text-justify">
    <li>ProximaRide is all about the your safety. Since you have never met the people you are travelling with, you all will feel reassured when you can see each other ahead of time. And, it will help drivers and passengers find each other at the meeting place</li>
    <li>Passengers are more likely to book in a ride with a driver that they can see</li>
    <li>Drivers are more likely to approve passengers they can see</li>
</ul>
</div>
</div>
</div></div>

                  
              </div>
              <div class="modal-footer text-center" style="padding: 18px 30px 18px 17px; padding-left:20px; padding-right:20px;">
                <button type="button" class="btn btn-primary ml-auto mr-auto" data-dismiss="modal">Got it</button>
              </div>
                  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

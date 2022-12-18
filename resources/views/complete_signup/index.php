<?php include(app_path().'/common/header.php'); ?>
<style>
    input[type="text"] {
    border-radius: .25rem;
}
</style>
<div class='body__content'>
<div class='page__sign__up page__common p-100'>
<div class='container'>
<div class='row'>
<div class='col-12 col-md-10 col-lg-8 col-xl-7 mr-auto ml-auto'>
<div class='row'>
<div class='col-12'>
<h3 class='text-center f-700 mb-1'>Complete your sign up process</h3>
<p class='text-center mb-30' style="font-size: 16px; font-weight: 400; color: #2d4653; line-height:1.3rem;">We need some additional information to confirm your account, this is to keep our community safe and strong.</p>
    <?php if(Session::has('success')) { ?>
    <p class="alert alert-success"><?php echo Session::get('success'); ?></p>
    <?php } ?>
    <?php if(Session::has('error')) { ?>
    <p class="alert alert-danger"><?php echo Session::get('error'); ?></p>
    <?php } ?>
    
    <?php if($user->status=='2') { ?>
    <p class="alert alert-success">Your account is under review, you will be notified once it is approved. You can also update the details if required.</p>
    <?php } ?>
</div>
</div>
    
<div class='row'>
<div class='col-12'></div>
</div>
<!-- / Normal sign in/up section -->
<div class='row'>
<div class='col-12'>
<form class='rider__sign' action="" method="post" onsubmit="return check_data();" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php if($user->type=='') { ?>
    <!-- / Type of User -> I am a driver, passenger, student -->
<div class='from-group'>
<ul class='sign__up__role d-j-center'>
<li onclick="show_form('Driver')">
<label for='i-am-driver'>
<input id='i-am-driver' name='type' type='radio' value='Driver'>
<span class='selector-role'>
<img src="images/new-5-driver-male-2.png" class="img-fluid role-icon" alt="New 5 driver male 2" />
I am a driver
</span>
</label>
</li>
<li onclick="show_form('Passenger')">
<label for='i-am-passenger'>
<input id='i-am-passenger' name='type' type='radio' value='Passenger'>
<span class='selector-role'>
<img src="images/43-passengers-2.png" class="img-fluid role-icon" alt="43 passengers 2" />
I am a passenger
</span>
</label>
</li>
<li onclick="show_form('Student')">
<label for='i-am-student'>
<input id='i-am-student' name='type' type='radio' value='Student'>
<span class='selector-role'>
<img src="images/19-man-glasses-2.png" class="img-fluid role-icon" alt="19 man glasses 2" />
I am a student
</span>
</label>
</li>
</ul>
</div>
    <?php } ?>
    
    <div id="form-box">
    <?php if($user->type=='Driver') { ?>
<div class='form-group'>
    <label>Driver License <font style="color:red;">*</font></label>
<input class='form-control' name='driver_license' required type="file" required>
</div>
<!--<div class='row'>
<div class='col-12 col-md-12'>
<div class='form-group'>
<input class='form-control' name='first_name' placeholder='First Name' required type="text">
</div>
</div>
</div>-->
    <?php } ?>
    
    <?php if($user->type=='Student') { ?>
<div class='form-group'>
    <label>Student Card<font style="color:red;">*</font></label>
<input class='form-control' name='student_card' type="file" <?php if(empty($user->student_card)) echo 'required'; ?>>
</div>
<div class='row'>
<div class='col-12 col-md-12'>
<div class='form-group'>
    <label>School Name<font style="color:red;">*</font></label>
<input class='form-control' name='school_name' required type="text" value="<?php echo $user->school_name; ?>">
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
    <?php if($user->type=='Driver') { ?>
    <a href="<?php echo url('profile'); ?>"><button class='btn btn-outline btn-outline-default btn-c-transition btn-radius' type='button'>
Skip
</button></a>
    <?php } ?>
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

<?php include(app_path().'/common/footer.php'); ?>
<script>
    function show_form(type)
    {
        $("#form-box").empty();
        
        if(type=='Driver')
            {
                $("#form-box").append('<div class="form-group">\
    <label>Driver License</label>\
<input class="form-control" name="driver_license" required type="file">\
</div>');
            }
        
        if(type=='Student')
            {
                $("#form-box").append('<div class="form-group">\
    <label>Student Card<font style="color:red;">*</font></label>\
<input class="form-control" name="student_card" type="file" required>\
</div>\
<div class="row">\
<div class="col-12 col-md-12">\
<div class="form-group">\
    <label>School Name<font style="color:red;">*</font></label>\
<input class="form-control" name="school_name" required type="text">\
</div>\
</div>\
</div>');
            }
    }
    
    function check_data()
    {
        return true;
    }
    
    function check_email()
    {
        var email=$("#email").val();
        var formData=new FormData();
        var token='<?php echo csrf_token(); ?>';
        formData.append('_token', token);
        formData.append('email', email);
        
        $.ajax({
                url: "<?php echo url('check-email') ?>",
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
                        $("#error2").text('Email already exists.');
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
</script>
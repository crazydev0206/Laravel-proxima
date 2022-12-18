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
                        <h5 class="main-heading"><?php echo trans('profile.email'); ?></h5>
                    </div>
                    <div class="card-body">
                        <p>
                            <?php if($user->update_email!='') { ?>
                        <p class="alert alert-success">We have sent you a verification email to
                            <?php echo $user->update_email; ?>. Please follow the link to get your
                            email updated.</p>
                        <?php } ?>
                        </p>

                        <form class='rider__sign parsley__form__validate' data-parsley-validate='' action=""
                            method="post" onsubmit="return check_data();">
                            <?php echo csrf_field(); ?>

                            <div class='row'>
                                <div class='col-12 col-md-6'>
                                    <div class='form-group'>
                                        <label
                                            for='profile-email'><?php echo trans('profile.this_email_address'); ?></label>
                                        <input class='form-control form-group-border' id='profile-email' placeholder=''
                                            type='email' name="email2" required value="<?php echo $user->email; ?>"
                                            autocomplete="no" autofill="no" readonly disabled>
                                    </div>

                                    <div class='form-group mt-4'>
                                        <label
                                            for='profile-email'><?php echo trans('profile.update_email_address'); ?></label>
                                        <input class='form-control form-group-border' id='profile-email' placeholder=''
                                            type='email' name="email" required value="" autocomplete="no" autofill="no"
                                            data-parsley-trigger='blur focusout change'
                                            data-parsley-required-message="If you want to update your email, this field is required.">
                                    </div>
                                </div>
                            </div>
                            <!-- / End Personal Information -->
                            <p class="alert alert-danger" style="display:none;" id="error"></p>
                            <div class='form-group mt-2'>
                                <button class='btn btn-outline btn-outline-default btn-radius' type='submit'>
                                    <?php echo trans('forms.save'); ?>
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
<script src="https://js.stripe.com/v3/"></script>
<script>
// Create a Stripe client
var pk = '<?php echo env('STRIPE_PUB_KEY'); ?>';
var stripe = Stripe(pk);

// Create an instance of Elements
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
    base: {
        color: '#32325d',
        lineHeight: '18px',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
};

// Create an instance of the card Element
var card = elements.create('card', {
    style: style
});

// Add an instance of the card Element into the `card-element` <div>
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
        $("#card-errors").show();
    } else {
        displayError.textContent = '';
        $("#card-errors").hide();
    }
});

// Handle form submission
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
        if (result.error) {
            // Inform the user if there was an error
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
            $("#card-errors").show();
        } else { //alert(result.token);
            // Send the token to your server
            $("#card-errors").hide();
            $("#payment-submit").attr('disabled', true);
            stripeTokenHandler(result.token);
        }
    });
});

function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
}
</script>
<script>
function add_zero(th) {
    var val = $(th).val();
    val = ('0' + val).slice(-2);
    $(th).val(val);
}

function check_data() {
    //var check=check_password();
    //var match=match_password();

    //if(!check) return false;

    $("#error").hide();

    var phone = $("#phone_field").val().replace(/[^0-9]/gi, '');
    var lng = phone.length;
    if (parseInt(lng) < 10) {
        $("#error").text('Please enter a valid phone number.');
        $("#error").show();
        return false;
    }

    return true;
}

function show_states(country) {
    $("#states").empty();

    if (country == 'Canada') {
        $("#state_title").text('Province');
        $("#states").append('<option value="Alberta">Alberta</option>\
                             <option value="British Columbia">British Columbia</option>\
                             <option value="Prince Edward Island">Prince Edward Island</option>\
                             <option value="Manitoba">Manitoba</option>\
                             <option value="New-Brunswick">New-Brunswick</option>\
                             <option value="Nova Scotia">Nova Scotia</option>\
                             <option value="Ontario">Ontario</option>\
                             <option value="Quebec">Quebec</option>\
                             <option value="Saskatchewan">Saskatchewan</option>\
                             <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>\
                             <option value="Northwest Territories">Northwest Territories</option>\
                             <option value="Yukon">Yukon</option>\
                            ');
    } else if (country == 'United States') {
        $("#state_title").text('State');
        $("#states").append('<option value="Alabama">Alabama</option>\
                             <option value="Alaska">Alaska</option>\
                             <option value="Arizona">Arizona</option>\
                             <option value="Arkansas">Arkansas</option>\
                             <option value="California">California</option>\
                             <option value="Colorado">Colorado</option>\
                             <option value="Connecticut">Connecticut</option>\
                             <option value="Delaware">Delaware</option>\
                             <option value="District of Columbia">District of Columbia</option>\
                             <option value="Florida">Florida</option>\
                             <option value="Georgia">Georgia</option>\
                             <option value="Hawaii">Hawaii</option>\
                             <option value="Idaho">Idaho</option>\
                             <option value="Illinois">Illinois</option>\
                             <option value="Indiana">Indiana</option>\
                             <option value="Iowa">Iowa</option>\
                             <option value="Kansas">Kansas</option>\
                             <option value="Kentucky">Kentucky</option>\
                             <option value="Louisiana">Louisiana</option>\
                             <option value="Maine">Maine</option>\
                             <option value="Maryland">Maryland</option>\
                             <option value="Massachusetts">Massachusetts</option>\
                             <option value="Michigan">Michigan</option>\
                             <option value="Minnesota">Minnesota</option>\
                             <option value="Mississippi">Mississippi</option>\
                             <option value="Missouri">Missouri</option>\
                             <option value="Montana">Montana</option>\
                             <option value="Nebraska">Nebraska</option>\
                             <option value="Nevada">Nevada</option>\
                             <option value="New Hampshire">New Hampshire</option>\
                             <option value="New Jersey">New Jersey</option>\
                             <option value="New Mexico">New Mexico</option>\
                             <option value="New York">New York</option>\
                             <option value="North Carolina">North Carolina</option>\
                             <option value="North Dakota">North Dakota</option>\
                             <option value="Ohio">Ohio</option>\
                             <option value="Oklahoma">Oklahoma</option>\
                             <option value="Oregon">Oregon</option>\
                             <option value="Pennsylvania">Pennsylvania</option>\
                             <option value="Rhode Island">Rhode Island</option>\
                             <option value="South Carolina">South Carolina</option>\
                             <option value="South Dakota">South Dakota</option>\
                             <option value="Tennessee">Tennessee</option>\
                             <option value="Texas">Texas</option>\
                             <option value="Utah">Utah</option>\
                             <option value="Vermont">Vermont</option>\
                             <option value="Virginia">Virginia</option>\
                             <option value="Washington">Washington</option>\
                             <option value="West Virginia">West Virginia</option>\
                             <option value="Wisconsin">Wisconsin</option>\
                             <option value="Wyoming">Wyoming</option>\
                             <option value="Washington">Washington</option>\
                             <option value="Washington">Washington</option>\
                             <option value="Washington">Washington</option>\
                            ');
    } else {
        $("#state_title").text('Province / State');
    }
}

$(document).on('click', '.car_browse', function() {
    var file = $(this).prev();
    file.trigger('click');
});

$(document).on('change', '.car_file', function(e) {
    var o = new FileReader;
    o.readAsDataURL(e.target.files[0]), o.onloadend = function(o) {
        $("#car_image").attr("src", o.target.result);
    }
    //$(this).prev().text($(this).val().replace(/C:\\fakepath\\/i, ''));
});

$(document).ready(function() {

    $('#datepicker2').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd-mm-yyyy'
    });
});
</script>
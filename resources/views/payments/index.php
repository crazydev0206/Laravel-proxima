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
                <div class="card mb-4">
                    <div class="card-header pb-2">
                        <h5 class="main-heading"><?php echo trans('profile.my_cards'); ?></h5>
                    </div>
                    <div class="card-body">
                        <?php if(!empty($cards)) { ?>
                        <div class="row">
                            <?php foreach($cards as $card) { ?>
                            <div class="col-6 col-md-4 p-0 ml-3">
                                <div class='card__top mb-4 p-3'>
                                    <h6 class='title' style="color: #1fb9f6 !important;">
                                        XXXX-XXXX-XXXX-<?php echo $card->last4; ?>
                                    </h6>
                                    <h5 class='sub-title'>
                                        <?php echo trans('forms.valid_through'); ?>
                                        <?php echo $card->exp_month.'/'.$card->exp_year; ?> -
                                        <?php echo $card->brand; ?>
                                    </h5>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header pb-2">
                        <h5><?php echo trans('profile.add_card'); ?>:</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data" id="payment-form">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="add_card" value="1">
                            <div id="card-element">
                                <!-- a Stripe Element will be inserted here. -->
                            </div>
                            <div class="alert alert-danger mt-2" id="card-errors" role="alert" style="display:none;">
                            </div>
                            <div class="form-group mt-3">
                                <button class='btn btn-outline btn-outline-default btn-radius' type='submit'
                                    id="payment-submit">
                                    <?php echo trans('forms.add'); ?>
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
    hidePostalCode: true,
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
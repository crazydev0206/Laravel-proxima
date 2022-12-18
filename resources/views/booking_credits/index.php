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
                    <div class="card-header">
                        <h5 class="main-heading">Booking credits</h5>
                    </div>
                    <div class="card-body">
                        <p>
                            <?php if ($user->booking_credits == 0) {
                              echo 'You have 0 booking credits <button class="btn btn-round ml-2 btn-dark btn-outline btn-outline-default" id="purchase_">Buy now</button>';
                            }else {
                               echo 'You have '.$user->booking_credits .' booking credits <button class="btn btn-round ml-2 btn-dark btn-outline btn-outline-default" id="purchase_">Add more</button>';

                            } ?>
                        </p>

                        <div class="list-booking-credit d-none mt-3">
                            <h6 class="font-weight-bold"> Purchase booking credits</h6>
                            <hr class="mt-0 mb-4">

                            <?php $c_id=0;  if(!empty($credits)) { $i=0; ?>
                            <div class="row">
                                <?php foreach($credits as $credit) { ?>
                                <div class="col-6 col-md-4 p-0 ml-0 pl-3 pr-3 pt-0 pb-0 ">
                                    <div class='card__top mb-4 p-3 <?php if($i++==0) { echo 'selected'; $c_id=$credit->id; } ?>'
                                        style="cursor:pointer; border-radius:.7rem;"
                                        onclick="select_package(this, '<?php echo $credit->id; ?>')">
                                        <h6 class='title' style="color: #1fb9f6 !important;">
                                            Buy
                                            <?php echo $credit->credits_buy; if($credit->credits_buy==1) echo ' credit'; else echo ' credits'; ?>
                                            &amp; Get
                                            <?php echo $credit->credits_get; if($credit->credits_get==1) echo ' credit'; else echo ' credits'; ?>
                                        </h6>
                                        <h6 class='sub-title'>
                                            $<?php echo $credit->credits_price; ?> CAD
                                        </h6>
                                        <button
                                            class="btn btn-dark btn-round btn-dark btn-outline btn-outline-default btn-sm d-none"
                                            data-amount="<?php echo $credit->credits_price; ?>" id="payment-submit">Buy
                                            now</button>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>

                        <div class='card__box card' style="max-width:500px;">
                            <div class='card-body p-0'>
                                <form action="" class="parsley__form__validate" method="post"
                                    enctype="multipart/form-data" id="payment-form">
                                    <input type="hidden" name="package" value="<?php echo $c_id; ?>" id="package">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="add_card" value="1">
                                    <div id="card-element">
                                        <!-- a Stripe Element will be inserted here. -->
                                    </div>
                                    <ul class="parsley-errors-list filled" id="card-error-box" style="display:none;">
                                        <li class="parsley-required" id="card-errors" style="display:none;"></li>
                                    </ul>
                                    <div class="alert alert-danger mt-2" id="card-errors" role="alert"
                                        style="display:none;"></div>
                                    <!-- <div class="form-group mt-3">
                                        <button class='btn btn-outline btn-outline-default btn-radius' type='submit'
                                            id="payment-submit">
                                            Buy now
                                        </button>
                                    </div> -->
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
<script src="https://js.stripe.com/v3/"></script>
<script>
$('#purchase_').click((e) => {
    $('.list-booking-credit').removeClass('d-none')
    $('#purchase_').addClass('d-none')
});

function select_package(th, c_id) {
    $('.card__top').removeClass('selected');
    $(th).addClass('selected');

    $("#package").val(c_id);

    $('.card__top').children('button').addClass('d-none');
    $(th).children('button').removeClass('d-none');

    $('.card__top').children('button').removeClass('selected');
    $(th).children('button').addClass('selected');
}
</script>
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
        $("#card-error-box").hide();
        displayError.textContent = event.error.message;
        $("#card-errors").show();
        $("#card-error-box").show();
    } else {
        displayError.textContent = '';
        $("#card-errors").hide();
        $("#card-error-box").hide();
    }
});


let btnPur = $('.card__top').children('button');


console.log(btnPur);

btnPur.click((e) => {
    e.preventDefault();

    // Handle form submission
  var form = document.getElementById('payment-form');
  submitForm(form)
})


form.addEventListener('submit', function(event) {
    event.preventDefault();

    $("#payment-submit").attr('disabled', true);

    stripe.createToken(card).then(function(result) {


        console.log(result);


        if (result.error) {
            // Inform the user if there was an error
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
            $("#card-errors").show();
            $("#payment-submit").attr('disabled', false);
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

function submitForm(form) {

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        $("#payment-submit").attr('disabled', true);

        stripe.createToken(card).then(function(result) {


            console.log(result);


            if (result.error) {
                // Inform the user if there was an error
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                $("#card-errors").show();
                $("#payment-submit").attr('disabled', false);
            } else { //alert(result.token);
                // Send the token to your server
                $("#card-errors").hide();
                $("#payment-submit").attr('disabled', true);
                stripeTokenHandler(result.token);
            }
        });
    });
}
</script>
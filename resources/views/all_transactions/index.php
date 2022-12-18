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
                        <h5 class="main-heading"><?php echo trans('profile.balance_transactions'); ?></h5>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo trans('profile.#id'); ?></th>
                                    <th><?php echo trans('profile.user'); ?></th>
                                    <th><?php echo trans('profile.transaction_details'); ?></th>
                                    <th><?php echo trans('profile.amount'); ?></th>
                                    <th><?php echo trans('profile.on_date'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                          if(!empty($transactions)) {
                                              foreach($transactions as $transaction) {
                                                  $type=$transaction['transaction']->type;
                                                  
                                                  $url='';
                                                  if($transaction['link']!='NA' AND ($type=='1' OR $type=='2'))
                                                  $url='<br><a href="'.url('ride/'.$transaction['link']->url).'" target="_blank">View Ride</a>';
                                                  
                                                  $details='';
                                                  if($type=='1') $details='Debited for booking a ride'.$url;
                                                  else if($type=='2') $details='Credited on ride completion'.$url;
                                                  else if($type=='3') $details='Amount refunded on ride cancellation'.$url;
                                                  else if($type=='4') $details='Debited booking price for the ride'.$url;
                                                  else if($type=='5') $details='Amount refunded on ride completion'.$url;
                                                  else if($type=='6') $details='Amount refunded on seat(s) cancelled'.$url;
                                                  else if($type=='7') $details='Credited on seat(s) cancelled by passenger <br>(late notice)'.$url;
                                        ?>
                                <tr>
                                    <td><?php echo $transaction['transaction']->id; ?></td>
                                    <td><?php 
                                                if($transaction['user']!='NA') {
                                                    if($type=='1' OR $type=='3' OR $type=='4') echo 'NA';
                                                    else
                                                    echo $transaction['user']->first_name.' '.$transaction['user']->last_name;
                                                }
                                                else echo 'User deleted.';
                                                ?></td>
                                    <td><?php echo $details; ?></td>
                                    <td style="<?php if($type=='2') echo 'color:green'; ?>">
                                        <?php if($type=='1' OR $type=='4') echo '- '; ?>$<?php echo $transaction['transaction']->price; ?>
                                        CAD</td>
                                    <td>
                                        <?php echo date_format(new DateTime($transaction['transaction']->on_date),'d-m-Y'); ?>
                                        <p><?php echo date_format(new DateTime($transaction['transaction']->on_date),'H:i'); ?>
                                        </p>
                                    </td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class='body__content'>
    <div class='profile__page page__common p-60 with-b-top'>
        <div class='container'>
            <div class='row'>
                <div class='col-12'>
                    <div class='page__content__header'>
                    </div>
                    <div class='page__content__body'>
                        <div class='row'>
                            <div class='col-12 col-md-4 col-lg-3'>
                                <?php $user_data=$user; include(app_path().'/common/left_profile.php'); ?>
                            </div>
                            <div class='col-12 col-md-8 col-lg-9'>
                                <h5 class="main-heading"><?php echo trans('profile.balance_transactions'); ?></h5>
                                <hr class="mt-0 mb-3">
                                <p class="mb-4">
                                    $<?php echo $user->balance; ?> <?php echo trans('profile.cad'); ?>
                                </p>

                                <h5 class="main-heading"><?php echo trans('profile.all_transactions'); ?></h5>
                                <hr class="mt-0 mb-4">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include(app_path().'/common/footer.php'); ?>
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
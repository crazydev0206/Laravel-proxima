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

                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card">
                          <div class="card-header">
                          <h5>Your Referral URL:</h5>

                          </div>
                            <div class="card-body">
                                <center>
                                    <div class="form-group" style="width:100%;">
                                        <div class='input-group input-group-s-append justify-content-center'>
                                            <input type="text" class="form-control" name="url" style="max-width:500px;"
                                                readonly value="<?php echo url('?r='.$user->id); ?>" id="url">
                                            <span class='input-group-append' onclick="" style="cursor:pointer;">
                                                <span class='fa fa-copy input-group-text' onclick="copy_url()"></span>
                                            </span>
                                        </div>
                                        <span>Refer a friend using your referral URL and get two rides booking
                                            fee for free.</span>
                                    </div>
                                </center>
                            </div>

                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="main-heading">My referrals:</h5>
                                <!-- <hr class="mt-0 mb-2"> -->
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>User</th>
                                            <th>Registered on</th>
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
                                              ?>
                                        <tr>
                                            <td><?php echo $transaction['user']->id; ?></td>
                                            <td><?php 
                                                  if($transaction['user']!='NA') {
                                                      if($type=='1') echo 'NA';
                                                      else
                                                      echo $transaction['user']->first_name.' '.$transaction['user']->last_name;
                                                  }
                                                  else echo 'User deleted.';
                                                  ?></td>
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

    </div>
</div>




<?php include(app_path().'/common/footer.php'); ?>
<script src="https://js.stripe.com/v3/"></script>
<script>
function copy_url() {

    var url = $("#url").val();

    var textArea = $("#url");
    textArea.select();

    try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Copying text command was ' + msg);
    } catch (err) {
        console.log('Oops, unable to copy', err);
    }
    document.body.removeChild(textArea);
}

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
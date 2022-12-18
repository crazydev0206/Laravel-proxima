<?php include(app_path().'/common/header.php'); ?>
<style>
        h5{
            font-size: 16px;
        }
        
        h5.main-heading{
            font-size: 1.25erm;
        }
        
        h6.m-title{
            font-size: 12px;
            color: #ccd7e6 !important;
        }
        
        label{
            margin-bottom: 4px;
            font-weight: 500;
        }
        
        .card__profile, .card__contact, .card__reference, .card__top{
            box-shadow: 0 1px 6px 1px #eee;
        }
    
    input[type='text']{
        border-radius: 5px;
    }
    </style>

<div class='body__content'>
<div class='profile__page page__common p-60 with-b-top'>
<div class='container'>
<div class='row'>
<div class='col-12'>
<div class='page__content__header'>
<h5 class="main-heading">Rides booked</h5><hr class="mt-0 mb-4">
</div>
<div class='page__content__body'>
<div class='row'>
<div class='col-12 col-md-4 col-lg-3'>
    <?php $user_data=$user; include(app_path().'/common/left_profile.php'); ?>
</div>
<div class='col-12 col-md-8 col-lg-9'>
<ul class='nav nav-tabs mb-3' id='profile-form-tab' role='tablist'>
<li class='nav-item'>
<!--<a aria-controls='booked' aria-selected='true' class="nav-link <?php if((!isset($_GET['t']) OR $_GET['t']=='booked') OR ($user->type!='Driver') AND !isset($_GET['t'])) echo 'active'; ?>" data-toggle='tab' href='#booked' id='booked-tab' role='tab' onclick="$('.alert2').hide();">Rides booked</a>-->
    <a aria-selected='true' class="nav-link active" href='<?php echo url('my-rides'); ?>' onclick="$('.alert2').hide();">Rides booked</a>
</li>
<li class='nav-item'>
<!--<a aria-controls='posted' aria-selected='true' class="nav-link <?php if((isset($_GET['t']) AND $_GET['t']=='posted') OR (isset($_GET['t']) AND $_GET['t']=='posted')) echo 'active'; ?>" data-toggle='tab' href='#posted' id='posted-tab' role='tab' onclick="$('.alert2').hide();">Rides posted</a>-->
    <a class="nav-link" href='<?php echo url('rides-posted'); ?>' onclick="$('.alert2').hide();">Rides posted</a>
</li>
<li class='nav-item'>
<!--<a aria-controls='past' aria-selected='false' class="nav-link <?php if(isset($_GET['t']) AND $_GET['t']=='past') echo 'active'; ?>" data-toggle='tab' href='#past' id='past-tab' role='tab' onclick="$('.alert2').hide();">Past rides</a>-->
    <a class="nav-link" href='<?php echo url('past-rides') ?>' onclick="$('.alert2').hide();">Past rides</a>
</li>
</ul>
<div class='tab-content' id='profile-form-content'>
    <?php if(Session::has('success')) { ?>
    <p class="alert2 alert alert-success"><?php echo Session::get('success'); ?></p>
    <?php } ?>
    <?php if(Session::has('error')) { ?>
    <p class="alert2 alert alert-danger"><?php echo Session::get('error'); ?></p>
    <?php } ?>
    
    <!--<div aria-labelledby='posted-tab' class="tab-pane fade <?php if((isset($_GET['t']) AND $_GET['t']=='posted')) echo 'show active'; ?>" id='posted' role='tabpanel'>
        
        <div class='profile__travel__wrapper'>
            <?php 
            if(!empty($rides_posted) AND 0) {
                foreach($rides_posted as $ride) {
                    $from=$ride['ride']->departure_city;
                    $to=$ride['ride']->destination_city;
                    
                    if($ride['ride']->departure_state_short!='') $from.=', '.$ride['ride']->departure_state_short;
                    if($ride['ride']->destination_state_short!='') $to.=', '.$ride['ride']->destination_state_short;
                    
                    if($from=='') $from=$ride['ride']->departure_place;
                    if($to=='') $to=$ride['ride']->destination_place;
                    
                    if($from=='') $from=$ride['ride']->departure_state;
                    if($to=='') $to=$ride['ride']->destination_state;
                    
                    if($from=='') $from=$ride['ride']->departure;
                    if($to=='' OR $from==$to) $to=$ride['ride']->destination;
            ?>
            <div class='profile__travel__row mb-0' style="cursor: pointer;" onclick="window.location='<?php echo url('ride/'.$ride['ride']->url); ?>'">
                <div class='row'>
                    <div class='col-12 col-md-9 col-lg-8'>
                        <div class='media'>
                            <div class='media-left mr-3'>
                                <?php 
                        $car_image=url('images/car_placeholder2.png');
                        if(isset($ride['ride']->car_image) AND $ride['ride']->car_image!='') $car_image=url('car_images/'.$ride['ride']->car_image);
    ?>
                                <div class='image__round'>
                                    <img src="<?php echo $car_image; ?>" class="img-fluid img-rounded" alt="User simple" />
                                </div>
                            </div>
                            <div class='media-body'>
                                <h6 class='f-700 title mb-0'>
                                    <span class='travel'></span>
                                    <span class='locations'>
                                        <?php echo $from.' to '.$to; ?>
                                    </span>
                                </h6>
                                <p class='mb-0'>
                                    <?php echo date_format(new DateTime($ride['ride']->date),'l, F d').' at '.date_format(new DateTime($ride['ride']->time),'h:i a'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class='col-12 col-md-3 col-lg-4'>
                        <div class='price__navigation'>
                            <div class='price__info'>
                                <div class='price__info__price text-center'>
                                    <h4 class='title f-700 mb-0'>
                                        $<?php echo $ride['ride']->price; ?>
                                    </h4>
                                    <div class='price__info__details'>
                                        <span>per seat</span>
                                    </div>
                                </div>
                            </div>
                            <div class='navigation'>
                                <a href='#'>
                                    <span class='fa fa-chevron-right'></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 text-right">
            <a href="<?php echo url("cancel-ride/".$ride['ride']->id); ?>"><i class="fa fa-times"></i> Cancel ride</a>
            </div>
            <?php } } else echo "<i class='fa fa-info-circle'></i> No ride posted. You can post a ride <a href='".url('post-ride')."'>here</a>."; ?>
        </div>
    
    </div>-->
    
    <div aria-labelledby='booked-tab' class="tab-pane fade <?php if((!isset($_GET['t']) OR $_GET['t']=='booked')) echo 'show active'; ?>" id='booked' role='tabpanel'>
        <?php 
            if(!empty($rides_booked)) {
                foreach($rides_booked as $ride) {
                    $from=$ride['ride']->departure_city;
                    $to=$ride['ride']->destination_city;
                    
                    if($ride['ride']->departure_state_short!='') $from.=', '.$ride['ride']->departure_state_short;
                    if($ride['ride']->destination_state_short!='') $to.=', '.$ride['ride']->destination_state_short;
                    
                    $place_from=$ride['ride']->departure_place;
                    $place_to=$ride['ride']->destination_place;
                    
                    if($from=='') $from=$ride['ride']->departure_place;
                    if($to=='') $to=$ride['ride']->destination_place;
                    
                    if($from=='') $from=$ride['ride']->departure_state;
                    if($to=='') $to=$ride['ride']->destination_state;

                    if($from=='') $from=$ride['ride']->departure;
                    if($to=='') $to=$ride['ride']->destination;
            ?>
            <div class='profile__travel__row' style="cursor: pointer;" onclick="window.location='<?php echo url('ride/'.$ride['ride']->url); ?>'">
                <div class='row'>
                    <div class='col-12 col-md-9 col-lg-8'>
                        <div class='media'>
                            <div class='media-left mr-3'>
                                <?php 
                        $car_image=url('images/car_placeholder2.png');
                        if(isset($ride['ride']->car_image) AND $ride['ride']->car_image!='') $car_image=url('car_images/'.$ride['ride']->car_image);
    ?>
                                <div class='image__round'>
                                    <img src="<?php echo $car_image; ?>" class="img-fluid img-rounded" alt="User simple" />
                                </div>
                            </div>
                            <div class='media-body'>
                                <h6 class='f-700 title mb-0'>
                                    <span class='travel'></span>
                                    <span class='locations'>
                                        <?php echo $from.' to '.$to; ?>
                                    </span>
                                </h6>
                                <p class='mb-0'>
                                    <?php echo date_format(new DateTime($ride['ride']->date),'l, F d').' at '.date_format(new DateTime($ride['ride']->time),'h:i a'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class='col-12 col-md-3 col-lg-4'>
                        <div class='price__navigation'>
                            <div class='price__info'>
                                <div class='price__info__price text-center'>
                                    <h4 class='title f-700 mb-0'>
                                        $<?php echo $ride['ride']->price; ?>
                                    </h4>
                                    <div class='price__info__details'>
                                        <span>per seat</span>
                                    </div>
                                </div>
                            </div>
                            <div class='navigation'>
                                <a href='#'>
                                    <span class='fa fa-chevron-right'></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } } else echo "<i class='fa fa-info-circle'></i> No booked ride. You can search for a ride <a href='".url('search-ride')."'>here</a>."; ?>
    </div>
    
    <!--<div aria-labelledby='past-tab' class="tab-pane fade <?php if(isset($_GET['t']) AND $_GET['t']=='past') echo 'show active'; ?>" id='past' role='tabpanel'>
        <?php 
            if(!empty($rides_past) AND 0) {
                foreach($rides_past as $ride) {
                    $from=$ride['ride']->departure_city;
                    $to=$ride['ride']->destination_city;
                    
                    if($ride['ride']->departure_state_short!='') $from.=', '.$ride['ride']->departure_state_short;
                    if($ride['ride']->destination_state_short!='') $to.=', '.$ride['ride']->destination_state_short;
                    
                    $place_from=$ride['ride']->departure_place;
                    $place_to=$ride['ride']->destination_place;
                    
                    if($from=='') $from=$ride['ride']->departure_place;
                    if($to=='') $to=$ride['ride']->destination_place;
                    
                    if($from=='') $from=$ride['ride']->departure_state;
                    if($to=='') $to=$ride['ride']->destination_state;

                    if($from=='') $from=$ride['ride']->departure;
                    if($to=='') $to=$ride['ride']->destination;
            ?>
            <div class='profile__travel__row mb-0' style="cursor: pointer;" onclick="window.location='<?php echo url('ride/'.$ride['ride']->url); ?>'">
                <div class='row'>
                    <div class='col-12 col-md-9 col-lg-8'>
                        <div class='media'>
                            <div class='media-left mr-3'>
                                <?php 
                        $car_image=url('images/car_placeholder2.png');
                        if(isset($ride['ride']->car_image) AND $ride['ride']->car_image!='') $car_image=url('car_images/'.$ride['ride']->car_image);
    ?>
                                <div class='image__round'>
                                    <img src="<?php echo $car_image; ?>" class="img-fluid img-rounded" alt="User simple" />
                                </div>
                            </div>
                            <div class='media-body'>
                                <h6 class='f-700 title mb-0'>
                                    <span class='travel'></span>
                                    <span class='locations'>
                                        <?php echo $from.' to '.$to; ?>
                                    </span>
                                </h6>
                                <p class='mb-0'>
                                    <?php echo date_format(new DateTime($ride['ride']->date),'l, F d').' at '.date_format(new DateTime($ride['ride']->time),'h:i a'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class='col-12 col-md-3 col-lg-4'>
                        <div class='price__navigation'>
                            <div class='price__info'>
                                <div class='price__info__price text-center'>
                                    <h4 class='title f-700 mb-0'>
                                        $<?php echo $ride['ride']->price; ?>
                                    </h4>
                                    <div class='price__info__details'>
                                        <span>per seat</span>
                                    </div>
                                </div>
                            </div>
                            <div class='navigation'>
                                <a href='#'>
                                    <span class='fa fa-chevron-right'></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 text-right">
            <a href="<?php echo url("post-ride?c=".$ride['ride']->id); ?>"><i class="fa fa-copy"></i> Repost ride</a>
            </div>
            <?php } } else echo "<i class='fa fa-info-circle'></i> No past ride. You can search for a ride <a href='".url('search-ride')."'>here</a>."; ?>
    </div>-->
    
</div>
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
              var pk='<?php echo env('STRIPE_PUB_KEY'); ?>';
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
var card = elements.create('card', {style: style});

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

<?php include(app_path().'/common/header.php'); ?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<style>
        ul.luggage__list input[type="radio"]:checked + .selector-role {
    border-color: #00d262;
            color: #00d262;
}
        
        .border {
    border: 1px solid #ced4da !important;
}
        
        .section--lgrey{
            background: #f5f5f5;
            padding: 10px;
        }
        
        .input-group-append{
            background: white;
        }
        
        ul.luggage__list{
            font-weight: bold;
        }
        
        ul.luggage__list .selector-role img {
    height: 30px;
}
        
        .checkbox__square .checkbox__element i {
            top: -1px;
        }
        
        .btn-outline-default{
            background: #394d5b;
            color: white;
        }
    
    .home-ride-time-picker .gj-timepicker.gj-timepicker-bootstrap .input-group-append button {
        border-top: 1px solid #ced4da !important;
        border-bottom: 1px solid #ced4da !important;
    }
    
    .gj-timepicker-bootstrap [role=right-icon] button .gj-icon, .gj-timepicker-bootstrap [role=right-icon] button .material-icons {
        top: 8.5px;
    }
    
    .google-map-wrapper .gm-style-iw.gm-style-iw-c .info__wrapper__content .media .media-left, .google-map-wrapper .gm-style-iw.gm-style-iw-c .info__wrapper__content .media-time .media-title{
        font-size: 16px !important;
    }
    
    .google-map-wrapper .gm-style-iw.gm-style-iw-c .info__wrapper__content .media-distance .media-title {
    font-size: 16px !important;
    }
    
    .google-map-wrapper .gm-style-iw.gm-style-iw-c {
        max-width: 200px !important;
    }
    
    .location__icon.w-24 {
  width: 16px; }

.location__icon__field {
  background: #fff; }
  .location__icon__field .form-control {
    border-left: none;
    -webkit-box-shadow: none;
            box-shadow: none; }
    .location__icon__field .form-control:hover, .location__icon__field .form-control:active, .location__icon__field .form-control:focus {
      -webkit-box-shadow: none;
              box-shadow: none; }
  .location__icon__field .input-group-prepend .input-group-text {
    background: #fff;
      border-right: 0px;
      padding-left: 10px;
    }

.gj-datepicker.gj-datepicker-bootstrap .input-group-append .btn.btn-outline-secondary:active, .gj-datepicker.gj-datepicker-bootstrap .input-group-append .btn.btn-outline-secondary:focus, .gj-datepicker.gj-datepicker-bootstrap .input-group-append .btn.btn-outline-secondary:active:focus {
  color: #fff !important; }
    
    .green-seat{
        color: #53e195;
    }
    
    h5{
font-size: 17px !important;
    }
    
    /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
    </style>

<div class='body__content'>
<div class='post__ride page__common p-60 with-b-top'>
<div class='container'>
<div class='row'>
<div class='col-12'>
<div class='row'>
<div class='col-12'>
<h3 class='f-700'>Edit ride</h3><hr class="mt-0">
<p class='mb-30'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac dolor nec eros iaculis convallis sed ut quam. Aliquam erat volutpat. Suspendisse potenti.</p>
</div>
</div>
<div class='row'>
<div class='col-12'>
<form class='post-ride-form parsley__form__validate' data-parsley-validate='' action="" method="post" enctype="multipart/form-data" id="post-form">
    <?php echo csrf_field(); ?>
<div class='row'>
<div class='col-12 col-lg-8'>
    <?php if($recurring_rides>0) { ?>
    <div class='form-group mb-0'>
<ul class='ride__features__list ul__list'>
<li>
<label class='checkbox__square' for='recurr2'>
<input id='recurr2' type='checkbox' value='<?php echo $ride[0]['ride']->id; ?>' name="update_recurring">
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text' style="font-weight:bold; color:#2d4653;">
Update recurring rides
</span>
</label>
</li>
</ul>
</div>
    <?php } ?>
    
    <div class='section--lgrey'>
<!-- / Distance section -->
<div class='group-distance'>
<div class='row group-row-middle'>
<div class='col-12 col-md-6 col-md-55'>
<div class='form-group'>
<h5 class='f-sub-title'>From</h5>
    <div class='input-group location__icon__field form-group-border'>
<div class='input-group-prepend'>
<span class='input-group-text'>
<img src="<?php echo url('images/new-21-search-bar-from.png'); ?>" class="location__icon w-24" alt="Icon location from" />
</span>
</div>
<input class='form-control' id='ride-departure' name='departure' placeholder='' autocomplete="off" autofill="no" required data-parsley-trigger='blur focusout change' data-parsley-required-message="This field is required." data-parsley-errors-container='#parsley-from-error' value="<?php echo $ride[0]['ride']->departure; ?>" <?php if(count($bookings)>0) echo 'readonly'; ?> >
<input class='form-control' id='ride-departure-lat' type='hidden' name="departure_lat" value="<?php echo $ride[0]['ride']->departure_lat; ?>">
<input class='form-control' id='ride-departure-lng' type='hidden' name="departure_lng"  value="<?php echo $ride[0]['ride']->departure_lng; ?>">
    
<input class='form-control' id='departure_place' type='hidden' name="departure_place" value="<?php echo $ride[0]['ride']->departure_place; ?>">
<input class='form-control' id='departure_route' type='hidden' name="departure_route"  value="<?php echo $ride[0]['ride']->departure_route; ?>">
<input class='form-control' id='departure_zipcode' type='hidden' name="departure_zipcode" value="<?php echo $ride[0]['ride']->departure_zipcode; ?>">
<input class='form-control' id='departure_city' type='hidden' name="departure_city" value="<?php echo $ride[0]['ride']->departure_city; ?>">
<input class='form-control' id='departure_state' type='hidden' name="departure_state" value="<?php echo $ride[0]['ride']->departure_state; ?>">
<input class='form-control' id='departure_state_short' type='hidden' name="departure_state_short" value="<?php echo $ride[0]['ride']->departure_state_short; ?>">
<input class='form-control' id='departure_country' type='hidden' name="departure_country" value="<?php echo $ride[0]['ride']->departure_country; ?>">
</div>
</div>
    <div id='parsley-from-error'></div>
    <ul class="parsley-errors-list filled" id="departure-error" aria-hidden="false" style="display:none;">
            <li class="parsley-required">Please select a city first.</li>
        </ul>
</div>
<div class='col-12 col-md-1 col-md-1-6p'>
<span class='bg-light bg-circle bg-icon' style="border:0px; background:transparent !important;">
<!--<i class='fa fa-arrow-right'></i>-->
<img src="<?php echo url('images/4-arrow.png'); ?>" class="" alt="Icon location from" style="max-width:100%; margin-bottom:4px;"/>
</span>
</div>
<div class='col-12 col-md-6 col-md-55'>
<div class='form-group'>
<h5 class='f-sub-title'>To</h5>
    <div class='input-group location__icon__field form-group-border'>
<div class='input-group-prepend'>
<span class='input-group-text'>
<img src="<?php echo url('images/new-21-search-bar-to.png'); ?>" class="location__icon w-24" alt="Icon location from" />
</span>
</div>
<input class='form-control' id='ride-destination' name='destination' placeholder='' autocomplete="off" autofill="no" required data-parsley-trigger='blur focusout change' data-parsley-required-message="This field is required." data-parsley-errors-container='#parsley-to-error' value="<?php echo $ride[0]['ride']->destination; ?>" <?php if(count($bookings)>0) echo 'readonly'; ?> >
<input class='form-control' id='ride-destination-lat' type='hidden' name="destination_lat" value="<?php echo $ride[0]['ride']->destination_lat; ?>">
<input class='form-control' id='ride-destination-lng' type='hidden' name="destination_lng" value="<?php echo $ride[0]['ride']->destination_lng; ?>">
    
<input class='form-control' id='destination_place' type='hidden' name="destination_place" value="<?php echo $ride[0]['ride']->destination_place; ?>">
<input class='form-control' id='destination_route' type='hidden' name="destination_route" value="<?php echo $ride[0]['ride']->destination_route; ?>">
<input class='form-control' id='destination_zipcode' type='hidden' name="destination_zipcode" value="<?php echo $ride[0]['ride']->destination_zipcode; ?>">
<input class='form-control' id='destination_city' type='hidden' name="destination_city" value="<?php echo $ride[0]['ride']->destination_city; ?>">
<input class='form-control' id='destination_state' type='hidden' name="destination_state" value="<?php echo $ride[0]['ride']->destination_state; ?>">
<input class='form-control' id='destination_state_short' type='hidden' name="destination_state_short" value="<?php echo $ride[0]['ride']->destination_state_short; ?>">
<input class='form-control' id='destination_country' type='hidden' name="destination_country" value="<?php echo $ride[0]['ride']->destination_country; ?>">
</div>
</div>
    <div id='parsley-to-error'></div>
    <ul class="parsley-errors-list filled" id="destination-error" aria-hidden="false" style="display:none;">
            <li class="parsley-required">Please select a city first.</li>
        </ul>
</div>
</div>
<div class='row d-none'>
<div class='col-12'>
<input class='form-control' id='ride-distance' type='hidden' name="total_distance" onchange="recommend_price(this.value)" value="<?php echo $ride[0]['ride']->total_distance; ?>" >
<input class='form-control' id='ride-time' type='hidden' name="total_time" value="<?php echo $ride[0]['ride']->total_time; ?>">
</div>
</div>
</div>
<!-- / End Distance section -->
        <!-- / Distance section -->
<div class='group-distance'>
<div class='row group-row-middle'>
<div class='col-12 col-md-6 col-md-55'>
<div class='form-group'>
<h5 class='f-sub-title'>Pick-up location</h5>
    <div class=' form-group-border'>
<div class='input-group-prepend d-none'>
<span class='input-group-text'>
<img src="<?php echo url('images/new-21-search-bar-from.png'); ?>" class="location__icon w-24" alt="Icon location from" />
</span>
</div>
<input class='form-control' id='ride-pickup' name='pickup' placeholder='What is the meeting point' autocomplete="off" autofill="no" required data-parsley-trigger='blur focusout change' data-parsley-required-message="This field is required." data-parsley-errors-container='#parsley-pickup-error' value="<?php echo $ride[0]['ride']->pickup; ?>">
</div>
</div>
    <div id='parsley-pickup-error'></div>
    <ul class="parsley-errors-list filled" id="departure-error" aria-hidden="false" style="display:none;">
            <li class="parsley-required">Please select a city first.</li>
        </ul>
</div>
<div class='col-12 col-md-1 col-md-1-6p'>
<!--<span class='bg-light bg-circle bg-icon' style="border:0px; background:transparent !important;">
<img src="<?php //echo url('images/4-arrow.png'); ?>" class="" alt="Icon location from" style="max-width:100%; margin-bottom:4px;"/>
</span>-->
</div>
<div class='col-12 col-md-6 col-md-55'>
<div class='form-group'>
<h5 class='f-sub-title'>Drop-off location</h5>
    <div class=' form-group-border'>
<div class='input-group-prepend d-none'>
<span class='input-group-text'>
<img src="<?php echo url('images/new-21-search-bar-to.png'); ?>" class="location__icon w-24" alt="Icon location from" />
</span>
</div>
<input class='form-control' id='ride-dropoff' name='dropoff' placeholder='What is the arrival point' autocomplete="off" autofill="no" required data-parsley-trigger='blur focusout change' data-parsley-required-message="This field is required." data-parsley-errors-container='#parsley-drop-error' value="<?php echo $ride[0]['ride']->dropoff; ?>">
</div>
</div>
    <div id='parsley-drop-error'></div>
    <ul class="parsley-errors-list filled" id="destination-error" aria-hidden="false" style="display:none;">
            <li class="parsley-required">Please select a city first.</li>
        </ul>
</div>
</div>
</div>
<!-- / End Distance section -->
    
    <div class='form-group d-lg-none mb-4'>
<div class='img-thumbnail-wrapper google-map-wrapper'>
<div class='embed-responsive embed-responsive-4by3 mb-3'>
<div class='post-ride-google-map embed-responsive-item' id='ride-google-map-2'></div>
</div>
</div>
</div>
    
<!-- / Date and Time -->
<div class='group-distance' id="date-time-box">
<div class='row group-row-middle'>
<div class='col-12 col-md-6 col-md-55'>
<div class='form-group'>
<h5 class='f-sub-title'>Date and time</h5>
<div class='home-ride-date-picker form-group-border'>
<input class='form-control' id='ride-date-field' placeholder='Date' autocomplete="off" name="date" style="background-color: #fff !important; cursor: text !important;" value="<?php echo date_format(new DateTime($ride[0]['ride']->date),'d-m-Y') ?>" readonly data-parsley-trigger='blur focusout change' data-parsley-required-message="This field is required." required data-parsley-errors-container='#parsley-date-error' onchange="date_selected(this.value)">
</div>
</div>
    <div id='parsley-date-error'></div>
</div>
<div class='col-12 col-md-1-6p'>
<span class='bg-circle text-light'>
<span class='text' style="color:#2d4653; font-weight:bold;">at</span>
</span>
</div>
<div class='col-12 col-md-6 col-md-55'>
<div class='form-group'>
<label class='hide-up-to-md'>&nbsp;</label>
<div class='home-ride-time-picker home-ride-date-picker'>
    <div class='input-group input-group-s-append form-group-border'>
        <span class='input-group-append'>
<span class='fa fa-clock-o input-group-text' style="font-size:20px; background:white; border-right:0px; padding-top:7px; color: #6c757d;"></span>
</span>
<input class='form-control' id='ride-time-field2' placeholder='Time' autocomplete="off" name="time" required style="border-left:0px; padding-left:3px;" aria-describedby="parsley-id-555" onblur="time_updated()" data-parsley-trigger='blur focusout change' data-parsley-required-message="This field is required." value="<?php echo date_format(new DateTime($ride[0]['ride']->time),'h:i A') ?>" <?php if(count($bookings)>0) echo 'readonly'; ?> >
</div>
</div>
</div>
        <ul class="parsley-errors-list filled" id="parsley-id-555" aria-hidden="false" style="display:none;">
            <li class="parsley-required">Just to confirm, this ride is really early.</li>
        </ul>
        <ul class="parsley-errors-list filled" id="parsley-id-5544" aria-hidden="false" style="display:none;">
            <li class="parsley-required">Sorry, you cannot post a ride in the past. Please select a different time.</li>
        </ul>
</div>
</div>
</div>
        
<div class='form-group mb-0'>
<ul class='ride__features__list ul__list'>
<li>
<label class='checkbox__square' for='recurr'>
<input id='recurr' type='checkbox' value='1' name="recurring" <?php if($ride[0]['ride']->recurring=='1') echo 'checked'; ?> onchange="recurring2(this)">
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text' style="font-weight:bold; color:#2d4653;">
Recurring trip
</span>
</label>
</li>
</ul>
</div>
        
<div class='group-distance' id="until_box" style="<?php if($ride[0]['ride']->recurring!='1') echo 'display:none;'; ?>">
<div class='row group-row-middle'>
<div class='col-12 col-md-6 col-md-55'>
<div class='form-group'>
<h5 class='f-sub-title'>Repeat until</h5>
<div class='home-ride-date-picker form-group-border'>
<input class='form-control' id='ride-date-field2' placeholder='Date' autocomplete="off" name="until_date" style="background-color: #fff !important; cursor: text !important;" readonly onchange="until_selected(this)" value="<?php if($ride[0]['ride']->until_date!='0000-00-00' AND $ride[0]['ride']->until_limit=='') echo date_format(new DateTime($ride[0]['ride']->until_date),'d-m-Y'); ?>">
</div>
</div>
</div>
<div class='col-12 col-md-1-6p'>
<span class='bg-circle text-light'>
<span class='text' style="color:#2d4653; font-weight:bold;">or</span>
</span>
</div>
<div class='col-12 col-md-6 col-md-55'>
<div class='form-group'>
<label class='hide-up-to-md'>&nbsp;</label>
<select class='form-control form-group-border' placeholder='Limit' autocomplete="off" name="until_limit" style="padding-left:3px;" onchange="limit_selected(this)" id="until_limit">
    <option value="">Select limit</option>
    <option value="1" <?php if($ride[0]['ride']->until_limit=='1') echo 'selected'; ?> >1 time</option>
    <option value="2" <?php if($ride[0]['ride']->until_limit=='2') echo 'selected'; ?> >2 times</option>
    <option value="3" <?php if($ride[0]['ride']->until_limit=='3') echo 'selected'; ?> >3 times</option>
    <option value="4" <?php if($ride[0]['ride']->until_limit=='4') echo 'selected'; ?> >4 times</option>
    <option value="5" <?php if($ride[0]['ride']->until_limit=='5') echo 'selected'; ?> >5 times</option>
    <option value="6" <?php if($ride[0]['ride']->until_limit=='6') echo 'selected'; ?> >6 times</option>
    <option value="7" <?php if($ride[0]['ride']->until_limit=='7') echo 'selected'; ?> >7 times</option>
    <option value="8" <?php if($ride[0]['ride']->until_limit=='8') echo 'selected'; ?> >8 times</option>
    <option value="9" <?php if($ride[0]['ride']->until_limit=='9') echo 'selected'; ?> >9 times</option>
    <option value="10" <?php if($ride[0]['ride']->until_limit=='10') echo 'selected'; ?> >10 times</option>
</select>
</div>
</div>
</div>
</div>
    </div>

<!-- / End Date and Time -->
    <!-- / Anything to add -->
<div class='form-group mt-4'>
<h5 class='f-sub-title'>Meeting and drop-off: more description</h5>
<textarea class='form-control form-group-border' name="details" placeholder='Describe the place where you will meet your passengers, and the place where you will drop them off. Please elaborate, and be as accurate as possible.' required data-parsley-trigger='blur focusout change' data-parsley-required-message="Please describe where you are meeting and dropping your passengers off."><?php echo $ride[0]['ride']->details; ?></textarea>
</div>
<!-- / End anything to add -->
<!-- / Number of seats -->
<div class='form-group'>
<h5 class='f-sub-title mt-4'>Number of seats available</h5>
<ul class='ul__list ride-form-seats'>
<li>
<label for='number-of-seat-1'>
<input id='number-of-seat-1' name='seats' type='radio' value='1' onchange="seat_selected(this)" data-parsley-required="true" data-parsley-trigger='blur focusout change' data-parsley-required-message="Please select the available seats." data-parsley-errors-container='#parsley-seats-error' <?php if($ride[0]['ride']->seats>=1) echo 'checked'; ?> <?php if(count($bookings)>0) echo 'readonly'; ?> >
<span class='seats'>
<span class='seat-number'>
1
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect seat-unselect-1" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select seat-select-1" alt="Seat hover 1" />
    <i class="fa fa-times" style="color:red; position:absolute; top:-5px; left:3px; font-size:36px; <?php if($ride[0]['ride']->seats>=1) echo ''; else echo 'display:none;'; ?>" id='number-of-seat-cross-1'></i>
</span>
</span>
</label>
</li>
<li>
<label for='number-of-seat-2'>
<input id='number-of-seat-2' name='seats' type='radio' value='2' onchange="seat_selected(this)" <?php if($ride[0]['ride']->seats>=2) echo 'checked'; ?> <?php if(count($bookings)>0) echo 'readonly'; ?> >
<span class='seats'>
<span class='seat-number'>
2
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect seat-unselect-2" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select seat-select-2" alt="Seat hover 1" />
    <i class="fa fa-times" style="color:red; position:absolute; top:-5px; left:3px; font-size:36px; <?php if($ride[0]['ride']->seats>=2) echo ''; else echo 'display:none;'; ?>" id='number-of-seat-cross-2'></i>
</span>
</span>
</label>
</li>
<li>
<label for='number-of-seat-3'>
<input id='number-of-seat-3' name='seats' type='radio' value='3' onchange="seat_selected(this)" <?php if($ride[0]['ride']->seats>=3) echo 'checked'; ?> <?php if(count($bookings)>0) echo 'readonly'; ?> >
<span class='seats'>
<span class='seat-number'>
3
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect seat-unselect-3" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select seat-select-3" alt="Seat hover 1" />
    <i class="fa fa-times" style="color:red; position:absolute; top:-5px; left:3px; font-size:36px; <?php if($ride[0]['ride']->seats>=3) echo ''; else echo 'display:none;'; ?>" id='number-of-seat-cross-3'></i>
</span>
</span>
</label>
</li>
<li>
<label for='number-of-seat-4'>
<input id='number-of-seat-4' name='seats' type='radio' value='4' onchange="seat_selected(this)" <?php if($ride[0]['ride']->seats>=4) echo 'checked'; ?> <?php if(count($bookings)>0) echo 'readonly'; ?> >
<span class='seats'>
<span class='seat-number'>
4
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect seat-unselect-4" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select seat-select-4" alt="Seat hover 1" />
    <i class="fa fa-times" style="color:red; position:absolute; top:-5px; left:3px; font-size:36px; <?php if($ride[0]['ride']->seats>=4) echo ''; else echo 'display:none;'; ?>" id='number-of-seat-cross-4'></i>
</span>
</span>
</label>
</li>
<li>
<label for='number-of-seat-5'>
<input id='number-of-seat-5' name='seats' type='radio' value='5' onchange="seat_selected(this)" <?php if($ride[0]['ride']->seats>=5) echo 'checked'; ?> <?php if(count($bookings)>0) echo 'readonly'; ?> >
<span class='seats'>
<span class='seat-number'>
5
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect seat-unselect-5" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select seat-select-5" alt="Seat hover 1" />
    <i class="fa fa-times" style="color:red; position:absolute; top:-5px; left:3px; font-size:36px; <?php if($ride[0]['ride']->seats>=5) echo ''; else echo 'display:none;'; ?>" id='number-of-seat-cross-5'></i>
</span>
</span>
</label>
</li>
<li>
<label for='number-of-seat-6'>
<input id='number-of-seat-6' name='seats' type='radio' value='6' onchange="seat_selected(this)" <?php if($ride[0]['ride']->seats>=6) echo 'checked'; ?> <?php if(count($bookings)>0) echo 'readonly'; ?> >
<span class='seats'>
<span class='seat-number'>
6
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect seat-unselect-6" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select seat-select-6" alt="Seat hover 1" />
    <i class="fa fa-times" style="color:red; position:absolute; top:-5px; left:3px; font-size:36px; <?php if($ride[0]['ride']->seats>=6) echo ''; else echo 'display:none;'; ?>" id='number-of-seat-cross-6'></i>
</span>
</span>
</label>
</li>
<li>
<label for='number-of-seat-7'>
<input id='number-of-seat-7' name='seats' type='radio' value='7' onchange="seat_selected(this)"  <?php if($ride[0]['ride']->seats>=7) echo 'checked'; ?> <?php if(count($bookings)>0) echo 'readonly'; ?> >
<span class='seats'>
<span class='seat-number'>
7
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect seat-unselect-7" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select seat-select-7" alt="Seat hover 1" />
    <i class="fa fa-times" style="color:red; position:absolute; top:-5px; left:3px; font-size:36px; <?php if($ride[0]['ride']->seats>=7) echo ''; else echo 'display:none;'; ?>" id='number-of-seat-cross-7'></i>
</span>
</span>
</label>
</li>
</ul>
    <div id="parsley-seats-error"></div>
</div>
<!-- / End Number of seats -->
<!-- / Vehicle Information -->
    <div class='section--lgrey'>
<div class='row'>
<div class='col-12'>
<h5 class='f-sub-title mb-1 mt-0'>Vehicle</h5>
<ul class='ride__features__list ul__list mb-2'>
<li style="">
<label class='checkbox__square checkbox__element' for='skip_vehicle'>
<input id='skip_vehicle' type='checkbox' value='1' name="skip_vehicle" onchange="skip_vehicle2(this); $('#post-form').parsley().validate('vehicle_fields');" data-parsley-trigger='blur focusout change' <?php if($ride[0]['ride']->skip_vehicle==1) echo 'checked'; ?> >
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
Skip for now
</span>
</label>
</li>
</ul>
    <ul class="parsley-errors-list filled" id="parsley-id-skip" aria-hidden="false" style="display:none;">
            <li class="parsley-required">Please inform us and your passengers about your car details as soon as you have them. It is important for the passengers to find you.</li>
        </ul>
<div class='row'>
<div class='col-12 col-md-6'>
<div class='form-group'>
    <h5 class='f-sub-title'>Model</h5>
<input class='form-control vehicle_field form-group-border' placeholder='e.g. Toyota' name="model" required value="<?php echo $ride[0]['ride']->model; ?>" data-parsley-trigger='blur focusout change' data-parsley-required-message="This field is required." data-parsley-group="vehicle_fields">
</div>
</div>
<div class='col-12 col-md-6'>
<div class='row'>
<div class='col-12 col-md-12'>
    <h5 class='f-sub-title'>Type</h5>
<select class='form-control vehicle_field form-group-border' name="vehicle_type" required data-parsley-trigger='blur focusout change' data-parsley-required-message="This field is required." data-parsley-group="vehicle_fields">
<option value=''></option>
    <option value="Convertible" <?php if($ride[0]['ride']->vehicle_type=='Convertible') echo 'selected'; ?> >Convertible</option>
    <option value="Coupe" <?php if($ride[0]['ride']->vehicle_type=='Coupe') echo 'selected'; ?> >Coupe</option>
    <option value="Hatchback" <?php if($ride[0]['ride']->vehicle_type=='Hatchback') echo 'selected'; ?> >Hatchback</option>
    <option value="Minivan" <?php if($ride[0]['ride']->vehicle_type=='Minivan') echo 'selected'; ?> >Minivan</option>
    <option value="Sedan" <?php if($ride[0]['ride']->vehicle_type=='Sedan') echo 'selected'; ?> >Sedan</option>
    <option value="Station Wagon" <?php if($ride[0]['ride']->vehicle_type=='Station Wagon') echo 'selected'; ?> >Station Wagon</option>
    <option value="SUV" <?php if($ride[0]['ride']->vehicle_type=='SUV') echo 'selected'; ?> >SUV</option>
    <option value="Truck" <?php if($ride[0]['ride']->vehicle_type=='Truck') echo 'selected'; ?> >Truck</option>
    <option value="Van" <?php if($ride[0]['ride']->vehicle_type=='Van') echo 'selected'; ?> >Van</option>
</select>
</div>
<!--<div class='col-12 col-md-6'>
<input class='form-control' placeholder='Other' name="other" value="<?php if(isset($vehicle->other)) echo $vehicle->other; ?>">
</div>-->
</div>
</div>
</div>
<div class='row'>
<div class='col-12 col-md-6'>
<div class='row'>
<div class='col-12 col-md-6'>
<div class='form-group'>
    <h5 class='f-sub-title'>Year</h5>
<select class='form-control vehicle_field form-group-border' name="year" required data-parsley-trigger='blur focusout change' data-parsley-required-message="This field is required." data-parsley-group="vehicle_fields">
<option value=''>YYYY</option>
    <?php for($i=2020; $i>=1990; $i--) { ?>
<option value='<?php echo $i; ?>' <?php if($ride[0]['ride']->year==$i) echo 'selected'; ?> >
<?php echo $i; ?>
</option>
    <?php } ?>
</select>
</div>
</div>
<div class='col-12 col-md-6'>
<div class='form-group'>
    <h5 class='f-sub-title'>Color</h5>
<input class='form-control vehicle_field form-group-border' placeholder='' name="color" required value="<?php echo $ride[0]['ride']->color; ?>" data-parsley-trigger='blur focusout change' data-parsley-required-message="This field is required." data-parsley-group="vehicle_fields">
</div>
</div>
</div>
</div>
<div class='col-12 col-md-6'>
<div class='form-group'>
    <h5 class='f-sub-title'>License plate number</h5>
<input class='form-control vehicle_field form-group-border' placeholder='' name="license_no" required value="<?php echo $ride[0]['ride']->license_no; ?>" data-parsley-trigger='blur focusout change' data-parsley-required-message="This field is required." data-parsley-group="vehicle_fields">
</div>
</div>
</div>
<div class='row d-lg-none mb-4'>
<div class='col-12'>
<?php 
    $car_image=url('images/4-upload-car-photo.png');
    if($ride[0]['ride']->car_image!='') $car_image=url('car_images/'.$ride[0]['ride']->car_image);
    ?>
    <input type="hidden" name="car_file_name" value="<?php echo $ride[0]['ride']->car_image; ?>" id="img_file">
<div class='img-thumbnail-wrapper' style="">
<img src="<?php echo $car_image; ?>" class="img-thumbnail img-fluid car_browse" alt="Bentley continental gt red wallpaper" style="background:black; cursor:pointer; width:100%;" id="car_image"/>
    <p class="text-center mt-2"><?php if($ride[0]['ride']->car_image!='') echo 'This is your car. Click on the photo if you want to change it.'; else echo ''; ?></p>
</div>
</div>
</div>
</div>
    
    <div class="col-12">
<div class='group-section' style="padding-bottom: 10px !important;">
<ul class='ul__list ul__list--horizontal'>
<li>
<label class='checkbox__round checkbox__square' for='smoking-non-smoking22'>
<div class='radio-element'>
<input id='smoking-non-smoking22' name='car_type' type='radio' value="Electric Car" <?php if($ride[0]['ride']->car_type=='Electric Car') echo 'checked'; ?> >
<span class='select-element checkbox__all'>
<span class='select-element checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
</div>
<div class='radio-text'>
Electric Car
</div>
</label>
</li>
<li>
<label class='checkbox__round checkbox__square' for='smoking-smoking12'>
<div class='radio-element'>
<input id='smoking-smoking12' name='car_type' type='radio' value="Hybrid Car" <?php if($ride[0]['ride']->car_type=='Hybrid Car') echo 'checked'; ?> >
<span class='select-element checkbox__all'>
<span class='select-element checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
</div>
<div class='radio-text'>
Hybrid Car
</div>
</label>
</li>
</ul>
</div>
    </div>
    
</div>
    </div>
<!-- / End Vehicle Information -->
<!-- / Ride preference -->
<h5 class='f-sub-title mt-3 mb-3'>Ride preferences</h5>
<div class='form-group'>
<label>Smoking</label>
<div class='group-section bg-grey bg-light p-3' style="padding-bottom: 10px !important;">
<ul class='ul__list ul__list--horizontal'>
<li>
<label class='checkbox__round checkbox__square' for='smoking-non-smoking'>
<div class='radio-element'>
<input id='smoking-non-smoking' name='smoke' type='radio' value="No" data-parsley-required="true" data-parsley-trigger='blur focusout change' data-parsley-required-message="This field is required." data-parsley-errors-container='#parsley-smoke-error' <?php if($ride[0]['ride']->smoke=='No') echo 'checked'; ?> >
<span class='select-element checkbox__all'>
<span class='select-element checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
</div>
<div class='radio-text'>
No-smoking
</div>
</label>
</li>
<li>
<label class='checkbox__round checkbox__square' for='smoking-smoking'>
<div class='radio-element'>
<input id='smoking-smoking' name='smoke' type='radio' value="Yes"  <?php if($ride[0]['ride']->smoke=='Yes') echo 'checked'; ?> >
<span class='select-element checkbox__all'>
<span class='select-element checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
</div>
<div class='radio-text'>
Smoking
</div>
</label>
</li>
</ul>
    <div id="parsley-smoke-error"></div>
</div>
</div>
<div class='form-group'>
<label>Animal and pets Friendly*</label>
<div class='group-section bg-grey bg-light p-3' style="padding-bottom: 10px !important;">
<ul class='ul__list ul__list--horizontal'>
<li>
<label class='checkbox__square checkbox__round' for='animal-yes'>
<div class='radio-element'>
<input id='animal-yes' name='animal_friendly' type='radio' value="Yes" data-parsley-required="true" data-parsley-trigger='blur focusout change' data-parsley-required-message="This field is required." data-parsley-errors-container='#parsley-animal-error'  <?php if($ride[0]['ride']->animal_friendly=='Yes') echo 'checked'; ?> >
<span class='checkbox__all'>
<span class='select-element checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
</div>
<div class='radio-text'>
Yes
</div>
</label>
</li>
<li>
<label class='checkbox__square checkbox__round' for='animal-no'>
<div class='radio-element'>
<input id='animal-no' name='animal_friendly' type='radio' value="No" <?php if($ride[0]['ride']->animal_friendly=='No') echo 'checked'; ?> >
<span class='checkbox__all'>
<span class='select-element checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
</div>
<div class='radio-text'>
No
</div>
</label>
</li>
<li>
<label class='checkbox__square checkbox__round' for='animal-caged'>
<div class='radio-element'>
<input id='animal-caged' name='animal_friendly' type='radio' value="Caged animals only" <?php if($ride[0]['ride']->animal_friendly=='Caged animals only') echo 'checked'; ?> >
<span class='checkbox__all'>
<span class='select-element checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
</div>
<div class='radio-text'>
Caged animals only
</div>
</label>
</li>
</ul>
    <div id="parsley-animal-error"></div>
</div>
<p>Integer tempor sit amet ex non pellentesque. Maecenas sed ullamcorper eros. Nulla eget maximus elit. Aliquam erat volutpat. Phasellus efficitur erat quis molestie suscipit.</p>
</div>
<!-- / End Ride preference -->
<!-- / Ride features -->
    <div class='section--lgrey'>
<div class='form-group'>
<h5 class='f-sub-title mt-1'>Ride features</h5>
    <?php 
    $features=array();
    if($ride[0]['ride']->features!='') $features=explode(';', $ride[0]['ride']->features);
    ?>
<ul class='ride__features__list ul__list'>
<li style="color: #e11e86; font-weight: bold;">
<label class='checkbox__square checkbox__element' for='pink_ride'>
<input id='pink_ride' type='checkbox' value='Pink ride' name="features[]" <?php if($user->driver!='1') echo 'disabled'; ?> <?php if(in_array('Pink ride', $features)) echo 'checked'; ?> >
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right' style="<?php if($user->driver!='1') echo 'text-decoration:line-through;'; ?>">
<span class='info-icon' data-toggle='tooltip' title='<?php if($user->driver!='1') echo 'You need to get verified first to post a Pink ride.'; else echo 'Pink rides are only for women.' ?>'>
<i class='fa fa-info-circle'></i>
</span>
Pink ride
</span>
</label>
</li>
<li style="color: #077dd5; font-weight: bold;">
<label class='checkbox__square checkbox__element' for='extra-care-ride'>
<input id='extra-care-ride' type='checkbox' value='Extra-care ride' name="features[]" <?php if($user->driver!='1') echo 'disabled'; ?>  <?php if(in_array('Extra-care ride', $features)) echo 'checked'; ?> >
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right' style="<?php if($user->driver!='1') echo 'text-decoration:line-through;'; ?>">
<span class='info-icon' data-toggle='tooltip' title='<?php if($user->driver!='1') echo 'You need to get verified first to post a Extra-care ride.'; else echo 'Extra-care rides takes extra cares for passengers.' ?>'>
<i class='fa fa-info-circle'></i>
</span>
Extra-care ride
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element' for='wi-fi'>
<input id='wi-fi' type='checkbox' value='Wi-Fi' name="features[]" <?php if(in_array('Wi-Fi', $features)) echo 'checked'; ?> >
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
Wi-Fi
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element' for='5 star passengers'>
<input id='5 star passengers' type='checkbox' value='I want only 5 star passengers' name="features[]" <?php if(in_array('I want only 5 star passengers', $features)) echo 'checked'; ?> >
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
I want only 5 star passengers
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element' for='i take infants'>
<input id='i take infants' type='checkbox' value='I take infants and I provide car baby seat(s)' name="features[]" <?php if(in_array('I take infants and I provide car baby seat(s)', $features)) echo 'checked'; ?> >
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
<span class='info-icon' data-toggle='tooltip' title='Drivers may charge extra for this'>
<i class='fa fa-info-circle'></i>
</span>
I take infants and I provide car baby seat(s)
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element' for='i-take-infants'>
<input id='i-take-infants' type='checkbox' value='I take infants if the passenger provides car baby seat(s)' name="features[]" <?php if(in_array('I take infants if the passenger provides car baby seat(s)', $features)) echo 'checked'; ?> >
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
    <span class='info-icon' data-toggle='tooltip' title='Drivers may charge extra for this'>
<i class='fa fa-info-circle'></i>
</span>
I take infants if the passenger provides car baby seat(s)
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element' for='isdftakesdids2'>
<input id='isdftakesdids2' type='checkbox' value='I take children and I provide car booster seat(s)' name="features[]" <?php if(in_array('I take children and I provide car booster seat(s)', $features)) echo 'checked'; ?> >
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
    <span class='info-icon' data-toggle='tooltip' title='Drivers may charge extra for this'>
<i class='fa fa-info-circle'></i>
</span>
I take children and I provide car booster seat(s)
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element' for='idtakedkids'>
<input id='idtakedkids' type='checkbox' value='I take children if the passenger providers car baby seat(s)' name="features[]" <?php if(in_array('I take children if the passenger providers car baby seat(s)', $features)) echo 'checked'; ?> >
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
    <span class='info-icon' data-toggle='tooltip' title='Drivers may charge extra for this'>
<i class='fa fa-info-circle'></i>
</span>
I take children if the passenger providers car baby seat(s)
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element' for='bike rack'>
<input id='bike rack' type='checkbox' value='Bike rack' name="features[]" <?php if(in_array('Bike rack', $features)) echo 'checked'; ?> >
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
Bike rack
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element' for='ski rack'>
<input id='ski rack' type='checkbox' value='Ski rack' name="features[]" <?php if(in_array('Ski rack', $features)) echo 'checked'; ?> >
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
Ski rack
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element' for='winter tires'>
<input id='winter tires' type='checkbox' value='Winter tires' name="features[]" <?php if(in_array('Winter tires', $features)) echo 'checked'; ?> >
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
Winter tires
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element' for='air conditioning'>
<input id='air conditioning' type='checkbox' value='Air conditioning' name="features[]" <?php if(in_array('Air conditioning', $features)) echo 'checked'; ?> >
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
Air conditioning
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element' for='heating'>
<input id='heating' type='checkbox' value='Heating' name="features[]" <?php if(in_array('Heating', $features)) echo 'checked'; ?> >
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
Heating
</span>
</label>
</li>
</ul>
</div>
<!-- / End Ride features -->
<!-- / Instant booking -->
        <style>
            ul.sign__up__role li.role2
            {
                flex-basis: 50% !important;
                max-width: 53.3333333333% !important;
                font-size:20px !important;
            }
            
            ul.luggage__list li.role2 .selector-role
            {
                padding: 20px;
                padding-top: 20px;
                padding-bottom: 20px;
            }
            
            ul.luggage__list li.role2 .selector-role img
            {
                max-width: 53.3333333333% !important; 
                font-size:20px !important;
                height:50px;
            }
            
            @media only screen and (max-width:796px)
            {
                ul.sign__up__role li.role2
                {
                    flex-basis: 100% !important;
                    max-width: 100% !important;
                }
            }
        </style>
        <h5 class='f-sub-title'>Booking options</h5>
<div class='form-group'>
<div class='group-section bg-lightno p-0 pl-0' style="padding-bottom: 10px !important;">
    <ul class='ul__list sign__up__role luggage__list'>
<li class="role2">
<div class='luggage__box'>
<label for='luggage-small2' style="background: white; border-radius: 5px;">
<input id='luggage-small2' name='booking_method' type='radio' value="Instant booking" <?php if($ride[0]['ride']->booking_method=='Instant booking') echo 'checked'; ?> >
<span class='luggage-luggage-small selector-role'>
<img src="<?php echo url('images/70-instant-booking.png'); ?>" class="default" alt="Luggage" style="border-radius: 50%;"/>
<img src="<?php echo url('images/70-instant-booking.png'); ?>" class="hover" alt="Luggage hover 1" style="border-radius: 50%;"/>
<span class='text'>
Instant booking
</span>
</span>
</label>
</div>
</li>
<li class="role2">
<div class='luggage__box'>
<label for='luggage-medium1' style="background: white; border-radius: 5px;">
<input id='luggage-medium1' name='booking_method' type='radio' value="Manual approval" <?php if($ride[0]['ride']->booking_method=='Manual approval') echo 'checked'; ?> >
<span class='luggage-luggage-medium selector-role'>
<img src="<?php echo url('images/14-1-phone-fingertips.png'); ?>" class="default" alt="Luggage" style="border-radius: 50%;"/>
<img src="<?php echo url('images/14-1-phone-fingertips.png'); ?>" class="hover" alt="Luggage hover 1" style="border-radius: 50%;"/>
<span class='text'>
Manual approval
</span>
</span>
</label>
</div>
</li>
</ul>
    
</div>
</div>
<!-- / End instance booking -->
<!-- / Max number of back seats -->
<div class='form-group'>
<ul class='ride__features__list ul__list'>
<li>
<label class='checkbox__square' for='max-2-back-seat2'>
<input id='max-2-back-seat2' type='checkbox' value='2' name="max_back_seats" <?php if($ride[0]['ride']->max_back_seats=='2') echo 'checked'; ?> >
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
    <span class='info-icon' data-toggle='tooltip' title="Max. 2 passengers in the back and middle row seats">
<i class='fa fa-info-circle'></i>
</span>
Max. 2 in the back seats
</span>
</label>
</li>
</ul>
</div>
    </div>
<!-- / End Max number of back seats -->
<!-- / Luggage section -->
    <div class="">
<div class='form-group mt-4' id="luggage_box">
<h5 class='f-sub-title'>Luggage</h5>
<div class='group-section'>
<ul class='ul__list sign__up__role luggage__list'>
<li>
<div class='luggage__box'>
<label for='luggage-none'>
<input id='luggage-none' name='luggage' type='radio' value="No luggage" data-parsley-required="true" data-parsley-trigger='blur focusout change' data-parsley-required-message="This field is required." data-parsley-errors-container='#parsley-luggage-error' <?php if($ride[0]['ride']->luggage=='No luggage') echo 'checked'; ?> <?php if(count($bookings)>0) echo 'readonly'; ?> >
<span class='luggage-luggage-no selector-role' style="min-height:50px; padding-top: 13px;">
<span class='text'>
No luggage
</span>
</span>
</label>
</div>
</li>
<li>
<div class='luggage__box'>
<label for='luggage-small'>
<input id='luggage-small' name='luggage' type='radio' value="S" <?php if($ride[0]['ride']->luggage=='S') echo 'checked'; ?> <?php if(count($bookings)>0) echo 'readonly'; ?> >
<span class='luggage-luggage-small selector-role'>
<img src="<?php echo url('images/24-small-bag.png'); ?>" class="default" alt="Luggage" />
<img src="<?php echo url('images/24-small-bag.png'); ?>" class="hover" alt="Luggage hover 1" />
<span class='text'>
S
</span>
</span>
</label>
</div>
</li>
<li>
<div class='luggage__box'>
<label for='luggage-medium'>
<input id='luggage-medium' name='luggage' type='radio' value="M" <?php if($ride[0]['ride']->luggage=='M') echo 'checked'; ?> <?php if(count($bookings)>0) echo 'readonly'; ?> >
<span class='luggage-luggage-medium selector-role'>
<img src="<?php echo url('images/24-backpack.png'); ?>" class="default" alt="Luggage" />
<img src="<?php echo url('images/24-backpack.png'); ?>" class="hover" alt="Luggage hover 1" />
<span class='text'>
M
</span>
</span>
</label>
</div>
</li>
<li>
<div class='luggage__box'>
<label for='luggage-large'>
<input id='luggage-large' name='luggage' type='radio' value="L" <?php if($ride[0]['ride']->luggage=='L') echo 'checked'; ?> <?php if(count($bookings)>0) echo 'readonly'; ?> >
<span class='luggage-luggage-large selector-role'>
<img src="<?php echo url('images/24-luggage.png'); ?>" class="default" alt="Luggage" />
<img src="<?php echo url('images/24-luggage.png'); ?>" class="hover" alt="Luggage hover 1" />
<span class='text'>
L
</span>
</span>
</label>
</div>
</li>
<li>
<div class='luggage__box'>
<label for='luggage-x_large/multiple'>
<input id='luggage-x_large/multiple' name='luggage' type='radio' value="XL and multiple" <?php if($ride[0]['ride']->luggage=='XL and multiple') echo 'checked'; ?> <?php if(count($bookings)>0) echo 'readonly'; ?> >
<span class='luggage-luggage-xlarge selector-role'>
<img src="<?php echo url('images/24-large-bag.png'); ?>" class="default" alt="Luggage suit" />
<img src="<?php echo url('images/24-large-bag.png'); ?>" class="hover" alt="Luggage suit hover 1" />
<span class='text show-info-top-right mr-3'>
    <span class='info-icon' data-toggle='tooltip' title="At the driver's discretion">
<i class='fa fa-info-circle'></i>
</span>
XL and multiple
</span>
</span>
</label>
</div>
</li>
</ul>
    <div id="parsley-luggage-error"></div>
</div>
</div>
        
<div class='form-group'>
<ul class='ride__features__list ul__list'>
<li>
<label class='checkbox__square' for='max-2-back-seat22'>
<input id='max-2-back-seat22' type='checkbox' value='1' name="accept_more_luggage" <?php if($ride[0]['ride']->accept_more_luggage=='1') echo 'checked'; ?> <?php if(count($bookings)>0) echo 'readonly'; ?> >
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
    <span class='info-icon' data-toggle='tooltip' title="At the driver's discretion">
<i class='fa fa-info-circle'></i>
</span>
I accept more luggage for extra charge
</span>
</label>
</li>
<li>
<label class='checkbox__square' for='max-2-back-seat221'>
<input id='max-2-back-seat221' type='checkbox' value='1' name="open_customized" <?php if($ride[0]['ride']->open_customized=='1') echo 'checked'; ?> >
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
    <span class='info-icon' data-toggle='tooltip' title="At the driver's discretion">
<i class='fa fa-info-circle'></i>
</span>
Open to customized pick-up and drop-off for extra charge
</span>
</label>
</li>
</ul>
</div>
    </div>
<!-- / End luggage section -->
<!-- / Price per seat -->
    <div class="section--lgrey">
<div class='form-group'>
<h5 class='f-sub-title mb-0'>Price per seat</h5>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing insdustry.</p>
<div class='row'>
<div class='col-12 col-sm-5 col-md-4 col-lg-3' style="border-radius:5px;">
<div class='input-group form-group-border' style="border-radius:5px;">
<input class='form-control' type="number" min="0" step="any" name="price" value="<?php echo $ride[0]['ride']->price; ?>" required id="price_seat" data-parsley-trigger='blur focusout change' data-parsley-required-message="This field is required." data-parsley-errors-container='#parsley-price-error' <?php if(count($bookings)>0) echo 'readonly'; ?> style="border-right:0px;" data-parsley-group="price_fields">
<span class='input-group-append' style="border-radius:5px;">
<span class='input-group-text' style="border-left:0px;">$</span>
</span>
</div>
</div>
</div>
</div>
        <div id="parsley-price-error"></div>
    </div>
<!-- / End price per seat -->
<!-- / Payment method -->
<div class='form-group' id="payment_box">
<h5 class='f-sub-title mt-4'>Payment methods</h5>
<ul class='ul__list ul__list--horizontal payment__mode'>
<li class="mr-5">
<div class='payment__box'>
<div class='payment__icon'>
<img src="<?php echo url('images/icons-png/hand-cash.png'); ?>" class="img-fluid" alt="Hand cash" />
</div>
<div class='payment__selector'>
<label class='mb-0 checkbox__square checkbox__round' for='payment-Cash'>
<div class='radio-element'>
<input id='payment-Cash' name='payment_method' type='radio' value='Cash' data-parsley-required="true" data-parsley-trigger='blur focusout change' data-parsley-required-message="This field is required." data-parsley-errors-container='#parsley-cash-error' <?php if($ride[0]['ride']->payment_method=='Cash') echo 'checked'; ?> >
<span class='text checkbox__all'>
<span class='select-element checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
</div>
<div class='radio-text show-info-top-right'>
<span class='info-icon' data-toggle='tooltip' title='Passengers pay to the driver in cash when they meet'>
<i class='fa fa-info-circle'></i>
</span>
Cash
</div>
</label>
</div>
</div>
</li>
<li class="mr-5">
<div class='payment__box'>
<div class='payment__icon'>
<img src="<?php echo url('images/icons-png/money-transfer.png'); ?>" class="img-fluid" alt="Money transfer" />
</div>
<div class='payment__selector'>
<label class='mb-0 checkbox__square checkbox__round' for='payment-Transfer'>
<div class='radio-element'>
<input id='payment-Transfer' name='payment_method' type='radio' value='Online payment' <?php if($ride[0]['ride']->payment_method=='Online payment') echo 'checked'; ?> >
<span class='text checkbox__all'>
<span class='select-element checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
</div>
<div class='radio-text show-info-top-right'>
<span class='info-icon' data-toggle='tooltip' title='Payment is taken in advance from the passengers, but is transferred to the driver only after the ride'>
<i class='fa fa-info-circle'></i>
</span>
Online payment
</div>
</label>
</div>
</div>
</li>
<li>
<div class='payment__box'>
<div class='payment__icon'>
<img src="<?php echo url('images/icons-png/money-guaranteed.png'); ?>" class="img-fluid" alt="Money guaranteed" />
</div>
<div class='payment__selector'>
<label class='mb-0 checkbox__square checkbox__round' for='payment-Guaranteed cash'>
<div class='radio-element'>
<input id='payment-Guaranteed cash' name='payment_method' type='radio' value='Secured cash' <?php if($ride[0]['ride']->payment_method=='Secured cash') echo 'checked'; ?> >
<span class='text checkbox__all'>
<span class='select-element checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
</div>
<div class='radio-text show-info-top-right'>
<span class='info-icon' data-toggle='tooltip' title='Payment is held from the passengers, then is refunded once they meet the driver and pay in cash'>
<i class='fa fa-info-circle'></i>
</span>
Secured cash
</div>
</label>
</div>
</div>
</li>
</ul>
    <div id="parsley-cash-error"></div>
</div>
<!-- / End payment method -->
<!-- / Anything to add -->
<div class='form-group'>
<h5 class='f-sub-title'><?php echo trans('rides.anything_add'); ?></h5>
<textarea class='form-control form-group-border' placeholder='What else do you want to tell your passengers?' name="notes"><?php echo $ride[0]['ride']->notes; ?></textarea>
</div>
<!-- / End anything to add -->
<!-- / Disclaimers -->
<div class='form-group'>
<div class='bg-light p-3' style="background: #f5f5f5 !important;">
    <h5 class='f-sub-title'><?php echo trans('rides.disclaimers'); ?></h5>
<ul class='disclaimer__list ul__list mb-0'>
<li>
<div class='disclaimer__box'>
<div class='media'>
<div class='media-left mr-2 d-none'>
<label class='checkbox__square checkbox__element' for='disclaimer-1'>
<input id='disclaimer-1' type='checkbox' value='disclaimer_1'>
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
</label>
</div>
<div class='media-body'>
<p class="text-justify">
<b><?php echo trans('rides.post_disclaimer_heading1'); ?></b>
<?php echo trans('rides.post_disclaimer_text1'); ?>
</p>
</div>
</div>
</div>
    <hr class="mt-0">
</li>
<li>
<div class='disclaimer__box'>
<div class='media'>
<div class='media-left mr-2 d-none'>
<label class='checkbox__square checkbox__element' for='disclaimer-2'>
<input id='disclaimer-2' type='checkbox' value='disclaimer_2'>
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
</label>
</div>
<div class='media-body'>
<p class="text-justify">
<b><?php echo trans('rides.post_disclaimer_heading2'); ?></b>
<?php echo trans('rides.post_disclaimer_text2'); ?>
</p>
</div>
</div>
</div>
    <hr class="mt-0">
</li>
<li>
<div class='disclaimer__box'>
<div class='media'>
<div class='media-left mr-2 d-none'>
<label class='checkbox__square checkbox__element' for='disclaimer-3'>
<input id='disclaimer-3' type='checkbox' value='disclaimer_3'>
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
</label>
</div>
<div class='media-body'>
<p class="text-justify">
<b><?php echo trans('rides.post_disclaimer_heading3'); ?></b>
<?php echo trans('rides.post_disclaimer_text3'); ?>
</p>
</div>
</div>
</div>
    <hr class="mt-0">
</li>
<li>
<div class='disclaimer__box'>
<div class='media'>
<div class='media-left mr-2 d-none'>
<label class='checkbox__square checkbox__element' for='disclaimer-3'>
<input id='disclaimer-3' type='checkbox' value='disclaimer_3'>
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
</label>
</div>
<div class='media-body'>
<p class="text-justify">
<b><?php echo trans('rides.post_disclaimer_heading4'); ?></b>
<?php echo trans('rides.post_disclaimer_text4'); ?>
</p>
</div>
</div>
</div>
    <hr class="mt-0">
</li>
<li>
<div class='disclaimer__box'>
<div class='media'>
<div class='media-left mr-2 d-none'>
<label class='checkbox__square checkbox__element' for='disclaimer-3'>
<input id='disclaimer-3' type='checkbox' value='disclaimer_3'>
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
</label>
</div>
<div class='media-body'>
<p class="text-justify">
<b><?php echo trans('rides.post_disclaimer_heading5'); ?></b>
<?php echo trans('rides.post_disclaimer_text5'); ?>
</p>
</div>
</div>
</div>
</li>
</ul>
</div>
</div>
    
    <div class="form-group">
        <ul class='disclaimer__list ul__list mb-0'>
<li>
<div class='disclaimer__box'>
<div class='media'>
<div class='media-left mr-2'>
<label class='checkbox__square checkbox__element' for='disclaimer-11'>
<input id='disclaimer-11' type='checkbox' value='disclaimer_1' name="agree" required data-parsley-trigger='blur focusout change' data-parsley-required-message="Please agree to our terms and conditions to continue." data-parsley-errors-container='#parsley-agree-error' checked>
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check' style="top: -2px;"></i>
</span>
</span>
</label>
</div>
<div class='media-body'>
<p class="text-justify">
I agree to these rules, and I have read and agree to Proxima's <a href="<?php echo url('terms-service'); ?>" target="_blank">Terms of service</a>, and <a href="<?php echo url('terms-use'); ?>" target="_blank">Terms of use</a>.
</p>
</div>
</div>
</div>
</li>
        </ul>
        <div id='parsley-agree-error'></div>
    </div>
<!-- / End disclaimers -->
<!-- / Post ride -->
<div class='form-group ml-auto mr-auto'>
    <center>
    <div class="g-recaptcha" data-sitekey="6Lcy0OIUAAAAAI0mxFvI6GEE9Mr_bz260YGcDosT"></div>
    <ul class="parsley-errors-list filled" id="captcha-error" aria-hidden="false" style="max-width:300px; display:none;">
            <li class="parsley-required">Please prove you are not a robot first.</li>
        </ul>
    <p class="alert alert-danger mt-3" style="display:none; color:red; font-size:17px;" id="error">Error.</p>
<button class='btn btn-outline btn-outline-default btn-radius f-500 mt-3' type='submit' id="submit_btn">
Update ride
</button>
    </center>
</div>
<!-- / End post ride -->
</div>
<div class='col-12 col-lg-4 d-none-up-to- hide-up-to-lg'>
<div class='row'>
<div class='col-12'></div>
<!-- / Google map -->
<div class='img-thumbnail-wrapper google-map-wrapper'>
<div class='embed-responsive embed-responsive-4by3 mb-3'>
<div class='post-ride-google-map embed-responsive-item' id='ride-google-map'></div>
</div>
</div>
<!-- / End Google map -->
<div class='row'>
<div class='col-12'>
    <?php 
    $car_image=url('images/4-upload-car-photo.png');
    if($ride[0]['ride']->car_image!='') $car_image=url('car_images/'.$ride[0]['ride']->car_image);
    ?>
<div class='img-thumbnail-wrapper' style="">
<input type="file" name="file" class="car_file" style="display:none;" accept="image/*">
<img src="<?php echo $car_image; ?>" class="img-thumbnail img-fluid car_browse" alt="Bentley continental gt red wallpaper" style="background:black; cursor:pointer; width:100%;" id="car_image2"/>
    <p class="text-center mt-2"><?php if($ride[0]['ride']->car_image!='') echo 'This is your car. Click on the photo if you want to change it.'; else echo ''; ?></p>
</div>
</div>
</div>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
<input type="hidden" name="form_clear" id="form-clear" value="0">
</div>

<?php include(app_path().'/common/footer.php'); ?>
<script src="<?php echo url('javascripts/libs/parsley.min.js'); ?>"></script>
<script src="<?php echo url('javascripts/post-ride-form.js'); ?>"></script>
<script>
  console.log("This will load first")
  function initialGoogleMap(){
  
    window.initGoogleMap();
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUB1MKo9R24yt2uYi4_LLw9hyZp-fKDwE&amp;libraries=places&amp;callback=initialGoogleMap" async="true" defer="defer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
    function recurring2(th)
    {
        var check=$(th).is(':checked');
        
        if(check)
        {
            $("#until_box").show();
        }
        else
        {
            $("#until_box").hide();
        }
    }
    
    function seat_selected(th)
    {
        var seat=$(th).val();
        
        for(i=1; i<=seat; i++)
            {
                $(".seat-unselect-"+i).hide();
                $(".seat-select-"+i).show();
                
                $(".seat-unselect-"+i).parent().prev().addClass('green-seat');
                $("#number-of-seat-cross-"+i).hide();
            }
        
        for(i=parseInt(seat)+1; i<=7; i++)
            {
                if(seat==7) continue;
                $(".seat-unselect-"+i).show();
                $(".seat-select-"+i).hide();
                
                $(".seat-unselect-"+i).parent().prev().removeClass('green-seat');
                $("#number-of-seat-cross-"+i).show();
            }
    }
    
    function time_updated()
    {
        var time=$('#ride-time-field2').val();
        //alert(time);
        if(time>='12:00 AM' && time<='5:00 AM')
        $("#parsley-id-555").show();
    }
    
    function skip_vehicle2(th)
    {
        var check=$(th).is(':checked');
        
        if(check)
            {
                $("#parsley-id-skip").show();
                $(".vehicle_field").attr('required', false);
            }
        else 
            {
                $("#parsley-id-skip").hide();
                $(".vehicle_field").attr('required', true);
            }
    }
    
    function recommend_price(distance)
    {
        //alert(distance);
        var measures=distance.split(' ');
        var digits=measures[0];
        var measure=measures[1];
        
        digits=digits.replace(/,/g , '');
        
        if(measure=='m')
            {
                digits=parseFloat(digits) / 1000;
            }
        
        var gas_cost='<?php echo $site->gas_cost; ?>';
        var seats=$('input[name="seats"]:checked').val();
        if(seats=='' || seats=='0' || seats==NaN) seats=1;
        var price=((parseFloat(digits)*parseFloat(gas_cost))*2)/parseInt(seats);
        $("#price_seat").val(Math.ceil(price));
        
        $('#post-form').parsley().validate('price_fields');
    }
    
    $(document).on('change', 'input[name="seats"]', function(){
        var distance=$("#ride-distance").val();
        recommend_price(distance)
    });
    
    function uncheck_field(th, field)
    {
        if($(th).is(':checked')) $(field).prop('checked', false);
    }
    
    function from_city(city)
    {
        alert(city);
    }
    
    $("#ride-departure").on('blur', function(){
        setTimeout(function(){ 
            if($("#departure_city").val()!='')
            $("#departure-error").hide();
        }, 1000);
        
        setTimeout(function(){ 
            if($("#departure_city").val()!='')
            $("#departure-error").hide();
        }, 2000);
    });
    
    $("#ride-destination").on('blur', function(){
        setTimeout(function(){ 
            if($("#destination_city").val()!='')
            $("#destination-error").hide();
        }, 1000);
        
        setTimeout(function(){ 
            if($("#destination_city").val()!='')
            $("#destination-error").hide();
        }, 2000);
    });
    
    function date_selected(val)
    {
        if(val!='') $("#parsley-date-error").empty();
        check_past_date();
    }
    
    function check_past_date()
    {
        var val=$("#ride-date-field").val();
        
        var date=new Date();
        var month=date.getMonth()+1;
        var hours_now=date.getHours();
        var hours=('00'+hours_now).slice(-2);
        var minutes_now=date.getMinutes();
        var minutes=('00'+minutes_now).slice(-2);
        var time_now=hours+':'+minutes;
        month=('00'+month).slice(-2);
        date=date.getDate()+'-'+month+'-'+date.getFullYear();
        
        if(val==date)
        {
            var j2='';
            var time=$("#ride-time-field2").val();
            for(i=1; i<=12; i++)
            {
                for(j=0; j<=45; j+=15)
                {
                    j2=('00'+j).slice(-2);
                    if(time==i+':'+j2+' AM')
                    {
                        if(i==12) hours=0;
                        else hours=i;
                        minutes=j;
                        time=i+':'+j2;
                    }
                    else if(time==i+':'+j2+' PM')
                    {
                        hours=i+12;
                        minutes=j;
                        time=(i+12)+':'+j2;
                    }
                }
            }
            
            //alert(hours_now+' - '+hours+':'+minutes);
            if(hours_now>hours || (hours_now==hours && minutes_now>minutes)) { $("#parsley-id-5544").show(); $("#parsley-id-555").hide(); return 1; }
            else 
            { 
                $("#parsley-id-5544").hide();
                if(hours=='00') hours='0';
                if(hours>='0' && hours<='5') $("#parsley-id-555").show(); return 0;
            }
        } else 
        {
            $("#parsley-id-5544").hide();
            
            var time=$("#ride-time-field2").val();
            for(i=1; i<=12; i++)
            {
                for(j=0; j<=45; j+=15)
                {
                    j2=('00'+j).slice(-2);
                    if(time==i+':'+j2+' AM')
                    {
                        if(i==12) hours=0;
                        else hours=i;
                        minutes=j;
                        time=i+':'+j2;
                    }
                    else if(time==i+':'+j2+' PM')
                    {
                        hours=i+12;
                        minutes=j;
                        time=(i+12)+':'+j2;
                    }
                }
            }
            if(hours=='00') hours='0';
            if(hours>='0' && hours<='5') $("#parsley-id-555").show();
            return 0;
        }
        
    }
    
    $('#post-form').on('submit', function(e){
        var flag=$("#form-clear").val();
        if(flag==0)
        e.preventDefault();
        else return true;
        var th="#post-form";

        $("#submit_btn").attr('disabled', false);
        $("#error").hide();
        $("#captcha-error").hide();
        $("#departure-error").hide();
        $("#destination-error").hide();
        
        if($("#departure_city").val()=='' && $("#ride-departure").val()!='')
            {
                $("#departure-error").show();
                $("#ride-departure").focus();
                return false;
            }
        
        if($("#destination_city").val()=='' && $("#ride-destination").val()!='')
            {
                $("#destination-error").show();
                $("#ride-destination").focus();
                return false;
            }
        
        if($('input[name="seats"]:checked').length <= 0)
        {
            //$("#error").text('Please select seat first.');
            //$("#error").show();
            var scrollPos =  $(".ride-form-seats").prev().offset().top;
            $(window).scrollTop(scrollPos);
            $("#submit_btn").attr('disabled', false);
            return false;
        }
        
        if($('input[name="smoke"]:checked').length <= 0)
        {
            //$("#error").text('Please select your smoking preference.');
            //$("#error").show();
            $("#submit_btn").attr('disabled', false);
            return false;
        }
        
        if($('input[name="animal_friendly"]:checked').length <= 0)
        {
            //$("#error").text('Please select your animal and pets friendly preference.');
            //$("#error").show();
            $("#submit_btn").attr('disabled', false);
            return false;
        }
        
        if($('input[name="booking_method"]:checked').length <= 0)
        {
            //$("#error").text('Please select booking method.');
            //$("#error").show();
            $("#submit_btn").attr('disabled', false);
            return false;
        }
        
        if($('input[name="luggage"]:checked').length <= 0)
        {
            //$("#error").text('Please select your luggage preference.');
            //$("#error").show();
            var scrollPos =  $("#luggage_box").offset().top;
            $(window).scrollTop(scrollPos);
            $("#submit_btn").attr('disabled', false);
            return false;
        }
        
        if($('input[name="payment_method"]:checked').length <= 0)
        {
            //$("#error").text('Please select payment method.');
            //$("#error").show();
            var scrollPos =  $("#payment_box").offset().top;
            $(window).scrollTop(scrollPos);
            $("#submit_btn").attr('disabled', false);
            return false;
        }
        
        if(grecaptcha && grecaptcha.getResponse().length !== 0) { $("#captcha-error").hide(); }
        else
            {
                $("#captcha-error").show();
                return false;
            }
        
        var check=$("#recurr").is(':checked');
        
        if(check)
        {
            if($("#ride-date-field2").val()=='' && $("#until_limit").val()=='')
            {
                $("#error").html('Please select a date or limit for recurring.');
                $("#error").show();
                return false;
            }
            else $("#error").hide();
        }
        else
        {
            $("#until_box").hide();
        }
        
        if(check_past_date())
        {
            var scrollPos =  $("#date-time-box").offset().top;
            $(window).scrollTop(scrollPos);
            return false;
        }
        
        $("#submit_btn").attr('disabled', false);
        
        var id='<?php echo $ride[0]['ride']->id; ?>';
        var time=$("#ride-time-field2").val();
        var date=$("#ride-date-field").val();
        var formData=new FormData();
        var token='<?php echo csrf_token(); ?>';
        formData.append('_token', token);
        formData.append('id', id);
        formData.append('date', date);
        formData.append('time', time);
        
        $.ajax({
                url: "<?php echo url('check-time-edit') ?>",
                type: "POST",
                data:  formData,
                beforeSend: function(){ //alert('sending');
                },
                contentType: false,
                processData:false,
                success: function(data) { //alert(data);
                    //success
                    // here we will handle errors and validation messages
                    if (0) {
                        $("#error").html('Sorry you cannot post a ride in past. Please select another time slot.');
                        $("#error").show();
                    } else {
                        // ALL GOOD! just show the success message!
                        if ( ! data.success) {
                            $("#error").html('Sorry you have a ride posted for '+time+'. You cannot post another ride for the same time.');
                            $("#error").show();
                        } else {
                            // ALL GOOD! just show the success message!
                            $("#error").hide();
                            //return true;
                            $("#form-clear").val('1');
                            $("#post-form").submit();
                        }
                        
                    }
                },
                error: function()  {
                    //error
                } 	        
        });
    });
    
                  $(document).on('click', '.car_browse', function(){
                    var file = $(".car_file");
                    file.trigger('click');
                  });

		  $(document).on('change', '.car_file', function(e){
                      var o=new FileReader;
                      o.readAsDataURL(e.target.files[0]),o.onloadend=function(o){
                          var formData=new FormData();
                              var token='<?php echo csrf_token(); ?>';
                              formData.append('_token', token);
                              formData.append('file', e.target.files[0]);
        
                                $.ajax({
                                    url: "<?php echo url('upload-car-image') ?>",
                                    type: "POST",
                                    data:  formData,
                                    beforeSend: function(){ //alert('sending');
                                        $("#submit_btn").attr('disabled', true);
                                    },
                                    contentType: false,
                                    processData:false,
                                    success: function(data) { //alert(data);
                                        $("#submit_btn").attr('disabled', false);
                                    //success
                                    // here we will handle errors and validation messages
                                    if ( ! data.success) {
                                    } else {
                                        // ALL GOOD! just show the success message!
                                        $("#img_file").val(data.name);
                                        $(".car_file").val('');
                                    }
                                    },
                                    error: function()  {
                                        //error
                                    }
                                });
                          
                          $("#car_image").attr("src",o.target.result);
                          $("#car_image2").attr("src",o.target.result);
                      }
                    //$(this).prev().text($(this).val().replace(/C:\\fakepath\\/i, ''));
                  });
    
    $(function () {
        $('#ride-time-field2').timepicker({
    timeFormat: 'h:mm p',
    interval: 15,
    minTime: '12:00am',
    maxTime: '11:45pm',
    defaultTime: '<?php echo $ride[0]['ride']->time; ?>',
    startTime: '12:00am',
    dynamic: false,
    dropdown: true,
    scrollbar: true,
            change: function(time) {
            // the input field
                var hours=time.getHours();
                var minutes=time.getMinutes();
                
                if(hours>='0' && hours<='5')
                $("#parsley-id-555").show();
                else $("#parsley-id-555").hide();
                
                check_past_date();
                /*
            var element = $(this), text;
            // get access to this Timepicker instance
            var timepicker = element.timepicker();
            text = 'Selected time is: ' + timepicker.format(time);
            alert(text);*/
        }
        });
    });
    
    var rideDateField = $("#ride-date-field2");

  if(rideDateField.length){
    var rideDateFormat = rideDateField.data("format")
    const rDatePickerObject = rideDateField.datepicker({
      uiLibrary:"bootstrap4",
      keyboardNavigation: true,
      format: ( rideDateFormat || "dd-mm-yyyy"),
      disableDates: function(date){
        // Check current date and give date, if it older than current, then disable it
        var todayDate = new Date();
        todayDate.setHours(0,0,0,0)
        var currentDate = new Date(date)
        return todayDate.getTime() <= currentDate.getTime();
      }
    });
    var rDatePickerElement = rDatePickerObject[0];
    var rGuid = rDatePickerElement.dataset["guid"];
    var rCalendar = $('[guid="'+rGuid+'"]');

    rDatePickerObject.on("close", function(){
      // rCalendar.find(".data-navigator").off("swipeleft");
      // rCalendar.find(".data-navigator").off("swiperight");
    });


    (rCalendar).on("swipeleft", function(e){
      console.log("Swipe Left")
      rDatePickerObject.renderNextMonth()
    });

    (rCalendar).on("swiperight", function(e){
      rDatePickerObject.renderPrevMonth()
      console.log("Swipe Nexy")
    });

    // rDatePickerObject.on("open", function(){
    //   console.log("Datepicker opened");
    //   $(document).find(rCalendar).on("swipeleft",".data-navigator", function(e){
    //     console.log("Swipe left");
    //     rDatePickerObject.renderNextMonth()
    //   });
    //
    //   $(document).find(rCalendar).find(".data-navigator").on("swiperight", function(e){
    //     console.log("Swipe right");
    //     rDatePickerObject.renderPrevMonth()
    //   });
    // })
  }
    
    function until_selected(th)
    {
        var date=$(th).val();
        if(date!='') $("#until_limit").val('');
    }
    
    function limit_selected(th)
    {
        var limit=$(th).val();
        if(limit!='') $("#ride-date-field2").val('');
    }
    
    seat_selected('#number-of-seat-<?php echo $ride[0]['ride']->seats; ?>');
    skip_vehicle2('#skip_vehicle');
</script>
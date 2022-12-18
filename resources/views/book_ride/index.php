<?php include(app_path().'/common/header.php'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css" rel="stylesheet" type="text/css" />
<?php 

$total_price = 0;

?>
<style>
        .vehicle__detail__list li .li-wrapper{
            margin-bottom: 10px;
        }
        
        .vehicle__detail__list li .li-wrapper span.ans{
            font-weight: 500;
        }
        
        .mbl-show{
                display: none;
            }
        
        @media (max-width: 767px) {
            .btn.btn-outline.btn-outline-b-light {
                font-size: 13px;
                padding-left: 10px;
                padding-right: 10px;
            }
            
            .justify-content-between {
                -ms-flex-pack: justify !important;
                justify-content: normal !important;
            }
            
            .mbl-show{
                display: block;
            }
            
            .dsk-hide{
                display: none;
            }
        }
    
    .book-btn{
        background: #394d5b;
        color: white;
    }
    
    ul.facilities-list {
    padding: 0;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: calc(100% + 20px);
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-direction: row;
    flex-direction: row;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-left: -10px;
    margin-right: -10px;
}
    
    ul.facilities-list li {
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -ms-flex-preferred-size: 50%;
    flex-basis: 50%;
    max-width: 50%;
    list-style: none;
    padding-left: 10px;
    padding-right: 10px;
    margin-bottom: 10px;
}
    
    ul.facilities-list li p {
    display: block;
    font-size: 16px;
    text-decoration: none;
    cursor: default;
    color: #333;
    margin-bottom: 0px;
}
    
    @media only screen and (max-width:792px)
    {
        ul.facilities-list li {
    -ms-flex-preferred-size: 100%;
    flex-basis: 100%;
    max-width: 100%;
}
    }
    
    .green-seat{
        color: #53e195;
    }
    </style>
<?php 
    $from=$ride[0]['ride']->departure_place;
    $to=$ride[0]['ride']->destination_place;
                    
    if($from=='') $from=$ride[0]['ride']->departure_city;
    if($to=='') $to=$ride[0]['ride']->destination_city;

    if($from=='') $from=$ride[0]['ride']->departure_state;
    if($to=='') $to=$ride[0]['ride']->destination_state;

    if($from=='') $from=$ride[0]['ride']->departure;
    if($to=='' OR $from==$to) $to=$ride[0]['ride']->destination;

    $book_btn=1;
    if($user_id!=0 AND $user->id==$ride[0]['ride']->added_by) $book_btn=0;

    $seats_available=$ride[0]['ride']->seats-count($bookings);
?>

<form class=" parsley__form__validate" action="" method="post" id="booking-form" onsubmit="return check_data();">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="ride_id" value="<?php echo $ride[0]['ride']->id; ?>" id="ride">
<div class='body__content'>
<div class='post__ride page__common p-60 with-b-top ride__view__page'>
<div class='container'>
<div class='row'>
<div class='col-12 col-md-12 col-lg-8 col-xl-8'>
    
    <table class="table table-responsive">
    <tbody style="width:100%;">
      <tr>
        <td width="50%" class="ptop-medium">
          <b><?php echo trans('rides.departure'); ?>:</b>
        </td>
        <td width="50%" class="ptop-medium">
              <?php echo $ride[0]['ride']->departure; ?>
        </td>
      </tr>
      <tr>
        <td width="50%" class="ptop-medium">
          <b><?php echo trans('rides.destination'); ?>:</b>
        </td>
        <td width="50%" class="ptop-medium">
              <?php echo $ride[0]['ride']->destination; ?>
        </td>
      </tr>
      <tr>
        <td width="50%" class="ptop-medium">
          <b><?php echo trans('rides.leaving_at'); ?>:</b>
        </td>
        <td width="50%" class="ptop-medium">
              <?php echo date_format(new DateTime($ride[0]['ride']->date),'l, F d').' at '.date_format(new DateTime($ride[0]['ride']->time),'h:i a'); ?>
        </td>
      </tr>
      <tr>
        <td width="50%" class="ptop-medium">
          <b><?php echo trans('rides.select_seats'); ?>:</b>
        </td>
        <td width="50%" class="ptop-medium">
              <!-- / Number of seats -->

<ul class='ul__list ride-form-seats'>
    <?php if($seats_available>=1) { ?>
<li>
<label for='number-of-seat-1'>
<input id='number-of-seat-1' name='seats' type='radio' value='1' checked onchange="seat_selected(this)" data-parsley-required="true" data-parsley-trigger='blur focusout change' data-parsley-required-message="Please select the seats first." data-parsley-errors-container='#parsley-seats-error'>
<span class='seats'>
<span class='seat-number'>
1
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect seat-unselect-1" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select seat-select-1" alt="Seat hover 1" />
</span>
</span>
</label>
</li>
    <?php } ?>
    <?php if($seats_available>1) { ?>
<li>
<label for='number-of-seat-2'>
<input id='number-of-seat-2' name='seats' type='radio' value='2' onchange="seat_selected(this)">
<span class='seats'>
<span class='seat-number'>
2
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect seat-unselect-2" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select seat-select-2" alt="Seat hover 1" />
</span>
</span>
</label>
</li>
    <?php } ?>
    <?php if($seats_available>2) { ?>
<li>
<label for='number-of-seat-3'>
<input id='number-of-seat-3' name='seats' type='radio' value='3' onchange="seat_selected(this)">
<span class='seats'>
<span class='seat-number'>
3
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect seat-unselect-3" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select seat-select-3" alt="Seat hover 1" />
</span>
</span>
</label>
</li>
    <?php } ?>
    <?php if($seats_available>3) { ?>
<li>
<label for='number-of-seat-4'>
<input id='number-of-seat-4' name='seats' type='radio' value='4' onchange="seat_selected(this)">
<span class='seats'>
<span class='seat-number'>
4
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect seat-unselect-4" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select seat-select-4" alt="Seat hover 1" />
</span>
</span>
</label>
</li>
    <?php } ?>
    <?php if($seats_available>4) { ?>
<li>
<label for='number-of-seat-5'>
<input id='number-of-seat-5' name='seats' type='radio' value='5' onchange="seat_selected(this)">
<span class='seats'>
<span class='seat-number'>
5
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect seat-unselect-5" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select seat-select-5" alt="Seat hover 1" />
</span>
</span>
</label>
</li>
    <?php } ?>
    <?php if($seats_available>5) { ?>
<li>
<label for='number-of-seat-6'>
<input id='number-of-seat-6' name='seats' type='radio' value='6' onchange="seat_selected(this)">
<span class='seats'>
<span class='seat-number'>
6
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect seat-unselect-6" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select seat-select-6" alt="Seat hover 1" />
</span>
</span>
</label>
</li>
    <?php } ?>
    <?php if($seats_available>6) { ?>
<li>
<label for='number-of-seat-7'>
<input id='number-of-seat-7' name='seats' type='radio' value='7'onchange="seat_selected(this)">
<span class='seats'>
<span class='seat-number'>
7
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect seat-unselect-7" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select seat-select-7" alt="Seat hover 1" />
</span>
</span>
</label>
</li>
    <?php } ?>
</ul>

<!-- / End Number of seats -->
        </td>
      </tr>
      <tr>
        <td width="50%" class="ptop-medium">
          <b><?php echo trans('rides.price_seat'); ?>:</b>
        </td>
        <td width="50%" class="ptop-medium">
              $<?php echo $ride[0]['ride']->price; ?> CAD
        </td>
      </tr>
      <tr>
        <td width="50%" class="ptop-medium">
          <b><?php echo trans('rides.booking_fee'); ?>:</b>
        </td>
        <td width="50%" class="ptop-medium">
            <?php 
                    $booking_price=$site->booking_price;
                    $booking_per=$site->booking_per;
        
                    if($user_id!=0 AND $user->charge_booking=='0')
                    {
                        $booking_price=0;
                        $booking_per=1;
                    }
                    else if($user_id!=0 AND ($user->booking_price!='' OR $user->booking_per!=''))
                    {
                        $booking_price=$user->booking_price;
                        $booking_per=$user->booking_per;
                    }
        
                    if($booking_per==0) $booking_per=1;
        
                    $total_cost=$ride[0]['ride']->price;
                    //$booking_per=$total_cost*$booking_per/100;
        
                    //if($booking_price>$booking_per) $booking_price=$booking_per;
                    if($ride[0]['ride']->price<=15) $booking_price=0;
                     $booking_price=number_format($booking_price, 2);
            ?>
              $<?php echo $booking_price; ?> CAD
            
            <p class="alert alert-primary mb-0 mt-2"><i class="fa fa-info-circle"></i> You have <?php echo $user->booking_credits; ?> booking credits left.
                <?php if($user->booking_credits==0) { ?>
                <a href="<?php echo url('booking-credits'); ?>">Buy now</a>
                <?php } ?>
            </p>
        </td>
      </tr>
      <tr>
        <td width="50%" class="ptop-medium">
          <b><?php echo trans('rides.total'); ?>:</b>
        </td>
        <td width="50%" class="ptop-medium">
              <font style="<?php if($user_id!=0 AND $user->free_rides>0) { ?>text-decoration:line-through;<?php } ?>" id="total_price">
                  $<?php 
                  $tot=$ride[0]['ride']->price;
                  if($user->booking_credits==0) $tot+=$booking_price;
                  echo number_format($tot, 2);
                  ?> CAD
              </font>
            
            <?php if($user_id!=0 AND $user->free_rides>0) { ?>  <p class="alert alert-primary"><i class="fa fa-info"></i> You have <?php echo $user->free_rides; ?> free ride left to use.</p><?php } else if($ride[0]['ride']->payment_method=='Cash') { ?>
            <br><p class="alert alert-primary mb-0 mt-2"><i class="fa fa-info-circle"></i> $<?php echo $booking_price; ?> CAD booking fee to be paid now.<br> $<span id="cash_driver"><?php echo number_format($ride[0]['ride']->price, 1); ?></span> CAD to be paid to the driver when you meet.</p>
            <?php } ?>
        </td>
      </tr>
      <tr>
        <td width="50%" class="ptop-medium">
          <b><?php echo trans('rides.payment_method'); ?>:</b>
        </td>
        <td width="50%" class="ptop-medium" style="font-size:17px;">
              <?php if($ride[0]['ride']->payment_method=='Cash') { ?>
    <img src="<?php echo url('images/icons-png/hand-cash.png'); ?>" class="img-fluid" alt="Hand cash" style="max-width:25px;"/>
    <?php } else if($ride[0]['ride']->payment_method=='Online payment') { ?>
    <img src="<?php echo url('images/icons-png/money-transfer.png'); ?>" class="img-fluid" alt="Hand cash" style="max-width:25px; margin-bottom:2px;"/>
    <?php } else if($ride[0]['ride']->payment_method=='Secured cash') { ?>
    <img src="<?php echo url('images/icons-png/money-guaranteed.png'); ?>" class="img-fluid" alt="Hand cash" style="max-width:25px;"/>
    <?php } ?>
            &nbsp;
            <div class='radio-text show-info-top-right'>
<span class='info-icon' data-toggle='tooltip' title='<?php if($ride[0]['ride']->payment_method=='Cash') echo 'Pay to the driver in cash when you meet'; else if($ride[0]['ride']->payment_method=='Online payment') echo 'Your account will be charged, but the funds will be paid to the driver only after the ride is complete'; else if($ride[0]['ride']->payment_method=='Secured cash') echo 'The amount will be held from your account, and it will be refunded to you once you meet the driver and pay him in cash'; ?>'>
<i class='fa fa-info-circle'></i>
</span>
            <?php echo $ride[0]['ride']->payment_method; ?>
            </div>
        </td>
      </tr>
      <tr>
        <td width="50%" class="ptop-medium">
          <b><?php echo trans('rides.available_funds'); ?></b>
        </td>
        <td width="50%" class="ptop-medium">
             <b> $<?php echo $user->balance; ?> CAD</b>
        </td>
      </tr>
<!---->    </tbody>
  </table>
    <div class="mb-4"></div>



    <?php if(((($ride[0]['ride']->payment_method=='Online payment' OR $ride[0]['ride']->payment_method=='Guaranteed cash') OR $ride[0]['ride']->payment_method=='Secured cash') OR ($ride[0]['ride']->payment_method=='Cash' AND $booking_price>0)) AND $user_id!=0 AND $user->free_rides==0) { 
    
    if($ride[0]['ride']->payment_method!='Cash')
    $total_price=$ride[0]['ride']->price+$booking_price;
    else $total_price=$booking_price;
    ?>
    <div class='form-group' id="payment-box" style="<?php if($user->balance>=($total_price)) echo 'display:none;'; ?>">
    <?php if(1) { $i=0; ?>
        <ul class='ul__list ul__list--horizontal mt-4'>
    
            <?php foreach($user_cards as $card) { ?>
<li>
<label class='checkbox__square checkbox__round checkbox__radio--1' for='access-driver-phone-yes<?php echo $i; ?>'>
<div class='radio-element'>
<input id='access-driver-phone-yes<?php echo $i; ?>' name='payment' type='radio' value='my_card' onchange="update_card(this, '<?php echo $card->id; ?>')" <?php if($i++==0) echo 'checked'; ?>>
<span class='checkbox__all'>
<span class='select-element checkbox__element'>
<span class='toggle'></span>
</span>
</span>
</div>
<div class='radio-text'>
XXXX-XXXX-XXXX-<?php echo $card->last4; ?>
</div>
</label>
</li>
    
    <?php } ?>
    <input type="hidden" name="card_id" value="<?php if(isset($user_cards[0]->id)) echo $user_cards[0]->id; ?>" id="card_id">

<li>
<label class='checkbox__square checkbox__round checkbox__radio--1' for='access-driver-phone-yesn'>
<div class='radio-element'>
<input id='access-driver-phone-yesn' name='payment' type='radio' value='new_card' onchange="new_card(this)" <?php if(empty($user_cards)) echo 'checked'; ?>>
<span class='checkbox__all'>
<span class='select-element checkbox__element'>
<span class='toggle'></span>
</span>
</span>
</div>
<div class='radio-text'>
Debit/Credit card
</div>
</label>
</li>
            
<li>
<label class='checkbox__square checkbox__round checkbox__radio--1' for='access-driver-phone-yesn1'>
<div class='radio-element'>
<input id='access-driver-phone-yesn1' name='payment' type='radio' value='paypal'>
<span class='checkbox__all'>
<span class='select-element checkbox__element'>
<span class='toggle'></span>
</span>
</span>
</div>
<div class='radio-text'>
PayPal
</div>
</label>
</li>
        </ul>
    <?php } else { ?>
        <input name='payment' type='hidden' value='new_card'>
    <?php } ?>
        
    <div class="mt-3" id="card-element">
      <!-- a Stripe Element will be inserted here. -->
    </div>
    <div id="paypal_field" style="display:none;">
        <!--<input class="form-control" type="text" name="paypal_email" value="" placeholder="Your PayPal email...">-->
    </div>
    </div>
    
    
    <ul class="parsley-errors-list filled" id="card-error-box" style="display:none;">
            <li class="parsley-required" id="card-errors" style="display:none;"></li>
        </ul>
    <div class="alert alert-danger mt-2 mb-0" id="card-errors" role="alert" style="display:none;"></div>
    <?php } ?>
    
    <?php 
    $features=array();
    if($ride[0]['ride']->features!='') $features=explode(';', $ride[0]['ride']->features);
    
    if(in_array('Pink ride', $features)) {
    ?>
    <p class="alert alert-success mb-0" style="background: #e11e86; color:white;"><i class="fa fa-info-circle"></i> The driver only accepts female passengers.</p>
    <?php } ?>
    
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
<b><?php echo trans('rides.book_disclaimer_heading1'); ?></b>
<?php echo trans('rides.book_disclaimer_text1'); ?>
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
<b><?php echo trans('rides.book_disclaimer_heading2'); ?></b>
<?php echo trans('rides.book_disclaimer_text2'); ?>
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
<b><?php echo trans('rides.book_disclaimer_heading3'); ?></b>
<?php echo trans('rides.book_disclaimer_text3'); ?>
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
<b><?php echo trans('rides.book_disclaimer_heading4'); ?></b>
<?php echo trans('rides.book_disclaimer_text4'); ?>
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
<b><?php echo trans('rides.book_disclaimer_heading5'); ?></b>
<?php echo trans('rides.book_disclaimer_text5'); ?>
</p>
</div>
</div>
</div>
</li>
</ul>
</div>
</div>
    
    <button type="submit" class="btn btn-primary mt-2" id="book_btn"><?php echo trans('rides.book_now'); ?></button>
</div>
<div class='col-12 col-md-12 col-lg-4 col-xl-4'>
    
    <div class='profile__sidebar'>
<?php include(app_path().'/common/ride_sidebar.php'); ?>
</div>
    
<div class='ride__car__info'>
<div class='car__restricted'>

</div>
</div>
</div>
</div>
</div>
</div>

</div>
</form>

<?php include(app_path().'/common/footer.php'); ?>
<script src="<?php echo url('javascripts/libs/parsley.min.js'); ?>"></script>
<style>
                  .ind-payrun-container.payrun-detail-container {
    border-radius: 3px;
    border: 1px solid #F4F7FF;
    box-shadow: 0 4px 25px 0 rgba(28,29,83,.06);
}
.payrun-detail-container {
    position: relative;
    margin-top: 14px;
    margin-bottom: 40px;
    min-width: 650px;
    border-left: 2px solid black;
}
.panel-default {
    border-color: #ddd;
}
.panel {
    margin-bottom: 21px;
    background-color: #fff;
    border: 1px solid transparent;
    border-radius: 4px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
                  
                  .ind-payrun-container.payrun-detail-container .panel-body.draft, .ind-payrun-container.payrun-detail-container .panel-body.recalled {
    border-color: #788297;
}
.ind-payrun-container.payrun-detail-container .panel-body {
    padding: 15px 25px;
    border-left: 2px solid;
    border-radius: 3px;
}
                  
                  .ind-payrun-container.payrun-detail-container .payrun-info-row {
    padding-top: 15px;
}
                  
                  .ind-payrun-container.payrun-detail-container .payrun-row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: start;
    justify-content: flex-start;
    padding-bottom: 0;
    padding-top: 0;
}
.payrun-detail-container .payrun-row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: start;
    justify-content: flex-start;
    padding-bottom: 10px;
    padding-top: 5px;
}
                  
                  ind-payrun-container.payrun-detail-container .payrun-row .payrun-detail.payrun-total-detail {
    border-right: thin solid #eee;
    border-image: linear-gradient(to bottom,#fff 0,#eee 25%,#eee 50%,#eee 75%,#fff 100%);
    border-left: 0;
    border-image-slice: 1;
}
.ind-payrun-container.payrun-detail-container .payrun-row .payrun-detail {
    padding-right: 5%;
}
.payrun-detail-container .payrun-row .payrun-detail {
    padding-right: 5%;
}
.right-separationline {
    border-right: 1px solid #ededed;
    padding-right: 12px;
    margin-right: 8px;
}
                  .ind-payrun-container.payrun-detail-container .payrun-row .payrun-detail:not(:first-child) {
    padding-left: 5%;
}
.ind-payrun-container.payrun-detail-container .payrun-row .payrun-detail {
    padding-right: 5%;
}
                  
                  .btn-primary, .btn-primary.disabled, .btn-primary[disabled], fieldset[disabled] .btn-primary, .btn-primary.disabled:hover, .btn-primary[disabled]:hover, fieldset[disabled] .btn-primary:hover, .btn-primary.disabled:focus, .btn-primary[disabled]:focus, fieldset[disabled] .btn-primary:focus, .btn-primary.disabled:active, .btn-primary[disabled]:active, fieldset[disabled] .btn-primary:active, .btn-primary.disabled.active, .btn-primary[disabled].active, fieldset[disabled] .btn-primary.active, .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open > .dropdown-toggle.btn-primary {
    background-color: #4E98FF;
    color: #fff;
    border-color: #4E98FF;
}
.pull-right {
    float: right!important;
}
                  .pull-left {
    float: left!important;
}
                  .ind-payrun-container.payrun-detail-container .payrun-note {
    color: #666;
}
.payrun-detail-container .payrun-note {
    color: #222;
    padding-top: 10px;
    padding-bottom: 5px;
}
.font-small {
    font-size: 13px!important;
}
                  .ind-payrun-container.payrun-detail-container .payrun-row span {
    font-size: 11px;
    font-style: normal;
    text-transform: uppercase;
    color: #666;
    letter-spacing: .3px;
}
                  
                  .payrun-detail-container .payrun-row .payrun-data {
    padding-top: 4px;
                          color: #222;
                          font-size: 15px;
                      line-height: 1.42857143;
                      font-weight: bold;
}
.font-semibold {
    font-family: AvertaSemibold,AvertaRegular;
}
              </style>
              
              <style>
                  .india-payrun-summary-container {
    font-size: 14px!important;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: start;
    align-items: flex-start;
    padding: 25px 30px;
                      padding-left: 0px;
                      padding-top: 8px;
}
                  .india-payrun-summary-container .net-pay-section {
    background-color: #F1F2F8;
    border-radius: 6px;
    color: #2F3448;
    width: 411px;
    height: 160px;
    padding: 20px;
    margin-right: 20px;
    border: 1px solid #E7E8EF;
}
                  
                  .india-payrun-summary-container .net-pay-section .net-pay-data-without-bt {
    margin-top: 18px;
}
                  .india-payrun-summary-container .net-pay-section .payrun-label {
    color: #2F3448;
    opacity: .5;
    font-size: 13px;
}
                  .india-payrun-summary-container .pay-day-section {
    width: 152px;
    height: 160px;
    border-radius: 6px;
    background: #fff;
    text-align: center;
    border: 1px solid #EEEFF3;
    padding: 15px;
    color: #1E223D;
}
                  .india-payrun-summary-container .pay-day-section .emp-count-without-skipped-emp {
    margin-top: 15px;
}
                  .table.noborder-table {
    margin-bottom: 10px;
}
                  
                  .table td, .table th {
    padding: .75rem;
    border-top: 0px solid #dee2e6;
    border-bottom: 1px solid #dee2e6;
}
              </style>

<script>
    window.balance=<?php if($user->balance>=$total_price) echo '1'; else echo '0'; ?>;
    
    function seat_selected(th)
    {
        var seat=$(th).val();
        var user_balance='<?php echo $user->balance; ?>';
        var price2='<?php echo $ride[0]['ride']->price; ?>';
        var booking_price='<?php echo $booking_price; ?>';
        var price=(parseFloat(price2)*seat)+parseFloat(booking_price);
        
        <?php if($ride[0]['ride']->payment_method!='Cash') { ?>
        if(parseFloat(price)>parseFloat(user_balance)) { $("#payment-box").show(); window.balance=0; }
        else { $("#payment-box").hide();  window.balance=1; }
        <?php } ?>
        
        $("#total_price").text('$'+price+' CAD');
        
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
        
        $("#cash_driver").text((parseFloat(price2)*seat));
    }
    
    function change_status(th, b_id, status)
    {
        var formData=new FormData();
        var token='<?php echo csrf_token(); ?>';
        formData.append('_token', token);
        formData.append('b_id', b_id);
        formData.append('status', status);
        
        $.ajax({
                url: "<?php echo url('change-status') ?>",
                type: "POST",
                data:  formData,
                beforeSend: function(){ //alert('sending');
                    $(th).attr('disabled', true);
                    $("#request_error").hide();
                },
                contentType: false,
                processData:false,
                success: function(data) { //alert(data);
                    //success
                    // here we will handle errors and validation messages
                    if ( ! data.success) {
                        $(th).attr('disabled', false);
                        $("#request_error").text(data.error);
                        $("#request_error").show();
                    } else {
                        // ALL GOOD! just show the success message!
                        window.location='';
                    }
                },
                error: function()  {
                    //error
                } 	        
        });
    }
    
    function update_card(th, id){
        if($(th).is(":checked")) $("#card_id").val(id);
    }
    
    function check_data(){
        $("#book_btn").attr('disabled', true);
        var flag=0;
        var payment_type=$("input[name=payment]:checked").val();
        <?php if($ride[0]['ride']->payment_method=='Cash' OR empty($user_cards)) { ?>
        //payment_type=$("input[name=payment]").val();
        <?php } ?>
        
        if(window.balance==1) return true;
        if(payment_type=='new_card') {
            window.stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                    $("#card-errors").show();
                    $("#card-error-box").show();
                    $("#book_btn").attr('disabled', false);
                    return false;
                } else { //alert(result.token);
                    // Send the token to your server
                    $("#card-errors").hide();
                    $("#card-error-box").hide();
                    stripeTokenHandler(result.token);
                    flag=1;
                    //booking_form(th);
                    return true;
                }
            });
        }
        else
        {
            return true;
            //booking_form(th);
        }
        
        return false;
    }
    
    function booking_form(th)
    {
        $(th).submit();
        
        var formData=new FormData(th);
        var token='<?php echo csrf_token(); ?>';
        
        $.ajax({
                url: "<?php echo url('book-seat') ?>",
                type: "POST",
                data:  formData,
                beforeSend: function(){ //alert('sending');
                    $("#book_btn").attr('disabled', true);
                    $("#booking_error").hide();
                },
                contentType: false,
                processData:false,
                success: function(data) { //alert(data);
                    //success
                    // here we will handle errors and validation messages
                    if ( ! data.success) {
                        $("#booking_success").hide();
                        $("#book_btn").attr('disabled', false);
                        $("#booking_error").text(data.error);
                        $("#booking_error").show();
                    } else {
                        // ALL GOOD! just show the success message!
                        $("#booking_success").text('Your seat has been booked successfully.');
                        $("#booking_success").show();
                        window.location='';
                    }
                },
                error: function()  {
                    //error
                } 	        
        });
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js" type="text/javascript"></script>

<script src="https://js.stripe.com/v3/"></script>
          <script>
              // Create a Stripe client
              var pk='<?php echo env('STRIPE_PUB_KEY'); ?>';
window.stripe = Stripe(pk);

// Create an instance of Elements
window.elements = window.stripe.elements();

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

              $("input[name=payment]").on('change', function(){
                  $("#paypal_field").hide();
                  
                  var payment=$(this).val();
                  if(payment=='new_card')
                  { new_card(this); $("#card-element").show(); }
                  else { $("#card-element").empty(); $("#card-element").hide(); }
                  
                  if(payment=='paypal') {
                      $("#paypal_field").show();
                      $("#card-errors").hide();
                      $("#card-error-box").hide();
                  }
                  
                  $("#booking_error").hide();
              });
              
              
              
window.card = window.elements.create('card', {hidePostalCode: true, style: style});
              
    function new_card(th) {
// Create an instance of the card Element

// Add an instance of the card Element into the `card-element` <div>
window.card.mount('#card-element');
              
              // Handle real-time validation errors from the card Element.
window.card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
      $("#card-errors").show();
      $("#card-error-box").show();
       $("#booking_error").hide();
  } else {
    displayError.textContent = '';
      $("#card-errors").hide();
      $("#card-error-box").hide();
      $("#booking_error").hide();
  }
});
    }

            <?php if(empty($user_cards)) { ?> new_card('this'); <?php } ?>
              
// Handle form submission
/*var form = document.getElementById('booking-form');
form.addEventListener('submit', function(event) {
    var payment_type=$("input[name=payment]").val();
    alert(payment_type);
    if(payment_type=='new_card') {
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
    }
});*/
              
              function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('booking-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
                  return true;
}
</script>

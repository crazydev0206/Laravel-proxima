<?php include(app_path().'/common/header.php'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css" rel="stylesheet" type="text/css" />
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
    <h3 class='page__title text-c-blue f-700'>
Close ride
</h3><hr class="mt-0">
    
    <table class="table table-responsive">
    <tbody style="width:100%;">
      <tr>
        <td width="50%" class="ptop-medium">
          <b>Departure:</b>
        </td>
        <td width="50%" class="ptop-medium">
              <?php echo $ride[0]['ride']->departure; ?>
        </td>
      </tr>
      <tr>
        <td width="50%" class="ptop-medium">
          <b>Destination:</b>
        </td>
        <td width="50%" class="ptop-medium">
              <?php echo $ride[0]['ride']->destination; ?>
        </td>
      </tr>
      <tr>
        <td width="50%" class="ptop-medium">
          <b>Leaving at:</b>
        </td>
        <td width="50%" class="ptop-medium">
              <?php echo date_format(new DateTime($ride[0]['ride']->date),'l, F d').' at '.date_format(new DateTime($ride[0]['ride']->time),'h:i a'); ?>
        </td>
      </tr>
      <tr>
        <td width="50%" class="ptop-medium">
          <b>Seat(s):</b>
        </td>
        <td width="50%" class="ptop-medium">
              <!-- / Number of seats -->

<ul class='ul__list ul__list--horizontal seat__availability' style="color: #5e7a8e !important;">
    <?php if($ride[0]['ride']->seats>=1) { ?>
<li class='filled-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if(count($bookings)>=1) $seat=url('images/icons-png/seat-hover-1.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat hover 1" />
</div>
</li>
    <?php } ?>
    <?php if($ride[0]['ride']->seats>1) { ?>
<li class='filled-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if(count($bookings)>1) $seat=url('images/icons-png/seat-hover-1.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat hover 1" />
</div>
</li>
    <?php } ?>
    <?php if($ride[0]['ride']->seats>2) { ?>
<li class='filled-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if(count($bookings)>2) $seat=url('images/icons-png/seat-hover-1.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat hover 1" />
</div>
</li>
    <?php } ?>
    <?php if($ride[0]['ride']->seats>3) { ?>
<li class='empty-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if(count($bookings)>3) $seat=url('images/icons-png/seat-hover-1.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat" />
</div>
</li>
    <?php } ?>
    <?php if($ride[0]['ride']->seats>4) { ?>
<li class='empty-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if(count($bookings)>4) $seat=url('images/icons-png/seat-hover-1.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat" />
</div>
</li>
    <?php } ?>
    <?php if($ride[0]['ride']->seats>5) { ?>
<li class='empty-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if(count($bookings)>5) $seat=url('images/icons-png/seat-hover-1.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat" />
</div>
</li>
    <?php } ?>
    <?php if($ride[0]['ride']->seats>6) { ?>
<li class='empty-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if(count($bookings)>6) $seat=url('images/icons-png/seat-hover-1.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat" />
</div>
</li>
    <?php } ?>
            &nbsp;&nbsp;(<?php echo $ride[0]['ride']->seats-count($bookings); ?> seats left)
</ul>

<!-- / End Number of seats -->
        </td>
      </tr>
      <tr>
        <td width="50%" class="ptop-medium">
          <b>Price per seat:</b>
        </td>
        <td width="50%" class="ptop-medium">
              $<?php echo $ride[0]['ride']->price; ?> CAD
        </td>
      </tr>
<!---->    </tbody>
  </table>
    <div class="mb-4"></div>
    
    <?php 
    $date = new DateTime($ride[0]['ride']->date." ".$ride[0]['ride']->time);
    $date->modify("-24 hours");
    $hours24_before=$date->format("Y-m-d H:i:00");
    
    $date = new DateTime($ride[0]['ride']->date." ".$ride[0]['ride']->time);
    $date->modify("-12 hours");
    $hours12_before=$date->format("Y-m-d H:i:00");
    ?>
    
    <?php if(count($bookings)!=0 AND 0) { ?>
    <p class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Please note this is inconvenient to cancel a ride with passengers, and your account may get suspended if this action being repeated for many times. Only cancel if there is a serious problem.</p>
    <?php } ?>
    
    <input type="hidden" name="cancel" value="1">
    <button type="submit" class="btn btn-primary mt-4" id="book_btn">Yes I want to close the ride</button>
    <a href="<?php echo url('ride/'.$ride[0]['ride']->url); ?>">
    <button type="button" class="btn btn-secondary mt-4">I do not want to close the ride</button>
    </a>
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
        payment_type=$("input[name=payment]").val();
        <?php } ?>
        
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
                  var payment=$(this).val();
                  if(payment=='new_card')
                  new_card(this);
                  else $("#card-element").empty();
                  
                  $("#booking_error").hide();
              });
              
              
              
window.card = window.elements.create('card', {style: style});
              
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
